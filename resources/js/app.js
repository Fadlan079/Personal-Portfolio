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
import { initContactAnimations } from "./animations/contact";

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

function getThemeColors(theme) {
    const bg = theme === 'dark' ? '#0e0c12' : '#f8f9fa';
    let primary = getComputedStyle(document.documentElement).getPropertyValue('--color-primary').trim();
    if (!primary) primary = theme === 'dark' ? '#fbbf24' : '#2563eb';
    const border = theme === 'dark' ? '#1f1f2e' : '#e2e8f0';
    return { bg, primary, border };
}

function createWipeGrid(theme, textStr) {
    if (document.getElementById('sys-transition-overlay')) return null;

    const overlay = document.createElement('div');
    overlay.id = 'sys-transition-overlay';
    overlay.style.cssText = `
        position: fixed; top: 0; left: 0; width: 100vw; height: 100vh;
        z-index: 999999; display: flex; flex-wrap: wrap; pointer-events: none;
    `;

    const colors = getThemeColors(theme);
    const colCount = Math.ceil(window.innerWidth / 80);
    const rowCount = Math.ceil(window.innerHeight / 80);
    const totalBoxes = colCount * rowCount;

    for (let i = 0; i < totalBoxes; i++) {
        const box = document.createElement('div');
        box.classList.add('theme-glitch-box');

        let textContent = '';
        let fontColor = colors.bg;

        if (Math.random() > 0.85) {
            textContent = '0x' + Math.floor(Math.random() * 16777215).toString(16).toUpperCase();
            fontColor = colors.primary;
        }

        box.style.cssText = `
            width: ${100 / colCount}vw; height: ${100 / rowCount}vh; 
            background: ${colors.bg}; border: 1px solid ${colors.border};
            color: ${fontColor}; font-family: monospace; font-size: 10px;
            display: flex; align-items: center; justify-content: center;
            opacity: 0; transform: scale(0.9);
        `;
        box.innerText = textContent;
        overlay.appendChild(box);
    }

    const sysText = document.createElement('div');
    sysText.id = 'theme-sys-text';
    sysText.style.cssText = `
        position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);
        font-family: 'Space Grotesk', monospace; font-weight: bold; font-size: 1.25rem;
        color: ${colors.bg}; background: ${colors.primary}; padding: 12px 24px;
        z-index: 10; opacity: 0; text-transform: uppercase; letter-spacing: 0.2em;
    `;
    if (textStr) sysText.innerText = textStr;
    overlay.appendChild(sysText);

    document.body.appendChild(overlay);

    return { overlay, colCount, rowCount };
}

window.toggleTheme = function () {
    const savedTheme = localStorage.getItem(THEME_KEY) || getSystemTheme();
    const nextTheme = savedTheme === 'dark' ? 'light' : 'dark';

    const grid = createWipeGrid(nextTheme, `SYS.THEME_SWAP('${nextTheme.toUpperCase()}')`);
    if (!grid) return;

    const tl = gsap.timeline();

    tl.to('.theme-glitch-box', {
        scale: 1, opacity: 1, duration: 0.05,
        stagger: { amount: 0.4, grid: [grid.rowCount, grid.colCount], from: "random" },
        ease: "power0.none"
    })
        .to('#theme-sys-text', { opacity: 1, duration: 0.1 }, "-=0.2")
        .call(() => {
            localStorage.setItem(THEME_KEY, nextTheme);
            applyTheme(nextTheme);
        })
        .to('#theme-sys-text', { opacity: 0, duration: 0.1 }, "+=0.3")
        .to('.theme-glitch-box', { color: 'transparent', borderColor: 'transparent', duration: 0.1 })
        .to('.theme-glitch-box', {
            scale: 0.2, opacity: 0, duration: 0.15,
            stagger: { amount: 0.3, grid: [grid.rowCount, grid.colCount], from: "center" },
            ease: "expo.out"
        }, "+=0.1")
        .call(() => grid.overlay.remove());
};

function triggerPageWipe(url) {
    const savedTheme = localStorage.getItem(THEME_KEY) || getSystemTheme();
    const path = new URL(url).pathname || '/';
    const grid = createWipeGrid(savedTheme, `SYS.NAVIGATE('${path}')`);

    if (!grid) {
        window.location.href = url;
        return;
    }

    const tl = gsap.timeline();
    tl.to('.theme-glitch-box', {
        scale: 1, opacity: 1, duration: 0.05,
        stagger: { amount: 0.3, grid: [grid.rowCount, grid.colCount], from: "random" },
        ease: "power0.none"
    })
        .to('#theme-sys-text', { opacity: 1, duration: 0.1 }, "-=0.15")
        .call(() => {
            sessionStorage.setItem('sysTransition', 'true');
            window.location.href = url;
        });
}

