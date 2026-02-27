import * as THREE from 'three';
import { OrbitControls } from 'three/addons/controls/OrbitControls.js';
import { RoundedBoxGeometry } from 'three/addons/geometries/RoundedBoxGeometry.js';

let scene, camera, renderer, controls;
let keys = [];
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();

// Array of tech skills to map to keys
const keyData = [
    // Row 1
    { id: 'vue', color: 0x41b883, text: '\uf41f', isIcon: true, row: 0, col: 0 },
    { id: 'react', color: 0x61dafb, text: '\uf41b', isIcon: true, row: 0, col: 1 },
    { id: 'laravel', color: 0xff2d20, text: '\uf3bd', isIcon: true, row: 0, col: 2 },
    { id: 'node', color: 0x339933, text: '\uf419', isIcon: true, row: 0, col: 3 },
    { id: 'wordpress', color: 0x21759b, text: '\uf411', isIcon: true, row: 0, col: 4 },
    // Row 2
    { id: 'html5', color: 0xe34f26, text: '\uf13b', isIcon: true, row: 1, col: 0.2 },
    { id: 'css3', color: 0x1572b6, text: '\uf13c', isIcon: true, row: 1, col: 1.2 },
    { id: 'js', color: 0xf7df1e, text: '\uf3b8', isIcon: true, row: 1, col: 2.2, iconColor: '#000' },
    { id: 'php', color: 0x777bb4, text: '\uf457', isIcon: true, row: 1, col: 3.2 },
    { id: 'figma', color: 0xf24e1e, text: '\uf799', isIcon: true, row: 1, col: 4.2 },
    // Row 3
    { id: 'tw', color: 0x06b6d4, text: 'TW', isIcon: false, row: 2, col: 0.4 },
    { id: 'mysql', color: 0x4479a1, text: '\uf1c0', isIcon: true, row: 2, col: 1.4 },
    { id: 'rest', color: 0x20232a, text: '\uf6ff', isIcon: true, row: 2, col: 2.4 },
    { id: 'github', color: 0xe84e31, text: '\uf09b', isIcon: true, row: 2, col: 3.4 },
    { id: 'htmx', color: 0x3366cc, text: '</>', isIcon: false, row: 2, col: 4.4 },
    // Row 4
    { id: 'gsap', color: 0x88ce02, text: 'G', isIcon: false, row: 3, col: 0.6, iconColor: '#000' },
    { id: 'vite', color: 0x646cff, text: '\uf0e7', isIcon: true, row: 3, col: 1.6 },
    { id: 'responsive', color: 0x3b82f6, text: '\uf3ce', isIcon: true, row: 3, col: 2.6 },
    { id: 'linux', color: 0x1a1a1a, text: '\uf17c', isIcon: true, row: 3, col: 3.6, width: 2.5, iconColor: '#666' }
];

