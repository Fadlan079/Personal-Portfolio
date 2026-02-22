import * as THREE from 'three'

document.addEventListener('DOMContentLoaded', () => {

    const container = document.getElementById('skills-canvas')
    if (!container) return

    /* =========================
       SCENE
    ========================= */
    const scene = new THREE.Scene()

    const camera = new THREE.PerspectiveCamera(
        45,
        container.clientWidth / container.clientHeight,
        0.1,
        1000
    )

    camera.position.set(0, 4.5, 9)
    camera.rotation.x = -0.5

    const renderer = new THREE.WebGLRenderer({
        antialias: true,
        alpha: true
    })

    renderer.setSize(container.clientWidth, container.clientHeight)
    renderer.setPixelRatio(window.devicePixelRatio)
    renderer.shadowMap.enabled = true
    container.appendChild(renderer.domElement)

    /* =========================
       LIGHTING (SOFT REALISTIC)
    ========================= */
    scene.add(new THREE.AmbientLight(0xffffff, 0.45))

    const light = new THREE.DirectionalLight(0xffffff, 1)
    light.position.set(5, 10, 6)
    light.castShadow = true
    light.shadow.mapSize.set(2048, 2048)
    scene.add(light)

    /* =========================
       SKILL DATA
    ========================= */
    const skills = [
        { name: "Laravel", desc: "Structured backend & MVC mastery", color: "#ff2d20", logo: "/images/skills/laravel.png" },
        { name: "JavaScript", desc: "Dynamic frontend logic", color: "#f7df1e", logo: "/images/skills/javascript.png" },
        { name: "Tailwind", desc: "Utility-first CSS system", color: "#38bdf8", logo: "/images/skills/tailwind.png" },
        { name: "MySQL", desc: "Relational database design", color: "#2563eb", logo: "/images/skills/mysql.png" },
        { name: "HTMX", desc: "Dynamic UI without SPA complexity", color: "#3b82f6", logo: "/images/skills/htmx.png" },
        { name: "GSAP", desc: "High-performance animations", color: "#88ce02", logo: "/images/skills/gsap.png" },
        { name: "Git", desc: "Version control workflow", color: "#f1502f", logo: "/images/skills/git.png" },
        { name: "Vite", desc: "Modern build tooling", color: "#646cff", logo: "/images/skills/vite.png" }
    ]

    /* =========================
       KEY SIZE CONFIG
    ========================= */
    const keyWidth = 0.9
    const keyDepth = 0.9
    const keyHeight = 0.35
    const pressDepth = -0.18
    const gap = 0.02 // super rapet

    /* =========================
       CREATE KEY GEOMETRY
    ========================= */
    function createKeyGeometry() {

        const shape = new THREE.Shape()
        shape.moveTo(-keyWidth / 2, -keyDepth / 2)
        shape.lineTo(keyWidth / 2, -keyDepth / 2)
        shape.lineTo(keyWidth * 0.45, keyDepth / 2)
        shape.lineTo(-keyWidth * 0.45, keyDepth / 2)
        shape.closePath()

        return new THREE.ExtrudeGeometry(shape, {
            depth: keyHeight,
            bevelEnabled: true,
            bevelThickness: 0.04,
            bevelSize: 0.04,
            bevelSegments: 3
        })
    }

    /* =========================
       TEXTURE GENERATOR
    ========================= */
    function createKeyTexture(bgColor, logoUrl) {

        const size = 512
        const canvas = document.createElement('canvas')
        canvas.width = size
        canvas.height = size
        const ctx = canvas.getContext('2d')

        ctx.fillStyle = bgColor
        ctx.fillRect(0, 0, size, size)

        return new Promise(resolve => {

            if (!logoUrl) {
                resolve(new THREE.CanvasTexture(canvas))
                return
            }

            const img = new Image()
            img.src = logoUrl

            img.onload = () => {

                const logoSize = size * 0.55

                ctx.drawImage(
                    img,
                    (size - logoSize) / 2,
                    (size - logoSize) / 2,
                    logoSize,
                    logoSize
                )

                resolve(new THREE.CanvasTexture(canvas))
            }

            img.onerror = () => {
                resolve(new THREE.CanvasTexture(canvas))
            }
        })
    }

    /* =========================
       GENERATE KEYS GRID
    ========================= */
    const keys = []
    const cols = 4
    const rows = Math.ceil(skills.length / cols)

    async function generateKeys() {

        const geometry = createKeyGeometry()

        for (let i = 0; i < skills.length; i++) {

            const skill = skills[i]
            const texture = await createKeyTexture(skill.color, skill.logo)

            const material = new THREE.MeshStandardMaterial({
                map: texture,
                roughness: 0.5,
                metalness: 0.15
            })

            const key = new THREE.Mesh(geometry, material)

            const row = Math.floor(i / cols)
            const col = i % cols

            key.position.x =
                (col - (cols - 1) / 2) * (keyWidth + gap)

            key.position.z =
                (row - (rows - 1) / 2) * (keyDepth + gap)

            key.position.y = 0

            key.castShadow = true
            key.userData = skill

            scene.add(key)
            keys.push(key)
        }

        createBase()
    }

    /* =========================
       KEYBOARD BASE FIT SIZE
    ========================= */
    function createBase() {

        const totalWidth = cols * (keyWidth + gap)
        const totalDepth = rows * (keyDepth + gap)

        const baseGeo = new THREE.BoxGeometry(
            totalWidth,
            0.4,
            totalDepth
        )

        const baseMat = new THREE.MeshStandardMaterial({
            color: 0x111111,
            roughness: 0.8,
            metalness: 0.2
        })

        const base = new THREE.Mesh(baseGeo, baseMat)
        base.position.y = -0.35
        base.receiveShadow = true
        scene.add(base)
    }

    generateKeys()

    /* =========================
       HOVER PRESS EFFECT
    ========================= */
    const raycaster = new THREE.Raycaster()
    const mouse = new THREE.Vector2()
    let hovered = null

    window.addEventListener('mousemove', e => {

        const rect = renderer.domElement.getBoundingClientRect()

        mouse.x = ((e.clientX - rect.left) / rect.width) * 2 - 1
        mouse.y = -((e.clientY - rect.top) / rect.height) * 2 + 1

        raycaster.setFromCamera(mouse, camera)
        const hit = raycaster.intersectObjects(keys)

        if (hit.length > 0) {
            hovered = hit[0].object

            const skill = hovered.userData
            document.getElementById('skill-title').textContent = skill.name
            document.getElementById('skill-desc').textContent = skill.desc
            document.getElementById('skill-info').classList.remove('opacity-0')
        } else {
            hovered = null
            document.getElementById('skill-info').classList.add('opacity-0')
        }
    })

    /* =========================
       ANIMATION LOOP
    ========================= */
    function animate() {

        requestAnimationFrame(animate)

        keys.forEach(key => {

            const target = key === hovered ? pressDepth : 0
            key.position.y += (target - key.position.y) * 0.25
        })

        renderer.render(scene, camera)
    }

    animate()

    /* =========================
       RESIZE
    ========================= */
    window.addEventListener('resize', () => {

        camera.aspect = container.clientWidth / container.clientHeight
        camera.updateProjectionMatrix()
        renderer.setSize(container.clientWidth, container.clientHeight)
    })

})
