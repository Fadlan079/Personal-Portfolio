<style>
/* ============================================================
   SKILL TREE — Assassin's Creed Origins / Grid Style
   Straight orthogonal connector lines, diamond layout
   ============================================================ */

#skt-section {
    position: relative;
    background: var(--color-bg);
    overflow: hidden;
}

/* Subtle golden particle shimmer — background */
#skt-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background:
        radial-gradient(ellipse 80% 50% at 50% 50%, rgba(251,191,36,0.04) 0%, transparent 65%),
        radial-gradient(ellipse 60% 80% at 15% 50%, rgba(56,189,248,0.03) 0%, transparent 55%),
        radial-gradient(ellipse 60% 80% at 85% 50%, rgba(251,146,60,0.03) 0%, transparent 55%);
    pointer-events: none;
    z-index: 0;
}

/* Grid dots overlay (AC Origins map feel) */
#skt-section::after {
    content: '';
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle, rgba(255,255,255,0.025) 1px, transparent 1px);
    background-size: 28px 28px;
    pointer-events: none;
    z-index: 0;
}

/* ── Wrapper ── */
.skt-wrap {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* ── Section title ── */
.skt-title-label {
    font-family: 'Space Grotesk', sans-serif;
    font-size: clamp(0.9rem, 2vw, 1.2rem);
    font-weight: 700;
    letter-spacing: 0.4em;
    text-transform: uppercase;
    color: var(--color-text);
    opacity: 0.9;
}
.skt-title-label::after {
    display: none;
}

/* ── SVG canvas (the whole tree is pure SVG) ── */
#sktSvgCanvas {
    width: 100%;
    max-width: 960px;
    display: block;
    overflow: visible;
    margin: 0 auto;
}