function init() {
    const container = document.getElementById('three-keyboard-container');
    if (!container) return;

    // Scene setup
    scene = new THREE.Scene();

    // Camera setup
    camera = new THREE.PerspectiveCamera(45, container.clientWidth / container.clientHeight, 0.1, 1000);
    // Position camera to look at the keyboard from a 3D perspective
    camera.position.set(0, 5, 8);

    // Renderer setup
    renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true });
    renderer.setSize(container.clientWidth, container.clientHeight);
    renderer.shadowMap.enabled = true;
    renderer.shadowMap.type = THREE.PCFSoftShadowMap;
    // Tone mapping for better colors
    renderer.toneMapping = THREE.ACESFilmicToneMapping;
    renderer.toneMappingExposure = 1.0;
    container.appendChild(renderer.domElement);

    // Orbit Controls
    controls = new OrbitControls(camera, renderer.domElement);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;
    // Restrict rotation so user doesn't end up under the board
    controls.maxPolarAngle = Math.PI / 2 - 0.1;
    controls.minDistance = 5;
    controls.maxDistance = 15;

    // Lighting
    const ambientLight = new THREE.AmbientLight(0xffffff, 0.6);
    scene.add(ambientLight);

    const dirLight = new THREE.DirectionalLight(0xffffff, 1.2);
    // Position light from top-left-front
    dirLight.position.set(-5, 10, 5);
    dirLight.castShadow = true;
    dirLight.shadow.mapSize.width = 2048;
    dirLight.shadow.mapSize.height = 2048;
    dirLight.shadow.camera.near = 0.5;
    dirLight.shadow.camera.far = 25;
    dirLight.shadow.camera.left = -5;
    dirLight.shadow.camera.right = 5;
    dirLight.shadow.camera.top = 5;
    dirLight.shadow.camera.bottom = -5;
    scene.add(dirLight);

    const fillLight = new THREE.DirectionalLight(0xaaccff, 0.3);
    fillLight.position.set(5, 2, -5);
    scene.add(fillLight);

    buildKeyboard();

    // Event Listeners
    window.addEventListener('resize', onWindowResize);
    renderer.domElement.addEventListener('mousemove', onMouseMove);
    renderer.domElement.addEventListener('mousedown', onMouseDown);
    renderer.domElement.addEventListener('mouseup', onMouseUp);
    renderer.domElement.addEventListener('mouseleave', () => {
        // Reset hovered key
        if (hoveredKey) {
            new TWEEN.Tween(hoveredKey.position)
                .to({ y: hoveredKey.userData.originalY }, 150)
                .easing(TWEEN.Easing.Quadratic.Out)
                .start();
            hoveredKey = null;
        }
    });
}

// Ensure TWEEN is globally available or polyfill simple animation
const TWEEN = {
    Tween: class {
        constructor(obj) { this.obj = obj; this._to = {}; this._duration = 0; }
        to(target, duration) { this._to = target; this._duration = duration; return this; }
        easing(fn) { return this; }
        start() {
            // Very primitive polyfill for TWEEN since we might not have the library
            const startY = this.obj.y;
            const endY = this._to.y;
            const startTime = Date.now();
            const dur = this._duration;
            const obj = this.obj;

            function update() {
                const now = Date.now();
                const progress = Math.min((now - startTime) / dur, 1);
                // Ease out quad
                const easeProgress = progress * (2 - progress);
                obj.y = startY + (endY - startY) * easeProgress;
                if (progress < 1) requestAnimationFrame(update);
            }
            requestAnimationFrame(update);
            return this;
        }
    },
    Easing: { Quadratic: { Out: null } }
};

function createIconTexture(item) {
    const canvas = document.createElement('canvas');
    canvas.width = 256;
    canvas.height = 256;
    const ctx = canvas.getContext('2d');

    // Fill transparent background
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    ctx.fillStyle = item.iconColor || '#ffffff';
    ctx.textAlign = 'center';
    ctx.textBaseline = 'middle';

    // Shadow for depth
    ctx.shadowColor = 'rgba(0, 0, 0, 0.4)';
    ctx.shadowBlur = 4;
    ctx.shadowOffsetX = 0;
    ctx.shadowOffsetY = 2;

    if (item.isIcon) {
        // We assume FontAwesome is loaded on the page
        // "Font Awesome 6 Brands" or "Font Awesome 6 Free" depending on icon
        // Simplest is to just try both or determine manually
        let fontFamily = '"Font Awesome 6 Brands"';
        // Hack: solid icons (mysql, rest, htmx if text, vite, responsive, linux uses solid/brands)
        // Let's just use generic logic or hardcode for simplicity.
        // Actually, easiest is to let CSS handle font-face rendering on canvas.
        // Needs a slight delay to ensure fonts are loaded if not locally cached,
        // but given they are on the page it should be fine.
        if (item.id === 'mysql' || item.id === 'rest' || item.id === 'vite' || item.id === 'responsive') {
            fontFamily = '"Font Awesome 6 Free"';
            ctx.font = '900 120px ' + fontFamily; // Solid needs 900 weight
        } else {
            ctx.font = '400 130px ' + fontFamily;
        }

        ctx.fillText(item.text, canvas.width / 2, canvas.height / 2);
    } else {
        ctx.font = 'bold 90px "Space Grotesk", sans-serif';
        ctx.fillText(item.text, canvas.width / 2, canvas.height / 2);

        // Add label below
        if (item.id === 'htmx' || item.id === 'gsap') {
            ctx.font = 'bold 36px "Space Grotesk", sans-serif';
            ctx.fillStyle = 'rgba(255, 255, 255, 0.6)';
            ctx.shadowBlur = 0;
            ctx.fillText(item.id.toUpperCase(), canvas.width / 2, canvas.height / 2 + 60);
        }
    }

    const texture = new THREE.CanvasTexture(canvas);
    texture.anisotropy = renderer.capabilities.getMaxAnisotropy();
    return texture;
}

