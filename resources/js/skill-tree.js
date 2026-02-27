import { gsap } from 'gsap';

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('skill-tree-container');
    const svgLayer = document.getElementById('skill-tree-lines');

    if (!container || !svgLayer) return;

    // Fetch dynamic data from the container's data attribute
    let skillsData = [];
    try {
        skillsData = JSON.parse(container.dataset.skills || '[]');
    } catch (e) {
        console.error("Failed to parse skills data from database.", e);
    }

    const categories = {
        frontend: { id: 'branch-frontend', label: 'Frontend', category: 'frontend', icon: '<i class="fa-regular fa-window-maximize"></i>', radius: 120, angle: 180, children: [], projects_count: 1 },
        backend: { id: 'branch-backend', label: 'Backend', category: 'backend', icon: '<i class="fa-solid fa-server"></i>', radius: 120, angle: 300, children: [], projects_count: 1 },
        tools: { id: 'branch-tools', label: 'Tools', category: 'tools', icon: '<i class="fa-solid fa-toolbox"></i>', radius: 120, angle: 60, children: [], projects_count: 1 }
    };

    // Distribute skills into categories
    skillsData.forEach((skill) => {
        let catStr = skill.category || 'tools';
        if (!categories[catStr]) catStr = 'tools';

        categories[catStr].children.push({
            id: 'skill-' + skill.id,
            label: skill.name,
            category: catStr,
            icon: skill.icon,
            projects_count: skill.projects_count || 0,
            radius: 240, // computed dynamically below
            angle: 0 // computed dynamically below
        });
    });

    // Hierarchical clustering for dynamic tree branching
    Object.values(categories).forEach(cat => {
        const skillsToPlace = [...cat.children];
        cat.children = [];
        cat.layerLevel = 0;

        let queue = [cat];

        while (skillsToPlace.length > 0 && queue.length > 0) {
            const parentNode = queue.shift();
            // Capacity: inner categories have more branches, outer tools have less
            const capacity = (parentNode === cat) ? 5 : 3;
            const numToTake = Math.min(capacity, skillsToPlace.length);

            if (!parentNode.children) parentNode.children = [];

            for (let i = 0; i < numToTake; i++) {
                const child = skillsToPlace.shift();

                if (parentNode === cat) {
                    child.radius = 280; // Increased from 240
                    child.layerLevel = 1;
                } else {
                    child.radius = parentNode.radius + 120; // Increased spacing from 95
                    child.layerLevel = parentNode.layerLevel + 1;
                }

                parentNode.children.push(child);
                queue.push(child);
            }
        }
    });

    // Compute angles recursively to prevent overlapping intersections
    function computeAngles(node, angleSpan, centerAngle) {
        if (!node.children || node.children.length === 0) return;

        const numNodes = node.children.length;
        const startAngle = centerAngle - (angleSpan / 2);
        const step = numNodes > 1 ? angleSpan / (numNodes - 1) : 0;

        node.children.forEach((child, i) => {
            child.angle = numNodes === 1 ? centerAngle : startAngle + (i * step);
            // Each child gets a smaller/tighter angle span to expand into
            const childSpan = angleSpan / (numNodes * 0.7); // Looser span threshold
            computeAngles(child, childSpan, child.angle);
        });
    }

    Object.values(categories).forEach(cat => {
        computeAngles(cat, 130, cat.angle); // Wider default span string for primary branches is 130 degree
    });

    const treeData = {
        id: 'root',
        label: 'Developer',
        category: 'core',
        icon: '<i class="fa-solid fa-code"></i>',
        radius: 0,
        angle: 0,
        projects_count: 1,
        children: Object.values(categories).filter(c => c.children.length > 0) // only show active branches
    };

    const nodes = [];
    const links = [];

    // Process nodes to calculate positions and prepare links
    function processNode(node, parent = null) {
        const rad = node.angle * (Math.PI / 180);
        node.x = Math.cos(rad) * node.radius;
        node.y = Math.sin(rad) * node.radius;

        if (parent) {
            links.push({ source: parent, target: node });
        }

        nodes.push(node);

        if (node.children) {
            node.children.forEach(child => processNode(child, node));
        }
    }

    processNode(treeData, null);

    // Color mapping for categories
    const colors = {
        core: '#ffffff',
        frontend: '#38bdf8', // Tailwind light blue
        backend: '#f87171', // Red
        tools: '#facc15'    // Yellow
    };

    // Create node DOM elements
    nodes.forEach(node => {
        const el = document.createElement('div');
        const isRoot = node.id === 'root';
        const isCategory = ['branch-frontend', 'branch-backend', 'branch-tools'].includes(node.id);

        let size = 55;
        let fontSize = 28;
        if (isRoot) { size = 80; fontSize = 36; }
        else if (isCategory) { size = 65; fontSize = 28; }
        else if (node.layerLevel === 2) { size = 45; fontSize = 20; }
        else if (node.layerLevel >= 3) { size = 35; fontSize = 16; }

        const isLocked = node.projects_count === 0;

        // Visual lock state logic
        const lockClass = isLocked ? 'opacity-50 grayscale border-dashed cursor-not-allowed' : 'cursor-pointer';
        const nodeColor = isLocked ? 'var(--color-muted)' : colors[node.category];

        el.className = `skill-node absolute flex items-center justify-center rounded-full border border-border bg-surface z-10 transition-colors duration-300 ${lockClass}`;
        el.style.width = `${size}px`;
        el.style.height = `${size}px`;

        el.style.left = `calc(50% + ${node.x}px - ${size / 2}px)`;
        el.style.top = `calc(50% + ${node.y}px - ${size / 2}px)`;

        // Add lock overlay icon if locked
        let lockOverlay = isLocked ? `<div class="absolute -bottom-1 -right-1 bg-surface rounded-full p-1 border border-border text-[10px] text-muted"><i class="fa-solid fa-lock"></i></div>` : '';

        // Status tooltip text
        const isBranch = node.children && node.children.length > 0;
        const statusText = isLocked ? `${node.label} (Locked)` : (isRoot || isCategory ? node.label : `${node.label} (${node.projects_count} Projects)`);

        el.innerHTML = `
            <div class="flex items-center justify-center transition-colors duration-300" style="color: ${nodeColor}; font-size: ${fontSize}px;">${node.icon}</div>
            ${lockOverlay}
            <!-- Tooltip -->
            <div class="skill-tooltip absolute -top-10 left-1/2 -translate-x-1/2 px-3 py-1 bg-surface border border-border text-xs text-text rounded opacity-0 pointer-events-none whitespace-nowrap z-20 font-semibold tracking-wide" style="box-shadow: 0 4px 12px rgba(0,0,0,0.5)">
                ${statusText}
            </div>
            
            <!-- Glow background -->
            <div class="skill-glow absolute inset-0 rounded-full opacity-0 pointer-events-none transition-opacity duration-300" 
                 style="box-shadow: 0 0 25px ${isLocked ? 'rgba(255,255,255,0.2)' : colors[node.category]}; mix-blend-mode: screen;"></div>
        `;

        node.el = el;
        container.appendChild(el);

        // Hover events for glow and tooltip
        el.addEventListener('mouseenter', () => {
            gsap.to(el.querySelector('.skill-tooltip'), { opacity: 1, y: -5, duration: 0.3 });
            if (!isLocked) {
                gsap.to(el.querySelector('.skill-glow'), { opacity: isRoot ? 0.3 : 0.6, scale: 1.1, duration: 0.3 });
                gsap.to(el, { scale: 1.15, borderColor: colors[node.category], duration: 0.4, ease: 'back.out(1.5)', zIndex: 30 });

                // Highlight connections where this is target
                const relatedLines = Array.from(document.querySelectorAll('.skill-link')).filter(
                    line => line.dataset.source === node.id || line.dataset.target === node.id
                );
                gsap.to(relatedLines, { stroke: colors[node.category], strokeWidth: 3, opacity: 1, duration: 0.3 });
            } else {
                gsap.to(el, { scale: 1.05, duration: 0.4, ease: 'power2.out', zIndex: 30 });
            }
        });

        el.addEventListener('mouseleave', () => {
            gsap.to(el.querySelector('.skill-tooltip'), { opacity: 0, y: 0, duration: 0.3 });
            gsap.to(el.querySelector('.skill-glow'), { opacity: 0, scale: 1, duration: 0.3 });
            gsap.to(el, { scale: 1, borderColor: 'var(--color-border)', duration: 0.4, ease: 'power2.out', zIndex: 10 });

            const relatedLines = Array.from(document.querySelectorAll('.skill-link'));
            gsap.to(relatedLines, { stroke: 'var(--color-border)', strokeWidth: 2, opacity: 0.4, duration: 0.3 });
        });

        // Click to redirect
        el.addEventListener('click', () => {
            if (!isLocked && !isRoot && !isCategory) {
                const url = `/projects?search=${encodeURIComponent(node.label)}`;
                window.location.href = url;
            }
        });
    });

    // Draw connecting lines with dynamic ViewBox for perfect connection
    function drawLines() {
        svgLayer.innerHTML = '';
        svgLayer.style.overflow = 'visible';
        const rect = container.getBoundingClientRect();

        // Setting ViewBox eliminates all issues of relative sizing offset bugs
        svgLayer.setAttribute('viewBox', `${-rect.width / 2} ${-rect.height / 2} ${rect.width} ${rect.height}`);

        links.forEach(link => {
            const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
            line.setAttribute('x1', link.source.x);
            line.setAttribute('y1', link.source.y);
            line.setAttribute('x2', link.target.x);
            line.setAttribute('y2', link.target.y);
            line.setAttribute('stroke', 'var(--color-border)');
            line.setAttribute('stroke-width', '2');
            line.classList.add('skill-link');
            line.style.opacity = '0.4';
            line.style.transition = 'stroke 0.3s ease, stroke-width 0.3s ease';

            line.dataset.source = link.source.id;
            line.dataset.target = link.target.id;

            svgLayer.appendChild(line);
        });
    }

    drawLines();
    window.addEventListener('resize', drawLines);

    // Initial load animation
    gsap.from('.skill-node', {
        scale: 0,
        opacity: 0,
        duration: 0.8,
        stagger: 0.05,
        ease: 'back.out(1.5)',
        delay: 0.2
    });

    gsap.from('.skill-link', {
        opacity: 0,
        duration: 1,
        stagger: 0.05,
        delay: 0.5
    });

    // Subtle parallax effect on container mouse move
    container.addEventListener('mousemove', (e) => {
        const rect = container.getBoundingClientRect();
        const centerX = rect.left + rect.width / 2;
        const centerY = rect.top + rect.height / 2;

        // Normalize coordinates (-1 to 1)
        const normalizeX = (e.clientX - centerX) / (rect.width / 2);
        const normalizeY = (e.clientY - centerY) / (rect.height / 2);

        nodes.forEach((node) => {
            let depth = 0;
            if (node.id === 'root') depth = 0.02;
            else if (node.children) depth = 0.05;
            else depth = 0.08;

            gsap.to(node.el, {
                x: normalizeX * 60 * depth,
                y: normalizeY * 60 * depth,
                duration: 1,
                ease: 'power2.out',
                overwrite: 'auto'
            });
        });

        // Move lines with the nodes within the SVG Viewbox
        links.forEach(link => {
            const line = document.querySelector(`.skill-link[data-source="${link.source.id}"][data-target="${link.target.id}"]`);
            if (line) {
                let sourceDepth = link.source.id === 'root' ? 0.02 : (link.source.children ? 0.05 : 0.08);
                let targetDepth = link.target.id === 'root' ? 0.02 : (link.target.children ? 0.05 : 0.08);

                const sX = link.source.x + (normalizeX * 60 * sourceDepth);
                const sY = link.source.y + (normalizeY * 60 * sourceDepth);
                const tX = link.target.x + (normalizeX * 60 * targetDepth);
                const tY = link.target.y + (normalizeY * 60 * targetDepth);

                gsap.to(line, {
                    attr: { x1: sX, y1: sY, x2: tX, y2: tY },
                    duration: 1,
                    ease: 'power2.out',
                    overwrite: 'auto'
                });
            }
        });
    });

    container.addEventListener('mouseleave', () => {
        // Reset node positions
        nodes.forEach(node => {
            gsap.to(node.el, {
                x: 0,
                y: 0,
                duration: 1.5,
                ease: 'elastic.out(1, 0.5)',
                overwrite: 'auto'
            });
        });

        // Reset line positions
        links.forEach(link => {
            const line = document.querySelector(`.skill-link[data-source="${link.source.id}"][data-target="${link.target.id}"]`);
            if (line) {
                gsap.to(line, {
                    attr: {
                        x1: link.source.x,
                        y1: link.source.y,
                        x2: link.target.x,
                        y2: link.target.y
                    },
                    duration: 1.5,
                    ease: 'elastic.out(1, 0.5)',
                    overwrite: 'auto'
                });
            }
        });
    });
});