/* ── Node circle (foreignObject content) ── */
.skt-fo {
    overflow: visible;
}
.skt-node-el {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50%;
    background: rgba(28, 26, 30, 0.9);
    border: 1.5px solid rgba(200,185,155,0.35);
    box-shadow:
        0 0 0 3px rgba(200,185,155,0.06),
        inset 0 1px 0 rgba(255,255,255,0.05);
    cursor: pointer;
    transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
    position: relative;
    box-sizing: border-box;
}
.skt-node-el:hover,
.skt-node-el.active {
    border-color: var(--nc, #fbbf24);
    background: rgba(40, 36, 28, 0.95);
    box-shadow:
        0 0 0 3px rgba(200,185,155,0.08),
        0 0 14px var(--nc, rgba(251,191,36,0.6)),
        0 0 28px var(--nc, rgba(251,191,36,0.2)),
        inset 0 1px 0 rgba(255,255,255,0.08);
}
.skt-node-el i {
    font-size: inherit;
    color: rgba(210,200,185,0.6);
    transition: color 0.25s;
    pointer-events: none;
}
.skt-node-el:hover i,
.skt-node-el.active i {
    color: var(--nc, #fbbf24);
}

/* Pulse ring on active */
.skt-node-el.active::after {
    content: '';
    position: absolute;
    inset: -5px;
    border-radius: 50%;
    border: 1.5px solid var(--nc, #fbbf24);
    animation: skt-ac-pulse 2s ease-in-out infinite;
    pointer-events: none;
}
@keyframes skt-ac-pulse {
    0%, 100% { opacity: 0.7; transform: scale(1); }
    50%       { opacity: 0;   transform: scale(1.45); }
}

/* ── SVG connector lines ── */
.skt-edge {
    fill: none;
    stroke: rgba(200,185,155,0.18);
    stroke-width: 1.5;
    stroke-linecap: square;
    transition: stroke 0.3s, stroke-width 0.3s;
}
.skt-edge-active {
    stroke: rgba(251,191,36,0.7);
    stroke-width: 2;
}

/* ── Node label ── */
.skt-nlabel {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.5rem;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    fill: rgba(200,185,155,0.55);
    text-anchor: middle;
    dominant-baseline: hanging;
    pointer-events: none;
    transition: fill 0.25s;
}
.skt-nlabel.active { fill: rgba(251,191,36,0.85); }

/* ── Category labels ── */
.skt-cat-text {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.7rem;
    font-weight: 700;
    letter-spacing: 0.3em;
    text-transform: uppercase;
    pointer-events: none;
}
.skt-cat-sub {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.45rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    opacity: 0.4;
    pointer-events: none;
}

/* ── Tooltip ── */
.skt-tip {
    position: fixed;
    z-index: 9999;
    pointer-events: none;
    opacity: 0;
    transition: opacity 0.2s ease;
    width: 210px;
}
.skt-tip.show { opacity: 1; }
.skt-tip-inner {
    background: rgba(18, 16, 20, 0.97);
    border: 1px solid rgba(200,185,155,0.18);
    box-shadow: 0 0 24px rgba(0,0,0,0.7), 0 0 0 1px rgba(0,0,0,0.5);
    padding: 12px 14px;
    backdrop-filter: blur(16px);
}
.skt-tip-cat {
    font-size: 0.52rem;
    font-weight: 700;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    margin-bottom: 3px;
    border-bottom: 1px solid rgba(200,185,155,0.1);
    padding-bottom: 4px;
}
.skt-tip-name {
    font-size: 0.9rem;
    font-weight: 700;
    font-family: 'Space Grotesk', sans-serif;
    color: var(--color-text);
    margin: 5px 0 2px;
}
.skt-tip-sub {
    font-size: 0.6rem;
    color: var(--color-muted);
    font-style: italic;
    margin-bottom: 8px;
}
.skt-tip-items {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 3px;
}
.skt-tip-items li {
    font-size: 0.58rem;
    color: rgba(200,185,155,0.7);
    display: flex;
    gap: 5px;
    line-height: 1.4;
}
.skt-tip-items li::before {
    content: '▸';
    flex-shrink: 0;
    opacity: 0.6;
    margin-top: 1px;
}

/* ── Bottom bar ── */
.skt-bar {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    padding-top: 2px;
}
.skt-bar-line {
    width: 100px;
    height: 1px;
    background: rgba(200,185,155,0.15);
    position: relative;
}
.skt-bar-gem {
    position: absolute;
    left: 50%; top: 50%;
    transform: translate(-50%, -50%) rotate(45deg);
    width: 7px; height: 7px;
    border: 1.5px solid rgba(251,191,36,0.6);
    background: rgba(251,191,36,0.15);
    box-shadow: 0 0 6px rgba(251,191,36,0.4);
}
.skt-bar-txt {
    font-size: 0.5rem;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: rgba(200,185,155,0.4);
    font-family: 'Space Grotesk', sans-serif;
}

/* line draw animation */
.skt-edge-anim {
    stroke-dashoffset: 0 !important;
    transition: stroke-dashoffset 0.8s ease !important;
}
</style>

{{-- ====================================================
     SKILL TREE — AC Origins Grid / Orthogonal Style
     ==================================================== --}}
<section id="skt-section" class="py-16 sm:py-24">
<div class="skt-wrap max-w-6xl mx-auto px-4">

    {{-- Title --}}
    <div class="text-center mb-6 sm:mb-10">
        <p class="skt-title-label" data-i18n="skills"></p>
    </div>

    {{-- The entire tree is drawn by JS into this SVG --}}
    <svg id="sktSvgCanvas" viewBox="0 0 960 520" preserveAspectRatio="xMidYMid meet">
        <defs>
            <filter id="skt-glow-f" x="-50%" y="-50%" width="200%" height="200%">
                <feGaussianBlur stdDeviation="3.5" result="b"/>
                <feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
            </filter>
            <filter id="skt-glow-sm" x="-40%" y="-40%" width="180%" height="180%">
                <feGaussianBlur stdDeviation="2" result="b"/>
                <feMerge><feMergeNode in="b"/><feMergeNode in="SourceGraphic"/></feMerge>
            </filter>
        </defs>

        {{-- All content injected by JS --}}
        <g id="sktEdgeLayer"></g>
        <g id="sktNodeLayer"></g>
        <g id="sktLabelLayer"></g>
        <g id="sktCatLayer"></g>
    </svg>

    {{-- Bottom decorative bar --}}
    <div class="skt-bar mt-1">
        <div class="skt-bar-line"><div class="skt-bar-gem"></div></div>
        <span class="skt-bar-txt">Skill Points</span>
        <div class="skt-bar-line"><div class="skt-bar-gem"></div></div>
    </div>

</div>
</section>

{{-- Fixed tooltip --}}
<div class="skt-tip" id="sktTip">
    <div class="skt-tip-inner">
        <p class="skt-tip-cat" id="sTipCat"></p>
        <p class="skt-tip-name" id="sTipName"></p>
        <p class="skt-tip-sub"  id="sTipSub"></p>
        <ul class="skt-tip-items" id="sTipItems"></ul>
    </div>
</div>

<script>
(function () {
/* ================================================================
   SKILL TREE — AC Origins Orthogonal Grid
   Layout: diamond / rhombus shape, straight L-shaped connectors
   ================================================================ */

/* ----------------------------------------------------------
   DATA
   ---------------------------------------------------------- */
const SKILLS = [
    {
        id: 'core',
        icon: 'fa-solid fa-code',
        label: 'SKILLS',
        color: '#fbbf24',
        cat: null, catColor: null,
        subtitle: '', items: [],
        size: 38,          /* circle radius */
    },
    /* ── BACKEND ── */
    {
        id: 'laravel',
        icon: 'fa-brands fa-laravel',
        label: 'Laravel',
        color: '#f87171',
        cat: 'BACKEND', catColor: '#f87171',
        subtitle: 'Backend utama & MVC framework',
        items: ['Autentikasi & user management','CRUD & validasi data','REST API dasar','Integrasi database MySQL'],
        size: 28,
    },
    {
        id: 'php',
        icon: 'fa-brands fa-php',
        label: 'PHP',
        color: '#818cf8',
        cat: 'BACKEND', catColor: '#f87171',
        subtitle: 'Logika backend & server-side',
        items: ['CRUD & pengolahan data','Session & Autentikasi','Validasi form & request','Integrasi MySQL'],
        size: 26,
    },
    {
        id: 'mysql',
        icon: 'fa-solid fa-database',
        label: 'MySQL',
        color: '#38bdf8',
        cat: 'BACKEND', catColor: '#f87171',
        subtitle: 'Manajemen database relasional',
        items: ['Query CRUD & filtering','Perancangan tabel & relasi','Normalisasi data & anomali','Integrasi PHP & Laravel'],
        size: 26,
    },
    /* ── FRONTEND ── */
    {
        id: 'html',
        icon: 'fa-brands fa-html5',
        label: 'HTML',
        color: '#fb923c',
        cat: 'FRONTEND', catColor: '#38bdf8',
        subtitle: 'Struktur halaman web',
        items: ['Struktur semantik HTML','Integrasi CSS & JavaScript','Optimasi SEO dasar','Pemisahan konten & presentasi'],
        size: 26,
    },
    {
        id: 'css',
        icon: 'fa-brands fa-css3-alt',
        label: 'CSS',
        color: '#38bdf8',
        cat: 'FRONTEND', catColor: '#38bdf8',
        subtitle: 'Styling & responsive layout',
        items: ['Responsive layout Tailwind','Komponen Bootstrap','Spacing, warna & tipografi','Konsistensi UI'],
        size: 26,
    },
    {
        id: 'js',
        icon: 'fa-brands fa-js',
        label: 'JavaScript',
        color: '#fbbf24',
        cat: 'FRONTEND', catColor: '#38bdf8',
        subtitle: 'Interaksi sisi klien',
        items: ['Manipulasi DOM','Validasi form sederhana','UI & animasi dinamis','Integrasi backend via AJAX'],
        size: 28,
    },
    /* ── TOOLS ── */
    {
        id: 'python',
        icon: 'fa-brands fa-python',
        label: 'Python',
        color: '#fbbf24',
        cat: 'TOOLS', catColor: '#a3e635',
        subtitle: 'Scripting & logika dasar',
        items: ['Dasar pemrograman Python','Pengolahan data sederhana','Automasi & scripting kecil','Eksplorasi library'],
        size: 24,
    },
    {
        id: 'linux',
        icon: 'fa-brands fa-linux',
        label: 'Linux',
        color: '#a3e635',
        cat: 'TOOLS', catColor: '#a3e635',
        subtitle: 'Server & deployment environment',
        items: ['Manajemen file & permission','Konfigurasi web server', 'Deployment aplikasi web','Penggunaan terminal CLI'],
        size: 24,
    },
];

/* Build a lookup */
const BY_ID = {};
SKILLS.forEach(s => BY_ID[s.id] = s);

/* ----------------------------------------------------------
   LAYOUT — fixed grid coordinates in a 960×520 viewBox
   Designed to look like a diamond / rhombus tree
   (x=480, y=260 is the center)

   The layout mimics AC Origins:
     - horizontal center column (top → bottom)
     - branches spread left and right with orthogonal lines
   ---------------------------------------------------------- */
/* ──────────────────────────────────────────────────────────
   GRID LAYOUT  (960 × 540 viewBox)
 
   Column X values:  160  300  480  660  800
   Row    Y values:   80  180  290  400  480
 
   Nodes deliberately share X or Y so L-shaped paths are
   visually straight (horizontal leg + vertical leg).
   ────────────────────────────────────────────────────────── */
const POS = {
    /* top-center hub */
    core:    { x: 480, y:  80 },

    /* row 1 — same X column as core → pure vertical line */
    php:     { x: 480, y: 180 },

    /* row 2 — left & right, same Y row */
    laravel: { x: 300, y: 290 },
    js:      { x: 480, y: 290 },      /* same X as php */
    mysql:   { x: 660, y: 290 },

    /* row 3 — same Y row */
    html:    { x: 300, y: 400 },      /* same X as laravel */
    css:     { x: 660, y: 400 },      /* same X as mysql */

    /* row 4 — outermost, same Y as html/css */
    python:  { x: 160, y: 400 },      /* same Y as html */
    linux:   { x: 800, y: 400 },      /* same Y as css  */
};

/* Edges — each pair shares an X or Y coordinate so the
   L-shaped path has one zero-length leg (appears straight)
   or both legs are clearly orthogonal.                   */
const EDGES = [
    /* vertical: core → php (same X=480) */
    ['core',    'php'    ],
    /* php branches: down then left / right */
    ['php',     'laravel'],    /* x:480→300, y:180→290 */
    ['php',     'js'     ],    /* straight down same X  */
    ['php',     'mysql'  ],    /* x:480→660, y:180→290 */
    /* horizontal same-row connections */
    ['laravel', 'js'     ],    /* same Y=290 straight   */
    ['js',      'mysql'  ],    /* same Y=290 straight   */
    /* down: laravel→html (same X=300), mysql→css (same X=660) */
    ['laravel', 'html'   ],
    ['mysql',   'css'    ],
    /* outer: html→python (same Y=400), css→linux (same Y=400) */
    ['html',    'python' ],
    ['css',     'linux'  ],
];

/* ----------------------------------------------------------
   SVG Elements
   ---------------------------------------------------------- */
const svg        = document.getElementById('sktSvgCanvas');
const edgeLayer  = document.getElementById('sktEdgeLayer');
const nodeLayer  = document.getElementById('sktNodeLayer');
const labelLayer = document.getElementById('sktLabelLayer');
const catLayer   = document.getElementById('sktCatLayer');
const tip        = document.getElementById('sktTip');

let activeId = null;

const NS = 'http://www.w3.org/2000/svg';
function el(tag, attrs) {
    const e = document.createElementNS(NS, tag);
    Object.entries(attrs || {}).forEach(([k,v]) => e.setAttribute(k, v));
    return e;
}

/* ----------------------------------------------------------
   Draw orthogonal (L-shaped) path between two points
   ---------------------------------------------------------- */
function orthogonalPath(x1, y1, x2, y2) {
    /* Go down (or up) to the target Y first, then across.
       This produces a clean Γ / L shape that matches AC Origins. */
    if (x1 === x2) {
        /* Pure vertical — single segment */
        return `M ${x1} ${y1} L ${x2} ${y2}`;
    }
    if (y1 === y2) {
        /* Pure horizontal — single segment */
        return `M ${x1} ${y1} L ${x2} ${y2}`;
    }
    /* L-shape: go vertical from source to target Y, then horizontal */
    return `M ${x1} ${y1} L ${x1} ${y2} L ${x2} ${y2}`;
}

/* ----------------------------------------------------------
   BUILD EDGES
   ---------------------------------------------------------- */
function buildEdges() {
    edgeLayer.innerHTML = '';
    EDGES.forEach(([fromId, toId]) => {
        const f = POS[fromId], t = POS[toId];
        const d = orthogonalPath(f.x, f.y, t.x, t.y);
        const len = Math.abs(t.x - f.x) + Math.abs(t.y - f.y);

        const path = el('path', {
            d,
            class: 'skt-edge',
            'stroke-dasharray': len,
            'stroke-dashoffset': len,
            'data-from': fromId,
            'data-to':   toId,
        });
        edgeLayer.appendChild(path);

        /* Animate draw */
        requestAnimationFrame(() => {
            path.style.transition = `stroke-dashoffset ${0.6 + len / 800}s ease`;
            path.style.strokeDashoffset = '0';
        });
    });
}

/* ----------------------------------------------------------
   BUILD NODES
   ---------------------------------------------------------- */
function buildNodes() {
    nodeLayer.innerHTML  = '';
    labelLayer.innerHTML = '';

    SKILLS.forEach(skill => {
        const { x, y } = POS[skill.id];
        const r = skill.size;

        /* Circle */
        const circle = el('circle', {
            cx: x, cy: y, r,
            fill:           'rgba(28,26,30,0.92)',
            stroke:         'rgba(200,185,155,0.32)',
            'stroke-width': '1.5',
            'data-id':      skill.id,
            style:          `cursor:pointer;transition:stroke 0.25s,filter 0.25s;`,
        });
        circle.addEventListener('mouseenter', (e) => showTip(skill, e));
        circle.addEventListener('mousemove',  (e) => moveTip(e));
        circle.addEventListener('mouseleave', hideTip);
        circle.addEventListener('click',      ()  => toggleActive(skill.id));
        nodeLayer.appendChild(circle);

        /* Icon via foreignObject */
        const fsize = r * 0.88;
        const fo = el('foreignObject', {
            x: x - fsize / 2,
            y: y - fsize / 2,
            width: fsize, height: fsize,
            style: 'pointer-events:none;overflow:visible;',
        });
        const div = document.createElement('div');
        div.style.cssText = `
            width:${fsize}px;height:${fsize}px;
            display:flex;align-items:center;justify-content:center;
            font-size:${fsize * 0.58}px;
            color:rgba(210,200,185,0.6);
            transition:color 0.25s;
        `;
        div.dataset.id = skill.id;
        const icon = document.createElement('i');
        icon.className = skill.icon;
        icon.setAttribute('aria-hidden', 'true');
        div.appendChild(icon);
        fo.appendChild(div);
        nodeLayer.appendChild(fo);

        /* Label below node */
        const gap = r + 12;
        const lbl = el('text', {
            x, y: y + gap,
            class:          'skt-nlabel',
            'data-lbl':     skill.id,
            'font-size':    '7.5',
        });
        lbl.textContent = skill.label;
        labelLayer.appendChild(lbl);
    });
}

/* ----------------------------------------------------------
   CATEGORY LABELS (sides)
   ---------------------------------------------------------- */
function buildCatLabels() {
    catLayer.innerHTML = '';

    const cats = [
        { label: 'BACKEND',  sub: 'Server · Database · API', color: '#f87171',  x: 52,  y: 290, anchor: 'middle', angle: -90 },
        { label: 'FRONTEND', sub: 'UI · Markup · Styling',   color: '#38bdf8',  x: 908, y: 290, anchor: 'middle', angle:  90 },
        { label: 'TOOLS',    sub: 'Scripting · DevOps',      color: '#a3e635',  x: 480, y: 470, anchor: 'middle', angle:   0 },
    ];

    cats.forEach(c => {
        const g = el('g', { transform: `translate(${c.x},${c.y}) rotate(${c.angle})` });

        const t1 = el('text', {
            class: 'skt-cat-text',
            'text-anchor': 'middle',
            'dominant-baseline': 'middle',
            fill: c.color,
            'font-size': '9',
            y: '-6',
        });
        t1.textContent = c.label;

        const t2 = el('text', {
            class: 'skt-cat-sub',
            'text-anchor': 'middle',
            'dominant-baseline': 'middle',
            fill: c.color,
            'font-size': '6',
            y: '5',
        });
        t2.textContent = c.sub;

        /* Decorative line */
        const ln1 = el('line', { x1: -30, y1: -14, x2: 30, y2: -14,
            stroke: c.color, 'stroke-width': '0.5', opacity: '0.3' });

        g.appendChild(ln1);
        g.appendChild(t1);
        g.appendChild(t2);
        catLayer.appendChild(g);
    });
}

/* ----------------------------------------------------------
   ACTIVE / HIGHLIGHT
   ---------------------------------------------------------- */
function toggleActive(id) {
    const prev = activeId;
    activeId = (activeId === id) ? null : id;

    /* Update circles */
    nodeLayer.querySelectorAll('circle').forEach(c => {
        const cid = c.dataset.id;
        const skill = BY_ID[cid];
        const isActive = cid === activeId;
        c.setAttribute('stroke', isActive ? skill.color : 'rgba(200,185,155,0.32)');
        c.setAttribute('fill',   isActive ? 'rgba(40,36,28,0.95)' : 'rgba(28,26,30,0.92)');
        c.style.filter = isActive ? `drop-shadow(0 0 8px ${skill.color})` : '';
    });

    /* Update icon colors */
    nodeLayer.querySelectorAll('[data-id]').forEach(d => {
        const skill = BY_ID[d.dataset.id];
        if (!skill) return;
        d.style.color = d.dataset.id === activeId ? skill.color : 'rgba(210,200,185,0.6)';
    });

    /* Update labels */
    labelLayer.querySelectorAll('[data-lbl]').forEach(t => {
        t.setAttribute('fill', t.dataset.lbl === activeId
            ? BY_ID[t.dataset.lbl].color
            : 'rgba(200,185,155,0.55)');
    });

    /* Update edges */
    edgeLayer.querySelectorAll('.skt-edge').forEach(p => {
        const f = p.dataset.from, t = p.dataset.to;
        const lit = (f === activeId || t === activeId);
        const col = lit ? (BY_ID[f || t]?.color || '#fbbf24') : 'rgba(200,185,155,0.18)';
        p.setAttribute('stroke', col);
        p.setAttribute('stroke-width', lit ? '2.5' : '1.5');
        p.style.filter = lit ? `drop-shadow(0 0 4px ${col})` : '';
    });
}

/* ----------------------------------------------------------
   TOOLTIP
   ---------------------------------------------------------- */
function showTip(skill, e) {
    if (!skill.items.length) return;
    document.getElementById('sTipCat').textContent  = skill.cat || '';
    document.getElementById('sTipCat').style.color  = skill.catColor || '#fbbf24';
    document.getElementById('sTipName').textContent = skill.label;
    document.getElementById('sTipSub').textContent  = skill.subtitle;
    document.getElementById('sTipItems').innerHTML  =
        skill.items.map(i => `<li>${i}</li>`).join('');
    tip.style.borderTopColor = skill.catColor || '#fbbf24';
    moveTip(e);
    tip.classList.add('show');
}
function moveTip(e) {
    const TW = 220, TH = 160;
    let tx = e.clientX + 18;
    let ty = e.clientY - TH / 2;
    if (tx + TW > window.innerWidth)  tx = e.clientX - TW - 18;
    if (ty < 8)                        ty = 8;
    if (ty + TH > window.innerHeight)  ty = window.innerHeight - TH - 8;
    tip.style.left = tx + 'px';
    tip.style.top  = ty + 'px';
}
function hideTip() { tip.classList.remove('show'); }

/* ----------------------------------------------------------
   HOVER HIGHLIGHT (lighter than active)
   ---------------------------------------------------------- */
nodeLayer.addEventListener('mouseover', (e) => {
    const circle = e.target.closest('circle[data-id]');
    if (!circle) return;
    const id = circle.dataset.id;
    const skill = BY_ID[id];
    if (id === activeId) return;
    circle.setAttribute('stroke', skill.color);
    circle.style.filter = `drop-shadow(0 0 6px ${skill.color})`;
});
nodeLayer.addEventListener('mouseout', (e) => {
    const circle = e.target.closest('circle[data-id]');
    if (!circle) return;
    const id = circle.dataset.id;
    if (id === activeId) return;
    circle.setAttribute('stroke', 'rgba(200,185,155,0.32)');
    circle.style.filter = '';
});

/* ----------------------------------------------------------
   INIT
   ---------------------------------------------------------- */
buildEdges();
buildNodes();
buildCatLabels();

/* ----------------------------------------------------------
   ANIMATE EDGES IN when section scrolls into view
   ---------------------------------------------------------- */
const observer = new IntersectionObserver(entries => {
    entries.forEach(e => {
        if (!e.isIntersecting) return;
        /* Reset then re-draw */
        edgeLayer.querySelectorAll('.skt-edge').forEach(p => {
            const len = parseFloat(p.getAttribute('stroke-dasharray')) || 400;
            p.style.transition = 'none';
            p.style.strokeDashoffset = len;
            requestAnimationFrame(() => {
                p.style.transition = `stroke-dashoffset ${0.6 + len / 800}s ease`;
                p.style.strokeDashoffset = '0';
            });
        });
        observer.unobserve(e.target);
    });
}, { threshold: 0.15 });
observer.observe(document.getElementById('skt-section'));

})();
</script>
