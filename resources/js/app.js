import './bootstrap';
import Alpine from 'alpinejs';
window.Alpine = Alpine;
import htmx from 'htmx.org';
import { gsap } from "gsap";
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
import { initmodal } from "./animations/modal";

const THEME_KEY = 'theme';
const html = document.documentElement;

window.showConfirm = function (message) {

    return new Promise((resolve) => {

        const modal = document.getElementById('confirm-modal')
        const backdrop = document.getElementById('confirm-backdrop')
        const box = document.getElementById('confirm-box')
        const msg = document.getElementById('confirm-message')
        const yesBtn = document.getElementById('confirm-yes')
        const cancelBtn = document.getElementById('confirm-cancel')

        msg.innerText = message

        modal.classList.remove('pointer-events-none')

        gsap.set(modal, { opacity: 0 })
        gsap.set(backdrop, { opacity: 0 })
        gsap.set(box, { scale: 0.7, opacity: 0, y: 40 })

        gsap.timeline()
            .to(modal, { opacity: 1, duration: 0.2 })
            .to(backdrop, { opacity: 1, duration: 0.3 }, "<")
            .to(box, {
                scale: 1,
                opacity: 1,
                y: 0,
                duration: 0.5,
                ease: "back.out(1.7)"
            }, "-=0.1")

        function close(result = false) {

            gsap.timeline({
                onComplete: () => {
                    modal.classList.add('pointer-events-none')
                    resolve(result)
                }
            })
                .to(box, { scale: 0.8, opacity: 0, y: 20, duration: 0.3 })
                .to(backdrop, { opacity: 0, duration: 0.2 }, "<")
                .to(modal, { opacity: 0, duration: 0.2 }, "<")

            yesBtn.removeEventListener('click', yesHandler)
            cancelBtn.removeEventListener('click', cancelHandler)
            backdrop.removeEventListener('click', cancelHandler)
            document.removeEventListener('keydown', escHandler)
        }

        function yesHandler() { close(true) }
        function cancelHandler() { close(false) }
        function escHandler(e) { if (e.key === 'Escape') close(false) }

        yesBtn.addEventListener('click', yesHandler)
        cancelBtn.addEventListener('click', cancelHandler)
        backdrop.addEventListener('click', cancelHandler)
        document.addEventListener('keydown', escHandler)
    })
}

document.addEventListener('click', async function (e) {

    const btn = e.target.closest('[data-confirm-delete]')
    if (!btn) return

    e.preventDefault()

    const form = btn.closest('form')
    if (!form) return

    const message = btn.dataset.confirmMessage
        ?? 'This action is permanent. Continue?'

    const confirmed = await showConfirm(message)

    if (confirmed) form.submit()
})

window.bulkAction = async function (type) {

    const form = document.getElementById('bulkForm')
    const selected = document.querySelectorAll('.bulk-checkbox:checked')

    if (selected.length === 0) {
        await showConfirm('Please select at least one project.')
        return
    }

    form.querySelectorAll('input[name="projects[]"]').forEach(el => el.remove())

    selected.forEach(cb => {
        const input = document.createElement('input')
        input.type = 'hidden'
        input.name = 'projects[]'
        input.value = cb.value
        form.appendChild(input)
    })

    const isTrashPage = window.location.pathname.includes('trash')

    if (type === 'delete') {

        const confirmed = await showConfirm(
            'Delete selected projects permanently?'
        )
        if (!confirmed) return

        form.action = isTrashPage
            ? '/dashboard/projects/bulk-force-delete'
            : '/dashboard/projects/bulk-delete'
    }

    if (type === 'restore') {

        const confirmed = await showConfirm(
            'Restore selected projects?'
        )
        if (!confirmed) return

        form.action = '/dashboard/projects/bulk-restore'
    }

    if (type === 'publish') {

        const confirmed = await showConfirm(
            'Publish selected projects?'
        )
        if (!confirmed) return

        form.action = '/dashboard/projects/bulk-publish'
    }

    form.submit()
}

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
    window.__i18nDict = dict; // cache for re-use after AJAX
    applyI18n(document);
    document.documentElement.lang = locale;
}

