import './bootstrap';
import htmx from 'htmx.org';
window.htmx = htmx;
import { heroAnimation } from './animations/hero';
import { heroRibbonAnimation } from './animations/hero';
import { heroFloatingCards } from './animations/hero';
import { heroIconParallax } from './animations/hero';
import { navbarFloatAnimation } from "./animations/navbar";
import { navbarScrollEffect } from "./animations/navbar";

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
    const savedTheme = localStorage.getItem(THEME_KEY);

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

    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (dict[key]) {
            el.innerHTML = dict[key];
        }
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
    heroAnimation();
    heroRibbonAnimation();
    heroFloatingCards();
    heroIconParallax();
    navbarFloatAnimation();
    navbarScrollEffect();
});