function buildKeyboard() {
    // Board group
    const boardGroup = new THREE.Group();
    scene.add(boardGroup);

    // 1. Create the Board Base
    const boardWidth = 6;
    const boardDepth = 4.5;
    const boardHeight = 0.3;

    const boardGeo = new RoundedBoxGeometry(boardWidth, boardHeight, boardDepth, 4, 0.1);
    const boardMat = new THREE.MeshStandardMaterial({
        color: 0x181818,
        roughness: 0.8,
        metalness: 0.2
    });
    const board = new THREE.Mesh(boardGeo, boardMat);
    board.receiveShadow = true;
    board.castShadow = true;
    boardGroup.add(board);

    // Inner dark recessed area for keys
    const recessGeo = new RoundedBoxGeometry(boardWidth - 0.3, 0.05, boardDepth - 0.3, 4, 0.05);
    const recessMat = new THREE.MeshStandardMaterial({ color: 0x0a0a0a });
    const recess = new THREE.Mesh(recessGeo, recessMat);
    recess.position.y = boardHeight / 2;
    recess.receiveShadow = true;
    boardGroup.add(recess);

    // 2. Create the Keys
    const keySize = 0.8;
    const keyGap = 0.15;

    // Calculate starting position offsets to center the keys on the board
    // 5 col max = 5 * 0.8 + 4 * 0.15 = 4.6 width
    const startX = -((5 * keySize + 4 * keyGap) / 2) + (keySize / 2);
    // 4 rows = 4 * 0.8 + 3 * 0.15 = 3.65 depth
    const startZ = -((4 * keySize + 3 * keyGap) / 2) + (keySize / 2);

    const keyGeo = new RoundedBoxGeometry(keySize, 0.4, keySize, 2, 0.08);

    keyData.forEach(item => {
        // Individual Key Group to hold base and icon plane
        const keyGroup = new THREE.Group();

        // Base Keycar Mesh
        let wMult = item.width || 1;
        let pWidth = (keySize * wMult) + (keyGap * (wMult - 1));

        const specGeo = (wMult !== 1) ? new RoundedBoxGeometry(pWidth, 0.4, keySize, 2, 0.08) : keyGeo;

        const keyMat = new THREE.MeshStandardMaterial({
            color: item.color,
            roughness: 0.4,
            metalness: 0.1
        });

        const keyMesh = new THREE.Mesh(specGeo, keyMat);
        keyMesh.castShadow = true;
        keyMesh.receiveShadow = true;
        keyGroup.add(keyMesh);

        // Icon/Text Plane (slightly above the key surface)
        const iconTexture = createIconTexture(item);
        const iconGeo = new THREE.PlaneGeometry(pWidth * 0.8, keySize * 0.8);
        const iconMat = new THREE.MeshBasicMaterial({
            map: iconTexture,
            transparent: true,
            depthWrite: false
        });
        const iconMesh = new THREE.Mesh(iconGeo, iconMat);
        iconMesh.position.y = 0.201; // Just above the key top (0.4/2 = 0.2)
        iconMesh.rotation.x = -Math.PI / 2;
        keyGroup.add(iconMesh);

        // Position on board
        const posX = startX + (item.col * (keySize + keyGap));
        const posZ = startZ + (item.row * (keySize + keyGap));
        // Add half the width difference if it's a wide key
        const finalPosX = posX + ((wMult - 1) * keySize / 2);

        keyGroup.position.set(finalPosX, boardHeight / 2 + 0.1, posZ);

        // Store data for interactions
        keyGroup.userData = { originalY: keyGroup.position.y, itemData: item };
        keys.push(keyGroup);
        boardGroup.add(keyGroup);
    });

    // Tilt the whole board slightly
    boardGroup.rotation.x = 0;
    // We handle overall viewing angle via Camera positioning instead of tilting the board
    // This allows natural OrbitControls orbiting around the object
}