// Reusable: apply translations to any root element (document or AJAX-injected subtree)
window.applyI18n = function (root) {
    const dict = window.__i18nDict;
    if (!dict) return;

    function getNestedValue(obj, path) {
        return path.split('.').reduce((o, k) => (o || {})[k], obj);
    }

    const elements = (root === document)
        ? root.querySelectorAll('[data-i18n]')
        : root.querySelectorAll('[data-i18n]');

    elements.forEach(el => {
        const key = el.dataset.i18n;
        const text = getNestedValue(dict, key);
        if (text) {
            el.innerHTML = text;
            el.style.visibility = 'visible';
        }
    });
};

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
            const query = this.input.replace('#', '').toLowerCase()

            this.filtered = suggestions.filter(item =>
                item.toLowerCase().includes(query)
            ).slice(0, 5)
        },

        addTag(tag) {
            tag = tag.replace('#', '').toLowerCase()

            if (!this.tags.includes(tag) && tag.trim() !== '') {
                this.tags.push(tag)
            }

            this.input = ''
            this.filtered = []
        },

        removeTag(index) {
            this.tags.splice(index, 1)
        }
    }
}

window.tagInputEdit = function (allTech) {
    return {
        input: '',
        tags: [],
        filtered: [],
        allTech: allTech,

        setInitialTech() {
            if (window.currentEditTech) {
                try {
                    this.tags = JSON.parse(window.currentEditTech);
                } catch (e) {
                    this.tags = [];
                }
            }
        },

        search() {
            const query = this.input.replace('#', '').toLowerCase();

            this.filtered = this.allTech.filter(t =>
                t.toLowerCase().includes(query) &&
                !this.tags.includes(t)
            ).slice(0, 5);
        },

        addTag(tag) {
            tag = tag.replace('#', '').toLowerCase();

            if (!this.tags.includes(tag) && tag.trim() !== '') {
                this.tags.push(tag);
            }

            this.input = '';
            this.filtered = [];
        },

        removeTag(index) {
            this.tags.splice(index, 1);
        }
    }
}
window.imageUpload = function (config = {}) {
    return {

        max: 8,

        // untuk edit
        existingImages: config.existing ?? [],

        // untuk upload baru
        newImages: [],

        // untuk kirim ke backend (hapus lama)
        deletedImages: [],

        /*
        |--------------------------------------------------------------------------
        | TOTAL IMAGE COUNT
        |--------------------------------------------------------------------------
        */
        get totalImages() {
            return this.existingImages.length + this.newImages.length
        },

        /*
        |--------------------------------------------------------------------------
        | HANDLE FILE UPLOAD
        |--------------------------------------------------------------------------
        */
        /*
        |--------------------------------------------------------------------------
        | HANDLE FILE UPLOAD
        |--------------------------------------------------------------------------
        */
        handleFiles(event) {

            const files = Array.from(event.target.files)

            files.forEach(file => {

                if (this.totalImages >= this.max) return

                this.newImages.push({
                    file: file,
                    url: URL.createObjectURL(file)
                })

            })

            this.syncInput()
        },

        syncInput() {
            if (this.$refs.fileInput) {
                const dt = new DataTransfer()
                this.newImages.forEach(img => dt.items.add(img.file))
                this.$refs.fileInput.files = dt.files
            }
        },

        /*
        |--------------------------------------------------------------------------
        | REMOVE EXISTING IMAGE (EDIT MODE)
        |--------------------------------------------------------------------------
        */
        removeExisting(index) {

            const removed = this.existingImages.splice(index, 1)[0]

            if (removed?.path) {
                this.deletedImages.push(removed)
            }
        },

        /*
        |--------------------------------------------------------------------------
        | REMOVE NEW IMAGE
        |--------------------------------------------------------------------------
        */
        removeNew(index) {
            this.newImages.splice(index, 1)
            this.syncInput()
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
    try { heroAnimation(); } catch (e) { console.warn(e) }
    try { heroRibbonAnimation(); } catch (e) { console.warn(e) }
    try { heroFloatingCards(); } catch (e) { console.warn(e) }
    try { heroIconParallax(); } catch (e) { console.warn(e) }
    try { navbarFloatAnimation(); } catch (e) { console.warn(e) }
    try { navbarScrollEffect(); } catch (e) { console.warn(e) }
    try { aboutAnimation(); } catch (e) { console.warn(e) }
    try { projectAnimation(); } catch (e) { console.warn(e) }
    try { projectModalAnimation(); } catch (e) { console.warn(e) }
    try { initmodal(); } catch (e) { console.warn(e) }
});
