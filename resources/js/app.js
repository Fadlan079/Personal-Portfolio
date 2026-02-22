import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
import htmx from 'htmx.org';
window.htmx = htmx;

import { heroAnimation } from './animations/hero';
import { heroRibbonAnimation } from './animations/hero';
import { heroFloatingCards } from './animations/hero';
import { heroIconParallax } from './animations/hero';
import { navbarFloatAnimation } from "./animations/navbar";
import { navbarScrollEffect } from "./animations/navbar";
import { aboutAnimation } from "./animations/about";
import { projectAnimation } from "./animations/project";
import { projectModalAnimation } from "./animations/project-modal";

const THEME_KEY = 'theme';
const html = document.documentElement;

function getSystemTheme() {
    return window.matchMedia('(prefers-color-scheme: dark)').matches
        ? 'dark'
        : 'light';
}

function applyTheme(theme) {
    html.classList.remove('theme-light', 'theme-dark');
    html.classList.add(`theme-${theme}`);

    updateIcon(theme);
}

function updateIcon(theme) {
    const icon = document.getElementById('themeIcon');
    if (!icon) return;

    icon.classList.remove(
        'fa-moon',
        'fa-sun',
        'fa-desktop'
    );

    if (!localStorage.getItem(THEME_KEY)) {
        icon.classList.add('fa-desktop');
    } else if (theme === 'dark') {
        icon.classList.add('fa-moon');
    } else {
        icon.classList.add('fa-sun');
    }

    icon.classList.add('fa-solid', 'text-text');
}

function initTheme() {
    const savedTheme = localStorage .getItem(THEME_KEY);

    if (savedTheme === 'light' || savedTheme === 'dark') {
        applyTheme(savedTheme);
    } else {
        applyTheme(getSystemTheme());
    }
}

initTheme();

window.toggleTheme = function () {
    const savedTheme = localStorage.getItem(THEME_KEY);

    if (!savedTheme) {
        localStorage.setItem(THEME_KEY, 'dark');
        applyTheme('dark');
        return;
    }

    if (savedTheme === 'dark') {
        localStorage.setItem(THEME_KEY, 'light');
        applyTheme('light');
        return;
    }

    localStorage.removeItem(THEME_KEY);
    applyTheme(getSystemTheme());
};

window.matchMedia('(prefers-color-scheme: dark)')
    .addEventListener('change', e => {
        if (!localStorage.getItem(THEME_KEY)) {
            applyTheme(e.matches ? 'dark' : 'light');
        }
    });

async function loadLanguage(locale) {
    const res = await fetch(`/api/lang/${locale}`);
    const dict = await res.json();

    function getNestedValue(obj, path) {
        return path.split('.').reduce((o, k) => (o || {})[k], obj);
    }

    const elements = document.querySelectorAll('[data-i18n]');
    elements.forEach(el => {
        const key = el.dataset.i18n;
        const text = getNestedValue(dict, key);
        if (text) el.innerHTML = text;
    });

    elements.forEach(el => {
        el.style.visibility = 'visible';
    });

    document.documentElement.lang = locale;
}


const langToggle = document.getElementById('langToggle');

let currentLocale = document.documentElement.lang || 'id';

langToggle?.addEventListener('click', async () => {
    const next = currentLocale === 'id' ? 'en' : 'id';

    await loadLanguage(next);

    localStorage.setItem('locale', next);
    document.cookie = `locale=${next};path=/;max-age=31536000`;

    currentLocale = next;
    updateLangIcon(next);
});

function updateLangIcon(currentLocale) {
    const flag = document.getElementById('langFlag');
    if (!flag) return;

    flag.classList.remove('fi-id', 'fi-us');

    if (currentLocale === 'id') {
        flag.classList.add('fi-id');
    } else {
        flag.classList.add('fi-us');
    }
}

window.tagInput = function (suggestions) {
    return {
        input: '',
        tags: [],
        filtered: [],

        search() {
            const query = this.input.replace('#','').toLowerCase()

            this.filtered = suggestions.filter(item =>
                item.toLowerCase().includes(query)
            ).slice(0,5)
        },

        addTag(tag) {
            tag = tag.replace('#','').toLowerCase()

            if (!this.tags.includes(tag) && tag.trim() !== '') {
                this.tags.push(tag)
            }

            this.input = ''
            this.filtered = []
        },

        removeTag(index) {
            this.tags.splice(index,1)
        }
    }
}

window.imageUpload = function () {
    return {
        images: [],

        handleFiles(event) {
            const files = Array.from(event.target.files);

            for (let file of files) {
                if (this.images.length >= 8) break;

                this.images.push({
                    file: file,
                    url: URL.createObjectURL(file)
                });
            }

        },

        removeImage(index) {
            this.images.splice(index, 1);
        }
    }
}

Alpine.start()



document.addEventListener('DOMContentLoaded', async () => {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const id = entry.target.getAttribute('id');
                navLinks.forEach(link => {
                    link.classList.remove('text-primary');
                    if (link.getAttribute('href') === `#${id}`) {
                        link.classList.add('text-primary');
                    }
                });
            }
        });
    }, { rootMargin: '-50% 0px -50% 0px', threshold: 0 });
    sections.forEach(section => observer.observe(section));

    const saved = localStorage.getItem('locale')
        ?? document.cookie.split('; ').find(row => row.startsWith('locale='))?.split('=')[1]
        ?? 'id';

    if (!localStorage.getItem('locale') && saved) {
        localStorage.setItem('locale', saved);
    }

    currentLocale = saved;
    await loadLanguage(saved);
    updateLangIcon(saved);
    try { heroAnimation(); } catch(e){ console.warn(e) }
    try { heroRibbonAnimation(); } catch(e){ console.warn(e) }
    try { heroFloatingCards(); } catch(e){ console.warn(e) }
    try { heroIconParallax(); } catch(e){ console.warn(e) }
    try { navbarFloatAnimation(); } catch(e){ console.warn(e) }
    try { navbarScrollEffect(); } catch(e){ console.warn(e) }
    try { aboutAnimation(); } catch(e){ console.warn(e) }
    try { projectAnimation(); } catch(e){ console.warn(e) }
    try { projectModalAnimation(); } catch(e){ console.warn(e) }
});