let hoveredKey = null;

function onMouseMove(event) {
    const rect = renderer.domElement.getBoundingClientRect();
    mouse.x = ((event.clientX - rect.left) / rect.width) * 2 - 1;
    mouse.y = -((event.clientY - rect.top) / rect.height) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    // Only raycast against keygroups
    const intersects = raycaster.intersectObjects(keys, true);

    if (intersects.length > 0) {
        // Find the root keyGroup from the intersected child (mesh or plane)
        let rootGroup = intersects[0].object;
        while (rootGroup.parent && !keys.includes(rootGroup)) {
            rootGroup = rootGroup.parent;
        }

        if (hoveredKey !== rootGroup) {
            // Restore previous
            if (hoveredKey) {
                new TWEEN.Tween(hoveredKey.position)
                    .to({ y: hoveredKey.userData.originalY }, 150)
                    .easing(TWEEN.Easing.Quadratic.Out)
                    .start();
            }
            // Hover new
            hoveredKey = rootGroup;
            document.body.style.cursor = 'pointer';

            new TWEEN.Tween(hoveredKey.position)
                .to({ y: hoveredKey.userData.originalY - 0.05 }, 100)
                .easing(TWEEN.Easing.Quadratic.Out)
                .start();
        }
    } else {
        if (hoveredKey) {
            document.body.style.cursor = 'default';
            new TWEEN.Tween(hoveredKey.position)
                .to({ y: hoveredKey.userData.originalY }, 150)
                .easing(TWEEN.Easing.Quadratic.Out)
                .start();
            hoveredKey = null;
        }
    }
}

let activeKey = null;
function onMouseDown(event) {
    if (hoveredKey) {
        activeKey = hoveredKey;
        new TWEEN.Tween(activeKey.position)
            .to({ y: activeKey.userData.originalY - 0.15 }, 50)
            .easing(TWEEN.Easing.Quadratic.Out)
            .start();
    }
}

function onMouseUp(event) {
    if (activeKey) {
        const targetY = (hoveredKey === activeKey) ? activeKey.userData.originalY - 0.05 : activeKey.userData.originalY;
        new TWEEN.Tween(activeKey.position)
            .to({ y: targetY }, 100)
            .easing(TWEEN.Easing.Quadratic.Out)
            .start();
        activeKey = null;
    }
}

function onWindowResize() {
    const container = document.getElementById('three-keyboard-container');
    if (!container) return;
    camera.aspect = container.clientWidth / container.clientHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(container.clientWidth, container.clientHeight);
}

function animate() {
    requestAnimationFrame(animate);
    controls.update();
    renderer.render(scene, camera);
}

// Need to ensure FontAwesome gets highly prioritized and loaded before we draw to canvas.
// For now, we init immediately but you could add a document.fonts.ready.then(init) wrapper
document.fonts.ready.then(() => {
    init();
    if (scene) animate();
});