document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (!link || !link.href) return; // Ignore non-links or links without href

    // Must be same origin
    const url = new URL(link.href, window.location.origin);
    if (url.origin !== window.location.origin) return;

    // Ignore anchors targeting the same page
    if (url.pathname === window.location.pathname && url.hash) return;

    // Ignore target blank
    if (link.target === '_blank') return;

    // Ignore javascript: links or specific protocols
    if (link.href.startsWith('javascript:') || link.href.includes('mailto:') || link.href.includes('tel:')) return;

    // Ignore download links, HTMX, or explicit no-transition elements
    if (link.hasAttribute('download') || link.hasAttribute('hx-get') || link.hasAttribute('hx-post') || link.closest('[hx-boost="true"]') || link.classList.contains('no-transition')) return;

    e.preventDefault();
    triggerPageWipe(link.href);
});

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

    // Translate placeholder attributes (inputs, textareas)
    root.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
        const key = el.dataset.i18nPlaceholder;
        const text = getNestedValue(dict, key);
        if (text) el.placeholder = text;
    });
};

const langToggle = document.getElementById('langToggle');

let currentLocale = document.documentElement.lang || 'id';

langToggle?.addEventListener('click', async () => {
    const next = currentLocale === 'id' ? 'en' : 'id';

    const savedTheme = localStorage.getItem(THEME_KEY) || getSystemTheme();
    const grid = createWipeGrid(savedTheme, `SYS.LANG_SWAP('${next.toUpperCase()}')`);

    if (!grid) return; // Prevent spamming

    const tl = gsap.timeline();

    // Wipe IN
    tl.to('.theme-glitch-box', {
        scale: 1, opacity: 1, duration: 0.05,
        stagger: { amount: 0.3, grid: [grid.rowCount, grid.colCount], from: "random" },
        ease: "power0.none"
    })
        .to('#theme-sys-text', { opacity: 1, duration: 0.1 }, "-=0.15")

        // Execute logic while screen is covered
        .call(async () => {
            tl.pause(); // Pause exactly when screen is covered
            await loadLanguage(next);
            localStorage.setItem('locale', next);
            document.cookie = `locale=${next};path=/;max-age=31536000`;
            currentLocale = next;
            updateLangIcon(next);

            // Resume timeline AFTER language is loaded
            tl.play();
        })

         // Wipe OUT (after resume)
        tl.to('#theme-sys-text', { opacity: 0, duration: 0.1 }, "+=0.3")
            .to('.theme-glitch-box', { color: 'transparent', borderColor: 'transparent', duration: 0.1 })
            .to('.theme-glitch-box', {
                scale: 0.2, opacity: 0, duration: 0.15,
                stagger: { amount: 0.3, grid: [grid.rowCount, grid.colCount], from: "center" },
                ease: "expo.out"
            }, "+=0.1")

            // Cleanup
                .call(() => grid.overlay.remove());
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
    // ---------------------------------
    // TRANSITION OUT ON PAGE LOAD
    // ---------------------------------
    if (sessionStorage.getItem('sysTransition')) {
        sessionStorage.removeItem('sysTransition');

        const styleRemover = document.getElementById('sys-trans-style');
        if (styleRemover) styleRemover.remove();
        document.documentElement.classList.remove('hide-for-transition');
        document.body.style.visibility = 'visible';

        const savedTheme = localStorage.getItem(THEME_KEY) || getSystemTheme();
        const grid = createWipeGrid(savedTheme, '');

        if (grid) {
            // Pre-fill the screen
            gsap.set('.theme-glitch-box', { scale: 1, opacity: 1 });
            gsap.set('.theme-glitch-box', { color: 'transparent', borderColor: 'transparent' });
            gsap.set('#theme-sys-text', { opacity: 0 });

            // Stagger out 
            gsap.to('.theme-glitch-box', {
                scale: 0.2, opacity: 0, duration: 0.15,
                stagger: { amount: 0.3, grid: [grid.rowCount, grid.colCount], from: "center" },
                ease: "expo.out",
                onComplete: () => grid.overlay.remove()
            });
        }
    }

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
    try { initContactAnimations(); } catch (e) { console.warn(e) }
});
