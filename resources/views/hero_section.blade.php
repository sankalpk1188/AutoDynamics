<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autodynamics - Lightweight Moulded Components</title>
    <!-- Tailwind CSS -->
    <!-- <script src="https://cdn.tailwindcss.com"></script>     -->
    <!-- Bootstrap 5 Grid -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css" rel="stylesheet">
    <style>
        .hero-section {
            position: relative;
            width: 100%;
            min-height: 90vh;
            overflow: hidden;
            background: #000;
            font-family: 'Inter', sans-serif;
            color: white;
        }

        .hero-section::before {
            content: "";
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 1;
            background:
                linear-gradient(115deg, rgba(255, 255, 255, 0.05) 0%, rgba(255, 255, 255, 0) 32%),
                repeating-linear-gradient(90deg,
                    rgba(255, 255, 255, 0.02) 0px,
                    rgba(255, 255, 255, 0.02) 1px,
                    rgba(255, 255, 255, 0) 1px,
                    rgba(255, 255, 255, 0) 52px);
            opacity: 0.26;
        }

        .hero-section .row {
            min-height: 80vh;
            position: relative;
            z-index: 2;
            pointer-events: none;
            /* Let empty space pass clicks to 3D canvas behind */
        }

        /* Text column */
        .hero-text-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 3rem 2.5rem;
            position: relative;
            z-index: 5;
            pointer-events: auto;
            /* Re-enable pointer events for text */
        }

        /* Canvas column */
        .hero-canvas-col {
            position: relative;
            min-height: 500px;
        }

        #canvas-container {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            /* Place 3D canvas right above speed lines */
        }

        @media (max-width: 991px) {
            .hero-section {
                min-height: auto;
                padding-bottom: 0.5rem;
            }

            .hero-section .row {
                min-height: auto;
            }

            .hero-text-col {
                padding: 2.25rem 1.25rem 1.5rem;
                text-align: center;
                align-items: center;
            }

            .hero-title {
                line-height: 1.22;
                letter-spacing: 0.5px;
                max-width: 100%;
            }

            .hero-title-product {
                display: block;
                margin-top: 0.65rem;
                margin-bottom: 0.35rem;
                padding: 0 0.25rem 0.15rem;
                line-height: 1.05;
            }

            .hero-canvas-col {
                min-height: min(56vw, 380px);
            }
        }

        @media (max-width: 575px) {
            .hero-section {
                min-height: auto;
            }

            .hero-text-col {
                padding: 1.75rem 0.85rem 1.25rem;
            }

            .hero-badge {
                font-size: 0.58rem;
                letter-spacing: 0.18em;
                justify-content: center;
                text-align: center;
                flex-wrap: wrap;
                margin-bottom: 1.1rem;
                padding: 0 0.25rem;
            }

            .hero-title {
                font-size: clamp(1.75rem, 8.2vw, 2.45rem);
                letter-spacing: 0.35px;
                line-height: 1.24;
            }

            .hero-title-product {
                margin-top: 0.85rem;
                margin-bottom: 0.5rem;
                font-size: clamp(2rem, 12vw, 3.1rem);
                letter-spacing: 0.02em;
                padding-left: 0.15rem;
                padding-right: 0.15rem;
            }

            .hero-canvas-col {
                min-height: min(68vw, 300px);
            }
        }

        .glass-panel {
            background: rgba(10, 20, 40, 0.4);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(100, 150, 255, 0.15);
            border-radius: 8px;
        }

        .shape-name-badge {
            position: absolute;
            top: 5rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            padding: 0.45rem 1.1rem;
            font-size: 10px;
            letter-spacing: 0.25em;
            font-weight: 500;
            color: rgba(255, 255, 255, 0.88);
            background: rgba(10, 20, 40, 0.45);
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(100, 150, 255, 0.2);
            border-radius: 999px;
            pointer-events: none;
            opacity: 0;
            white-space: nowrap;
            text-align: center;
            max-width: calc(100% - 2rem);
            line-height: 1.35;
            box-sizing: border-box;
        }

        @media (max-width: 991px) {
            .shape-name-badge {
                top: auto;
                bottom: 1.25rem;
                left: 50%;
                right: auto;
                transform: translateX(-50%);
                max-width: min(92vw, 420px);
                padding: 0.55rem 1rem;
                font-size: clamp(9px, 2.4vw, 11px);
                letter-spacing: 0.14em;
                white-space: normal;
                word-break: break-word;
                border-radius: 12px;
            }
        }

        @media (max-width: 575px) {
            .shape-name-badge {
                bottom: 0.85rem;
                max-width: calc(100% - 1.25rem);
                padding: 0.6rem 0.85rem;
                font-size: clamp(8.5px, 2.8vw, 10.5px);
                letter-spacing: 0.1em;
                line-height: 1.4;
            }
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 1.25rem;
            /*padding: 0.5rem 0.95rem;*/
            font-size: 0.66rem;
            letter-spacing: 0.28em;
            text-transform: uppercase;
            color: #b9d9ff;
            /*background: rgba(15, 26, 46, 0.42);*/
            /*border: 1px solid rgba(123, 175, 255, 0.26);*/
            /*box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.08), 0 12px 34px rgba(7, 36, 90, 0.33);*/
            border-radius: 999px;
        }

        .lightweight-word {
            position: relative;
            display: inline-block;
        }

        .feather-wrapper {
            position: absolute;
            top: -45px;
            /* Landing spot right on the head of the word */
            left: 50%;
            width: 100px;
            height: 48px;
            pointer-events: none;
            /* Force GPU Hardware acceleration to eliminate rendering stutter */
            will-change: transform, opacity;
            /* Smooth cubic-bezier for a soft, cinematic landing without sudden jolt */
            animation:
                featherFluidDrop 24s cubic-bezier(0.25, 1, 0.5, 1) forwards,
                featherFadeIn 4s linear forwards;
            opacity: 0;
            z-index: 10;
        }

        .feather-img {
            width: 100%;
            height: auto;
            mix-blend-mode: screen;
            /* perfectly removes black background */
            transform-origin: center center;
            will-change: transform;
            /* Continuous smooth ambient sway from the very beginning */
            animation: featherContinuousSway 7.5s ease-in-out infinite alternate;
        }

        @keyframes featherFluidDrop {
            0% {
                transform: translate3d(-50%, -400px, 0) rotate(35deg);
            }

            100% {
                transform: translate3d(-50%, 0px, 0) rotate(5deg);
            }
        }

        @keyframes featherFadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes featherContinuousSway {
            0% {
                transform: rotate(-6deg) translateY(-3px) translateX(-5px);
            }

            100% {
                transform: rotate(6deg) translateY(3px) translateX(5px);
            }
        }

        .hero-badge-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #78b9ff;
            box-shadow: 0 0 12px rgba(120, 185, 255, 0.95);
            flex: 0 0 7px;
        }

        .hero-title {
            margin-bottom: 0;
            font-size: clamp(2.45rem, 5.1vw, 5.1rem);
            line-height: 1.1;
            letter-spacing: 2px;
            font-weight: 300;
            color: #f5f9ff;
            text-shadow: 0 12px 36px rgba(2, 11, 28, 0.8);
        }

        .hero-title-accent {
            display: inline-block;
            font-weight: 700;
            background: linear-gradient(95deg, #85bdff 0%, #ffffff 48%, #cbe2ff 100%);
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            filter: none;
        }

        .hero-title-product {
            position: relative;
            display: inline-block;
            font-weight: 600;
            letter-spacing: 0.04em;
            /*text-transform: uppercase;*/
            font-size: clamp(2.25rem, 8vw, 80px);
            color: #dff0ff;
            background:
                radial-gradient(120% 90% at 20% 120%, rgba(110, 190, 255, 0.55) 0%, rgba(110, 190, 255, 0) 58%),
                radial-gradient(120% 90% at 80% -20%, rgba(70, 150, 255, 0.45) 0%, rgba(70, 150, 255, 0) 60%),
                linear-gradient(100deg, #6eb9ff 0%, #f4fbff 32%, #7fc4ff 56%, #d9efff 72%, #6eb9ff 100%);
            background-size: 200% 100%, 200% 100%, 220% 100%;
            background-position: 0% 50%, 100% 50%, 0% 50%;
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            text-shadow: 0 0 8px rgba(76, 155, 255, 0.18);
            animation: productWaveFlow 4.6s ease-in-out infinite;
            padding-right: 0.12em;
        }

        .hero-title-product::before {
            content: none;
        }

        .hero-title-product::after {
            content: "Products";
            position: absolute;
            left: 0;
            top: 0;
            color: rgba(211, 236, 255, 0.09);
            -webkit-text-stroke: 0;
            transform: translate(0.04em, 0.04em);
            pointer-events: none;
        }

        @keyframes productWaveFlow {
            0% {
                background-position: 0% 50%, 100% 50%, 0% 50%;
            }

            50% {
                background-position: 70% 50%, 35% 50%, 70% 50%;
            }

            100% {
                background-position: 140% 50%, -20% 50%, 140% 50%;
            }
        }

        #speed-lines-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <section class="hero-section" id="hero-module">
        <canvas id="speed-lines-canvas"></canvas>
        <div id="canvas-container"></div>
        <div class="container pt--0 pb--0">
            <div class="row align-items-center">

                <!-- LEFT: Text col-lg-6 -->
                <div class="col-lg-6 col-12 hero-text-col">
                    <div class="hero-badge">
                        <span></span>
                        Advanced <span class="lightweight-word">Lightweight
                            <div class="feather-wrapper">
                                <img src="{{asset('assets/images/featherr.png')}}" class="feather-img" alt="Feather">
                            </div>
                        </span> Manufacturing
                    </div>
                    <h1 class="hero-title">
                        Delivering Ideas to <br />
                        <span class="hero-title-accent hero-title-product mt-2">Products</span>
                    </h1>
                </div>

                <!-- RIGHT: 3D Canvas col-lg-6 -->
                <div class="col-lg-6 col-12 hero-canvas-col" id="canvas-col">
                    <div id="shape-ui" class="shape-name-badge">FRONT END STRUCTURE</div>
                    <!-- 3D Canvas now runs full-screen behind the UI layout -->
                </div>

            </div>
        </div>
    </section>

    <!-- GSAP for robust animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

    <!-- Three.js Library Setup via ES Modules -->
    <script type="importmap">
        {
            "imports": {
                "three": "https://unpkg.com/three@0.160.0/build/three.module.js",
                "three/addons/": "https://unpkg.com/three@0.160.0/examples/jsm/"
            }
        }
    </script>

    <script type="module">
        import * as THREE from 'three';
        import { OrbitControls } from 'three/addons/controls/OrbitControls.js';

        // ============================================
        // 1. SCENE SETUP
        // ============================================
        const canvasCol = document.getElementById('canvas-col');
        const heroSection = document.getElementById('hero-module');
        const container = document.getElementById('canvas-container');
        const scene = new THREE.Scene();

        let cWidth = heroSection.clientWidth;
        let cHeight = heroSection.clientHeight;

        let baseOffsetX = 0;
        let baseOffsetY = 0;

        const camera = new THREE.PerspectiveCamera(40, cWidth / cHeight, 0.1, 1000);
        camera.position.set(0, 1, 14);

        const renderer = new THREE.WebGLRenderer({ antialias: true, alpha: true, powerPreference: "high-performance" });
        renderer.setSize(cWidth, cHeight);
        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
        renderer.toneMapping = THREE.ACESFilmicToneMapping;
        renderer.toneMappingExposure = 1.3;
        container.appendChild(renderer.domElement);

        const controls = new OrbitControls(camera, renderer.domElement);
        controls.enableDamping = true;
        controls.dampingFactor = 0.05;
        controls.enableZoom = false;
        controls.enablePan = false;
        controls.enableRotate = false; // Disable click-and-drag rotation
        controls.target.set(0, 0, 0);

        // ============================================
        // 2. LIGHTING SETUP
        // ============================================
        const ambientLight = new THREE.AmbientLight(0xffffff, 0.2);
        scene.add(ambientLight);

        const mainSpot = new THREE.SpotLight(0xaaccff, 400); // Blueish white
        mainSpot.position.set(8, 12, 10);
        mainSpot.angle = Math.PI / 4;
        mainSpot.penumbra = 0.8;
        scene.add(mainSpot);

        const backLight = new THREE.PointLight(0x3366ff, 150, 20); // Deep blue from back
        backLight.position.set(-5, -2, -6);
        scene.add(backLight);

        const coreGlow = new THREE.PointLight(0xe6f2ff, 0, 10);
        coreGlow.position.set(0, 0, 0);
        scene.add(coreGlow);

        // ============================================
        // 3. OBJECT SETUP
        // ============================================
        const mainGroup = new THREE.Group();
        // Centered in the col-lg-6 canvas column
        mainGroup.position.set(0, 0, 0);
        scene.add(mainGroup);

        // Solid Solid Heavy Component HAS BEEN REMOVED completely!

        // Particles Component (Always present, assembling into shapes)
        const particleCount = 50000;
        const particleGeo = new THREE.BufferGeometry();

        const positions = new Float32Array(particleCount * 3);
        const targetPositions = new Float32Array(particleCount * 3);
        const finalPositions = new Float32Array(particleCount * 3);

        for (let i = 0; i < particleCount; i++) {
            // Start: Clustered small cloud (just for initial data, we actually jump straight into assembly)
            const rStart = Math.random() * 1.5;
            const thetaStart = Math.random() * Math.PI * 2;
            const yStart = (Math.random() - 0.5) * 2.5;

            positions[i * 3] = rStart * Math.cos(thetaStart);
            positions[i * 3 + 1] = yStart;
            positions[i * 3 + 2] = rStart * Math.sin(thetaStart);

            // Mid: Exploded out (Cloud state) - Full screen background spread
            targetPositions[i * 3] = (Math.random() - 0.5) * 100;
            targetPositions[i * 3 + 1] = (Math.random() - 0.5) * 60;
            targetPositions[i * 3 + 2] = (Math.random() - 0.5) * 60 - 5;
        }

        particleGeo.setAttribute('position', new THREE.BufferAttribute(positions, 3));
        particleGeo.setAttribute('targetPosition', new THREE.BufferAttribute(targetPositions, 3));

        // Function to update final geometry based on shape cycle
        function setShapePositions(shapeType) {
            for (let i = 0; i < particleCount; i++) {
                let valid = false;
                let finalX = 0, finalY = 0, finalZ = 0;

                if (shapeType === "FRONT_END_STRUCTURE") {
                    // Exact FES Carrier Match
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 14.0;
                        let y = (Math.random() - 0.5) * 8.0;
                        let z = 0;

                        // Main Frame Components
                        const isTopBeam = y > 1.5 && y < 3.0 && x > -5.0 && x < 5.0;
                        const isBottomBeam = y < -2.0 && y > -3.5 && x > -4.5 && x < 4.5;
                        const isMidBeam = y > -0.5 && y < 0.2 && x > -4.0 && x < 4.0;

                        const isLeftPillar = x < -3.0 && x > -4.5 && y > -3.5 && y < 3.0;
                        const isRightPillar = x > 3.0 && x < 4.5 && y > -3.5 && y < 3.0;

                        // Outer Arms
                        const isLeftArm = x < -4.5 && x > -6.5 && y > -1.0 && y < 1.0;
                        const isRightArm = x > 4.5 && x < 6.5 && y > -1.0 && y < 1.0;

                        if (!isTopBeam && !isBottomBeam && !isMidBeam && !isLeftPillar && !isRightPillar && !isLeftArm && !isRightArm) continue;

                        // Top Beam Ribbing (complex pockets)
                        const isTopRib = isTopBeam && (Math.abs(x * 2.0) % 1.0 < 0.2);

                        // Bottom holes (3 rectangular holes)
                        const bHole1 = isBottomBeam && x > -2.5 && x < -1.0 && y > -3.0 && y < -2.5;
                        const bHole2 = isBottomBeam && x > -0.5 && x < 0.5 && y > -3.0 && y < -2.5;
                        const bHole3 = isBottomBeam && x > 1.0 && x < 2.5 && y > -3.0 && y < -2.5;
                        if (bHole1 || bHole2 || bHole3) continue;

                        // Arm holes
                        const armHoleL = isLeftArm && Math.sqrt((x - -5.8) ** 2 + (y - 0.5) ** 2) < 0.3;
                        const armHoleR = isRightArm && Math.sqrt((x - 5.8) ** 2 + (y - 0.5) ** 2) < 0.3;
                        if (armHoleL || armHoleR) continue;

                        valid = true;

                        if (isTopBeam) {
                            z = isTopRib ? 0.3 : 0.0;
                        } else if (isLeftArm || isRightArm) {
                            z = 0.5 + Math.random() * 0.1; // Arms protrude forward
                        } else if (isMidBeam) {
                            z = -0.2; // Recessed
                        } else {
                            z = Math.random() * 0.2;
                        }

                        let nx = x, ny = y, nz = z;
                        // Isometric Pitch/Yaw to match FES image
                        let angleX = Math.PI / 15;
                        let ty = ny * Math.cos(angleX) - nz * Math.sin(angleX);
                        let tz = ny * Math.sin(angleX) + nz * Math.cos(angleX);
                        ny = ty; nz = tz;

                        let angleY = -Math.PI / 10;
                        let tx = nx * Math.cos(angleY) - nz * Math.sin(angleY);
                        tz = nx * Math.sin(angleY) + nz * Math.cos(angleY);
                        nx = tx; nz = tz;

                        finalX = nx * 0.6;
                        finalY = ny * 0.6;
                        finalZ = nz * 0.6;
                    }
                } else if (shapeType === "BATTERY_TRAY") {
                    // Precision Battery Tray based on exact isometric image
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 10.0;
                        let z = (Math.random() - 0.5) * 10.0;
                        let y = 0; // vertical dimension

                        // Dimensions: Width(X) = 6, Depth(Z) = 8
                        const isMainBody = x > -3.0 && x < 3.0 && z > -4.0 && z < 4.0;
                        const isSideFlange = x < -3.0 && x > -5.0 && z > 1.0 && z < 3.5;

                        if (!isMainBody && !isSideFlange) continue;

                        const isThinWall = isMainBody && (x > 2.7 || z > 3.7 || z < -3.7);
                        const isThickLeftWall = isMainBody && x < -2.5;

                        const isButtress = isThickLeftWall && (Math.abs(z * 3) % 1.0 < 0.2);
                        const isFloorRib = isMainBody && !isThickLeftWall && !isThinWall && (Math.abs(x - -1.5) < 0.3 || Math.abs(x - -0.3) < 0.3);
                        const isSquareIndent = isMainBody && x > 0.5 && x < 2.0 && z > 0.5 && z < 2.0;

                        const distToBoss = Math.sqrt((x - 0) ** 2 + (z - -1.5) ** 2);
                        const isBoss = distToBoss < 0.5;
                        const isBossHole = distToBoss < 0.2;

                        const distToHole1 = Math.sqrt((x - -4.0) ** 2 + (z - 1.5) ** 2);
                        const distToHole2 = Math.sqrt((x - -4.0) ** 2 + (z - 2.8) ** 2);
                        if (isSideFlange && (distToHole1 < 0.25 || distToHole2 < 0.25)) continue;
                        if (isBossHole) continue;

                        valid = true;

                        if (isThickLeftWall) {
                            y = (Math.random() * 0.8) + (isButtress ? 0.0 : 0.2);
                        } else if (isThinWall) {
                            y = Math.random() * 0.6;
                        } else if (isSideFlange) {
                            y = (Math.random() - 0.5) * 0.15 + 0.3; // Mid-height mount
                        } else if (isFloorRib) {
                            y = (Math.random() * 0.3); // Raised pipe on floor
                        } else if (isSquareIndent) {
                            y = -0.2 + (Math.random() * 0.05); // Sunken
                        } else if (isBoss) {
                            y = (Math.random() * 0.4); // Raised platform
                        } else {
                            y = (Math.random() * 0.05); // Base floor
                        }

                        let nx = x, ny = y, nz = z;

                        // Rotational alignments to match the exact uploaded isometric image
                        let angleY = -Math.PI / 3.5;
                        let tx = nx * Math.cos(angleY) - nz * Math.sin(angleY);
                        let tz = nx * Math.sin(angleY) + nz * Math.cos(angleY);
                        nx = tx; nz = tz;

                        let angleX = Math.PI / 4.5;
                        let ty = ny * Math.cos(angleX) - nz * Math.sin(angleX);
                        tz = ny * Math.sin(angleX) + nz * Math.cos(angleX);
                        ny = ty; nz = tz;

                        // Slightly center it downward to compensate for the rotations
                        finalX = nx * 0.65;
                        finalY = (ny * 0.65) - 0.5;
                        finalZ = nz * 0.65;
                    }
                } else if (shapeType === "IMPACT_BEAM_(CRASH_MANAGEMENT_SYSTEM)") {
                    // Exact Impact Beam Match
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 14.0; // -7 to 7
                        let y = (Math.random() - 0.5) * 2.5;  // -1.25 to 1.25
                        let z = 0;

                        // Outer boundary with rounded tapering ends
                        const endTaper = Math.pow(Math.abs(x) / 7.0, 4) * 0.8;
                        const heightAtX = 1.25 - endTaper;
                        if (Math.abs(y) > heightAtX) continue;

                        // Curve drop (smile)
                        const curveDrop = Math.pow(x / 7.0, 2) * 0.4;
                        const adjY = y + curveDrop;

                        // Features
                        // 1. Far circular indents
                        const leftCircle = Math.sqrt((x - -5.5) ** 2 + (adjY - 0) ** 2);
                        const rightCircle = Math.sqrt((x - 5.5) ** 2 + (adjY - 0) ** 2);
                        const isCircleIndent = leftCircle < 0.45 || rightCircle < 0.45;
                        const isCircleHole = leftCircle < 0.1 || rightCircle < 0.1;
                        if (isCircleHole) continue;

                        // 2. Rectangular cutouts with horizontal bars
                        const isLeftCutoutBox = x > -4.5 && x < -2.5 && Math.abs(adjY) < 0.4;
                        const isRightCutoutBox = x < 4.5 && x > 2.5 && Math.abs(adjY) < 0.4;
                        // Keep a middle horizontal bar in the cutout
                        const isCutoutBar = Math.abs(adjY) < 0.08;
                        if ((isLeftCutoutBox || isRightCutoutBox) && !isCutoutBar) continue;

                        // 3. Central rectangular raised pad
                        const isCenterPad = x > -1.8 && x < 1.8 && adjY > -0.6 && adjY < 0.6;

                        // Center pad holes
                        const centerHoleLeft = x > -1.2 && x < -0.8 && adjY > 0.1 && adjY < 0.3;
                        const centerHoleRight = x > 0.8 && x < 1.2 && adjY > 0.1 && adjY < 0.3;
                        const centerHoleMid = x > -0.4 && x < 0.4 && adjY > -0.3 && adjY < -0.1;
                        if (centerHoleLeft || centerHoleRight || centerHoleMid) continue;

                        valid = true;

                        // Z Depth
                        if (isCircleIndent) {
                            z = -0.3 + Math.random() * 0.05;
                        } else if (isCenterPad) {
                            z = 0.2 + Math.random() * 0.05;
                        } else {
                            // Rounded face
                            const edgeDist = Math.abs(y) / heightAtX;
                            z = (1.0 - Math.pow(edgeDist, 2)) * 0.2 + (Math.random() - 0.5) * 0.05;
                        }

                        // Add the curve back for final pos and decrease normal size
                        finalX = x * 0.65;
                        finalY = (y - curveDrop) * 0.65;
                        finalZ = (z - Math.pow(x / 7.0, 2) * 1.5) * 0.65;
                    }
                } else if (shapeType === "FOOTSTEP_BRACKET") {
                    // Exact Foot Step Base Plate Match
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 16.0; // -8 to 8
                        let z = (Math.random() - 0.5) * 6.0;  // -3 to 3
                        let y = 0;

                        // Wavy outline
                        let topZ = 2.5 + Math.sin(x * 1.5) * 0.3;
                        let bottomZ = -2.5 - Math.sin(x * 1.0) * 0.2;

                        // Right side taper
                        if (x > 5.0) {
                            topZ -= (x - 5.0) * 0.5;
                            bottomZ += (x - 5.0) * 0.5;
                        }

                        // Left side cutout
                        if (x < -6.5 && z > 0) continue;

                        if (z > topZ || z < bottomZ) continue;

                        // Front Ridge with X Truss (bottom edge)
                        const isTrussEdge = z > bottomZ && z < bottomZ + 0.6;
                        // X pattern
                        const isTruss = isTrussEdge && (Math.abs(x * 3.0 + z * 3.0) % 1.0 < 0.2 || Math.abs(x * 3.0 - z * 3.0) % 1.0 < 0.2);

                        // 3 Large circular wells
                        let isWell = false;
                        const wellCenters = [[-4, 0.5], [1, 1], [4.5, 0.5]];
                        wellCenters.forEach(c => {
                            if (Math.sqrt((x - c[0]) ** 2 + (z - c[1]) ** 2) < 0.8) isWell = true;
                        });

                        // Rectangular indents
                        const isRectIndent1 = x > 0.5 && x < 2.0 && z > -1.5 && z < -0.5;
                        const isRectIndent2 = x > 3.0 && x < 4.0 && z > -1.5 && z < -0.5;

                        // Far left projecting leg (boss)
                        const isLeftLeg = x < -7.0 && z > bottomZ && z < bottomZ + 1.0;
                        const isLeftLegHole = isLeftLeg && Math.sqrt((x - -7.5) ** 2 + (z - (bottomZ + 0.5)) ** 2) < 0.2;

                        // Far right small boss
                        const isRightBoss = x > 7.0 && Math.sqrt((x - 7.5) ** 2 + (z - 0) ** 2) < 0.4;

                        if (isLeftLegHole) continue;
                        valid = true;

                        // Elevations
                        if (isTrussEdge) {
                            y = isTruss ? 0.2 : -0.1;
                        } else if (isWell) {
                            y = -0.6 + Math.random() * 0.1; // Deep recessed holes
                        } else if (isRectIndent1 || isRectIndent2) {
                            y = -0.3 + Math.random() * 0.05;
                        } else if (isLeftLeg) {
                            y = -0.5 + (Math.random() - 0.5) * 1.0; // cylinder pointing down
                        } else if (isRightBoss) {
                            y = 0.3 + Math.random() * 0.1;
                        } else {
                            y = Math.random() * 0.1; // flat base floor
                        }

                        let nx = x; let ny = y; let nz = z;

                        // Isometric rotation
                        let angleY = -Math.PI / 8; // Yaw left
                        let tx = nx * Math.cos(angleY) - nz * Math.sin(angleY);
                        let tz = nx * Math.sin(angleY) + nz * Math.cos(angleY);
                        nx = tx; nz = tz;

                        let angleX = Math.PI / 6; // Pitch up
                        let ty = ny * Math.cos(angleX) - nz * Math.sin(angleX);
                        tz = ny * Math.sin(angleX) + nz * Math.cos(angleX);
                        ny = ty; nz = tz;

                        finalX = nx * 0.55;
                        finalY = ny * 0.55;
                        finalZ = nz * 0.55;
                    }
                } else if (shapeType === "DOOR_PANEL") {
                    // Inner door module panel with window cutout, handle recess, speaker grille
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 12.0; // -6 to 6
                        let y = (Math.random() - 0.5) * 8.0;  // -4 to 4
                        let z = 0;

                        // Main panel body - slightly trapezoidal
                        const widthAtY = 5.5 - Math.abs(y) * 0.15;
                        const isMainPanel = x > -widthAtY && x < widthAtY && y > -3.5 && y < 3.5;
                        if (!isMainPanel) continue;

                        // Window cutout (large opening in upper portion)
                        const isWindowCutout = x > -3.5 && x < 4.0 && y > 1.0 && y < 3.0;
                        if (isWindowCutout) continue;

                        // Handle recess (elongated indent)
                        const isHandleRecess = x > -1.5 && x < 2.0 && y > -0.5 && y < 0.3;

                        // Speaker grille (circular pattern of holes, lower area)
                        const speakerDist = Math.sqrt((x - -2.5) ** 2 + (y - -2.0) ** 2);
                        const isSpeakerArea = speakerDist < 1.2;
                        const isSpeakerHole = isSpeakerArea && (Math.sin(x * 8) * Math.sin(y * 8) > 0.3);
                        if (isSpeakerHole) continue;

                        // Mounting bosses (4 corners)
                        const bosses = [[-4.5, 2.5], [4.5, 2.5], [-4.5, -2.5], [4.5, -2.5]];
                        let isBoss = false;
                        let isBossHole = false;
                        bosses.forEach(b => {
                            const d = Math.sqrt((x - b[0]) ** 2 + (y - b[1]) ** 2);
                            if (d < 0.4) isBoss = true;
                            if (d < 0.15) isBossHole = true;
                        });
                        if (isBossHole) continue;

                        // Window frame (raised border around window cutout)
                        const isWindowFrame = !isWindowCutout && x > -4.0 && x < 4.5 && y > 0.5 && y < 3.5 &&
                            (x < -3.0 || x > 3.5 || y < 1.5 || y > 2.5);

                        // Reinforcement ribs (vertical struts)
                        const isRib = (Math.abs(x - -1.0) < 0.15 || Math.abs(x - 1.5) < 0.15 || Math.abs(x - 3.5) < 0.15) &&
                            y > -3.0 && y < 0.8;

                        // Outer edge lip
                        const isEdgeLip = Math.abs(x) > widthAtY - 0.4 || Math.abs(y) > 3.0;

                        valid = true;

                        // Depth assignments
                        if (isBoss) {
                            z = (Math.random() * 0.5) + 0.3;
                        } else if (isHandleRecess) {
                            z = -0.4 + Math.random() * 0.05;
                        } else if (isSpeakerArea) {
                            z = -0.1 + Math.random() * 0.05;
                        } else if (isWindowFrame || isEdgeLip) {
                            z = (Math.random() - 0.5) * 0.3 + 0.4;
                        } else if (isRib) {
                            z = Math.random() * 0.35 + 0.1;
                        } else {
                            z = (Math.random() - 0.5) * 0.15;
                        }

                        let nx = x, ny = y, nz = z;

                        // Isometric rotation
                        let angleY2 = -Math.PI / 6;
                        let tx = nx * Math.cos(angleY2) - nz * Math.sin(angleY2);
                        let tz = nx * Math.sin(angleY2) + nz * Math.cos(angleY2);
                        nx = tx; nz = tz;

                        let angleX2 = Math.PI / 12;
                        let ty = ny * Math.cos(angleX2) - nz * Math.sin(angleX2);
                        tz = ny * Math.sin(angleX2) + nz * Math.cos(angleX2);
                        ny = ty; nz = tz;

                        finalX = nx * 0.7;
                        finalY = ny * 0.7;
                        finalZ = nz * 0.7;
                    }
                } else if (shapeType === "ENGINE_COVER") {
                    // Engine top cover / valve cover with cooling fins and oil cap
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 10.0;
                        let z = (Math.random() - 0.5) * 7.0;
                        let y = 0;

                        // Main body: rounded rectangle
                        const rx = 4.0, rz = 2.8;
                        const edgeDist = Math.pow(Math.abs(x / rx), 3) + Math.pow(Math.abs(z / rz), 3);
                        if (edgeDist > 1.0) continue;

                        // Oil filler cap (circular boss, top-right area)
                        const capDist = Math.sqrt((x - 2.5) ** 2 + (z - 1.0) ** 2);
                        const isCap = capDist < 0.7;
                        const isCapHole = capDist < 0.3;

                        // Breather port (smaller circle, left area)
                        const breatherDist = Math.sqrt((x - -2.8) ** 2 + (z - 0.5) ** 2);
                        const isBreather = breatherDist < 0.45;
                        const isBreatherHole = breatherDist < 0.2;

                        if (isCapHole || isBreatherHole) continue;

                        // Bolt bosses (6 evenly spaced along the perimeter)
                        let isBolt = false;
                        let isBoltHole = false;
                        const boltPositions = [
                            [-3.2, -2.0], [-3.2, 2.0], [0.0, -2.2],
                            [0.0, 2.2], [3.2, -2.0], [3.2, 2.0]
                        ];
                        boltPositions.forEach(b => {
                            const d = Math.sqrt((x - b[0]) ** 2 + (z - b[1]) ** 2);
                            if (d < 0.35) isBolt = true;
                            if (d < 0.12) isBoltHole = true;
                        });
                        if (isBoltHole) continue;

                        // Cooling / reinforcement fins (longitudinal ribs along x)
                        const isFin = !isCap && !isBreather && !isBolt && edgeDist < 0.7 &&
                            (Math.abs(z * 3.0) % 1.0 < 0.18);

                        // Central brand/logo recess area
                        const isLogoRecess = Math.abs(x) < 1.5 && Math.abs(z) < 0.8;

                        // Outer flange lip
                        const isFlange = edgeDist > 0.8;

                        valid = true;

                        // Dome profile: higher in center, slopes down
                        const domeHeight = (1.0 - edgeDist) * 1.2;

                        if (isCap) {
                            y = domeHeight + 0.5 + Math.random() * 0.2;
                        } else if (isBreather) {
                            y = domeHeight + 0.3 + Math.random() * 0.15;
                        } else if (isBolt) {
                            y = -0.1 + Math.random() * 0.1;
                        } else if (isFin) {
                            y = domeHeight + 0.15 + Math.random() * 0.05;
                        } else if (isLogoRecess) {
                            y = domeHeight - 0.15;
                        } else if (isFlange) {
                            y = -0.1 + (Math.random() - 0.5) * 0.2;
                        } else {
                            y = domeHeight * (0.8 + Math.random() * 0.2);
                        }

                        let nx = x, ny = y, nz = z;

                        // Isometric rotation to match other parts
                        let angleY3 = Math.PI / 5;
                        let tx = nx * Math.cos(angleY3) - nz * Math.sin(angleY3);
                        let tz = nx * Math.sin(angleY3) + nz * Math.cos(angleY3);
                        nx = tx; nz = tz;

                        let angleX3 = Math.PI / 5;
                        let ty = ny * Math.cos(angleX3) - nz * Math.sin(angleX3);
                        tz = ny * Math.sin(angleX3) + nz * Math.cos(angleX3);
                        ny = ty; nz = tz;

                        finalX = nx * 0.75;
                        finalY = (ny * 0.75) - 0.5;
                        finalZ = nz * 0.75;
                    }
                } else if (shapeType === "EV_BATTERY_CELL_HOLDER") {
                    // Battery cell holder tray with honeycomb grid of circular holes
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 12.0; // -6 to 6
                        let z = (Math.random() - 0.5) * 6.0;  // -3 to 3
                        let y = 0;

                        // Main rectangular tray body
                        const isMainTray = x > -5.5 && x < 5.5 && z > -2.5 && z < 2.5;
                        if (!isMainTray) continue;

                        // Honeycomb hole grid - offset rows of circular holes
                        const cellRadius = 0.38;
                        const cellSpacingX = 0.95;
                        const cellSpacingZ = 0.82;
                        let isHole = false;

                        // Check if point falls inside any cell hole
                        const innerArea = x > -5.0 && x < 5.0 && z > -2.0 && z < 2.0;
                        if (innerArea) {
                            // Determine row
                            const row = Math.round(z / cellSpacingZ);
                            const rowOffset = (Math.abs(row) % 2 === 1) ? cellSpacingX * 0.5 : 0;
                            const col = Math.round((x - rowOffset) / cellSpacingX);
                            const cx = col * cellSpacingX + rowOffset;
                            const cz = row * cellSpacingZ;
                            const distToCenter = Math.sqrt((x - cx) ** 2 + (z - cz) ** 2);
                            if (distToCenter < cellRadius) isHole = true;
                        }
                        if (isHole) continue;

                        // Outer perimeter wall
                        const isOuterWall = x < -4.8 || x > 4.8 || z < -2.2 || z > 2.2;

                        // Structural ribs between cells (the honeycomb walls)
                        const isWallBetweenCells = innerArea && !isHole;

                        // Corner reinforcement pads
                        const corners = [[-5.0, -2.2], [-5.0, 2.2], [5.0, -2.2], [5.0, 2.2]];
                        let isCornerPad = false;
                        corners.forEach(c => {
                            if (Math.sqrt((x - c[0]) ** 2 + (z - c[1]) ** 2) < 0.6) isCornerPad = true;
                        });

                        // Central structural cross brace
                        const isCrossBrace = (Math.abs(x) < 0.12 && z > -2.0 && z < 2.0) ||
                            (Math.abs(z) < 0.12 && x > -5.0 && x < 5.0);

                        valid = true;

                        // Height assignments
                        if (isOuterWall) {
                            y = Math.random() * 0.8 + 0.1;
                        } else if (isCornerPad) {
                            y = Math.random() * 0.6 + 0.3;
                        } else if (isCrossBrace) {
                            y = Math.random() * 0.5 + 0.05;
                        } else if (isWallBetweenCells) {
                            y = Math.random() * 0.7; // Thin walls between cells
                        } else {
                            y = Math.random() * 0.05; // flat base floor
                        }

                        let nx = x, ny = y, nz = z;

                        // Isometric rotation matching reference image angle
                        let angleY4 = -Math.PI / 4.5;
                        let tx = nx * Math.cos(angleY4) - nz * Math.sin(angleY4);
                        let tz = nx * Math.sin(angleY4) + nz * Math.cos(angleY4);
                        nx = tx; nz = tz;

                        let angleX4 = Math.PI / 5;
                        let ty = ny * Math.cos(angleX4) - nz * Math.sin(angleX4);
                        tz = ny * Math.sin(angleX4) + nz * Math.cos(angleX4);
                        ny = ty; nz = tz;

                        finalX = nx * 0.65;
                        finalY = (ny * 0.65) - 0.3;
                        finalZ = nz * 0.65;
                    }
                } else if (shapeType === "MID_ROLL") {
                    // Exact Mid Roll Match
                    while (!valid) {
                        let x = (Math.random() - 0.5) * 18.0; // -9 to 9
                        let y = (Math.random() - 0.5) * 3.5;  // -1.75 to 1.75
                        let z = 0;

                        // Main shape outline
                        let topEdge = 1.0;
                        let bottomEdge = -0.5;

                        // Center dip
                        if (x > -3.0 && x < 3.0) {
                            bottomEdge -= Math.cos((x / 3.0) * Math.PI / 2) * 1.0; // Dips down to -1.5
                        }

                        if (y > topEdge || y < bottomEdge) continue;

                        // Top clips (small square teeth sticking out the top)
                        let isClip = false;
                        if (y > 0.8 && y < 1.0) {
                            // Only clips every so often
                            if (Math.abs(x * 2.0) % 1.0 > 0.6) isClip = true;
                            // And only in certain regions
                            if (x < -6.0 || x > 6.0) isClip = false;
                        }
                        if (y > 0.8 && !isClip) continue;

                        // Holes
                        // Left hole
                        const leftHole = x > -8.5 && x < -6.5 && y > -0.2 && y < 0.6;
                        // Right hole
                        const rightHole = x > 6.5 && x < 8.5 && y > -0.2 && y < 0.6;
                        // Center hole (in the dip)
                        const centerHole = x > -2.0 && x < 2.0 && y > -1.2 && y < -0.6;
                        if (leftHole || rightHole || centerHole) continue;

                        // A circular badge/hole on the right side of the dip
                        const badgeDist = Math.sqrt((x - 2.5) ** 2 + (y - -0.8) ** 2);
                        if (badgeDist < 0.25) continue;

                        valid = true;

                        // Simple Z depth, slightly curved
                        z = (Math.random() - 0.5) * 0.1;
                        if (y > 0.5) z -= 0.1; // Top tapers back
                        if (x > 5.0 && x < 5.5) z += 0.3; // Right side step

                        finalX = x * 0.5;
                        finalY = y * 0.5;
                        finalZ = z * 0.5;
                    }
                }

                finalPositions[i * 3] = finalX;
                finalPositions[i * 3 + 1] = finalY;
                finalPositions[i * 3 + 2] = finalZ;
            }
            particleGeo.setAttribute('finalPosition', new THREE.BufferAttribute(finalPositions, 3));
            particleGeo.attributes.finalPosition.needsUpdate = true;
        }

        const SHAPES = ["BATTERY_TRAY", "EV_BATTERY_CELL_HOLDER", "IMPACT_BEAM_(CRASH_MANAGEMENT_SYSTEM)", "FOOTSTEP_BRACKET", "MID_ROLL", "FRONT_END_STRUCTURE"];
        let currentShapeIndex = 0;

        // Pre-cache ALL shape positions at load time to prevent frame drops during transitions
        const shapeCache = {};
        SHAPES.forEach(shape => {
            setShapePositions(shape);
            shapeCache[shape] = new Float32Array(finalPositions);
        });

        // Fast swap from cache (no computation during animation)
        function applyShapeFromCache(shapeName) {
            const cached = shapeCache[shapeName];
            finalPositions.set(cached);
            particleGeo.setAttribute('finalPosition', new THREE.BufferAttribute(finalPositions, 3));
            particleGeo.attributes.finalPosition.needsUpdate = true;
        }

        // Initialize with first shape from cache
        applyShapeFromCache(SHAPES[currentShapeIndex]);

        // Custom Shader Material 
        const particleMat = new THREE.ShaderMaterial({
            uniforms: {
                time: { value: 0 },
                progExplode: { value: 1.0 }, // START EXPLODED
                progAssemble: { value: 0.0 }, // AT 0% assembly initially
                baseColor: { value: new THREE.Color(0xffffff) } // White
            },
            vertexShader: `
                uniform float time;
                uniform float progExplode;
                uniform float progAssemble;
                attribute vec3 targetPosition;
                attribute vec3 finalPosition;
                varying float vProgress;
                varying float vAngle;

                float hash(vec3 p) {
                    p = fract(p * 0.13173);
                    p *= dot(p, p + 19.19);
                    return fract(p.x * p.y * p.z);
                }

                void main() {
                    vec3 start = position;
                    vec3 exploded = mix(start, targetPosition, progExplode);
                    float offset = hash(targetPosition) * 6.28;
                    exploded.y += sin(time * 0.5 + offset) * 0.5 * progExplode;
                    exploded.x += cos(time * 0.5 + offset * 0.5) * 0.5 * progExplode;

                    vec3 finalPos = mix(exploded, finalPosition, progAssemble);
                    vec4 mvPos = modelViewMatrix * vec4(finalPos, 1.0);
                    
                    float sizeFactor = 1.0 + (sin(progExplode * 3.1415) * 2.0);
                    gl_PointSize = (80.0 * sizeFactor) / -mvPos.z; // larger for clearer fiberglass strands
                    gl_Position = projectionMatrix * mvPos;
                    
                    vProgress = progAssemble; 
                    vAngle = hash(finalPosition) * 6.28; // Unique random angle per strand
                }
            `,
            fragmentShader: `
                uniform vec3 baseColor;
                varying float vProgress;
                varying float vAngle;
                
                void main() {
                    vec2 coord = gl_PointCoord - vec2(0.5);
                    
                    // Rotate the coordinate system by vAngle to spin the needle
                    float s = sin(vAngle);
                    float c = cos(vAngle);
                    vec2 rotatedCoord = vec2(
                        coord.x * c - coord.y * s,
                        coord.x * s + coord.y * c
                    );
                    
                    // Draw a thin needle (fiberglass strand)
                    // Thinner and longer for fiberglass look
                    if (abs(rotatedCoord.x) > 0.06 || abs(rotatedCoord.y) > 0.48) discard;
                    
                    // Faded tips
                    float edgeFade = smoothstep(0.48, 0.38, abs(rotatedCoord.y));
                    
                    // Simple tube shading
                    float nx = rotatedCoord.x * 16.0; // scale up across width
                    vec3 normal = vec3(nx, 0.0, sqrt(max(0.0, 1.0 - nx*nx)));
                    vec3 lightDir = normalize(vec3(1.0, 1.0, 1.0));
                    float diff = max(dot(normal, lightDir), 0.0);
                    
                    // High contrast variance for fiberglass
                    float variance = 0.5 + (sin(vAngle * 20.0) * 0.5);
                    vec3 finalColor = baseColor * (diff * 0.5 + 0.5) * variance * edgeFade * 1.5;
                    
                    float alpha = mix(0.15, 1.0, pow(vProgress, 2.0));
                    gl_FragColor = vec4(finalColor, alpha);
                }
            `,
            transparent: true,
            blending: THREE.NormalBlending,
            depthTest: true,
            depthWrite: true
        });

        const particles = new THREE.Points(particleGeo, particleMat);
        mainGroup.add(particles);



        // ============================================
        // 4. ANIMATION LOGIC (NO HEAVY BLOCK, DIRECT TRANSITIONS)
        // ============================================

        const shapeUI = document.getElementById('shape-ui');
        if (shapeUI) shapeUI.innerText = SHAPES[currentShapeIndex].replace(/_/g, ' ');

        const masterTl = gsap.timeline({ repeat: -1 });

        // Phase 1: Assemble into current shape from cloud
        masterTl.to(particleMat.uniforms.progAssemble, { value: 1.0, duration: 2.5, ease: "power3.inOut" }, 0);
        masterTl.to(coreGlow, { intensity: 40, distance: 20, duration: 2 }, 0);
        masterTl.to(particles.rotation, { y: Math.PI * 2, duration: 8, ease: "none" }, 0);
        if (shapeUI) masterTl.to(shapeUI, { opacity: 1, duration: 1.0, ease: "power2.out" }, 1.5); // Fade in badge

        // Phase 2: Hold the assembled shape so user can see it
        masterTl.to({}, { duration: 2.5 });

        // Phase 3: Dissolve back to particle cloud
        if (shapeUI) masterTl.to(shapeUI, { opacity: 0, duration: 1.0, ease: "power2.in" }, 9.5); // Fade out badge before dissolve
        masterTl.to(particleMat.uniforms.progAssemble, { value: 0.0, duration: 1.5, ease: "power2.inOut" });

        // Phase 4: Instant invisible swap to the next shape's math geometry while in the cloud form
        masterTl.call(() => {
            currentShapeIndex = (currentShapeIndex + 1) % SHAPES.length;
            const newShape = SHAPES[currentShapeIndex];
            setShapePositions(newShape);
            if (shapeUI) shapeUI.innerText = newShape.replace(/_/g, ' ');
            // Reset rotation for a clean spin on the next item
            gsap.set(particles.rotation, { y: 0 });
        });

        // Loop repeats, bringing it automatically back to Phase 1 (assembly of new shape)!

        let mouseX = 0;
        let mouseY = 0;
        let targetZoom = 1.0;
        let currentZoom = 1.0;

        heroSection.addEventListener('mousemove', (e) => {
            const rect = heroSection.getBoundingClientRect();
            mouseX = ((e.clientX - rect.left) / cWidth) * 2 - 1;
            mouseY = -((e.clientY - rect.top) / cHeight) * 2 + 1;
        });

        // Mouse engagement - click to zoom
        heroSection.addEventListener('mousedown', () => { targetZoom = 1.4; });
        heroSection.addEventListener('mouseup', () => { targetZoom = 1.0; });
        heroSection.addEventListener('mouseleave', () => {
            targetZoom = 1.0;
            mouseX = 0;
            mouseY = 0;
        });

        // Render Loop
        const clock = new THREE.Clock();
        function animate() {
            requestAnimationFrame(animate);
            const elapsedTime = clock.getElapsedTime();

            controls.update();
            particleMat.uniforms.time.value = elapsedTime;

            // Subtle floating of entire group tracking the responsive offset
            mainGroup.position.x = baseOffsetX;
            mainGroup.position.y = baseOffsetY - 0.5 + Math.sin(elapsedTime) * 0.1;

            // Mouse engagement: Tilt the model based on mouse position
            mainGroup.rotation.x += (mouseY * 0.4 - mainGroup.rotation.x) * 0.05;
            mainGroup.rotation.z += (-mouseX * 0.4 - mainGroup.rotation.z) * 0.05;

            // Mouse engagement: Smooth Zooming on click
            currentZoom += (targetZoom - currentZoom) * 0.1;
            mainGroup.scale.set(currentZoom, currentZoom, currentZoom);

            camera.position.x += (baseOffsetX + mouseX * 1.5 - camera.position.x) * 0.05;
            camera.position.y += (baseOffsetY + 1 + mouseY * 1.5 - camera.position.y) * 0.05;
            camera.lookAt(controls.target);

            renderer.render(scene, camera);
        }

        function updateLayout() {
            cWidth = heroSection.clientWidth;
            cHeight = heroSection.clientHeight;
            camera.aspect = cWidth / cHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(cWidth, cHeight);

            // Sync 3D object to the empty DOM column
            const sectionRect = heroSection.getBoundingClientRect();
            const colRect = canvasCol.getBoundingClientRect();

            let relX;
            if (window.innerWidth > 991) {
                // To balance perfectly, center the object natively within its right-hand column instead of pushing it to the edge
                relX = (colRect.left + colRect.width / 2) - sectionRect.left;
            } else {
                // Center alignment for mobile
                relX = (colRect.left + colRect.width / 2) - sectionRect.left;
            }
            const relY = (colRect.top + colRect.height / 2) - sectionRect.top;

            // Instead of bodily sliding the object and camera in world space (which mathematically cancels out
            // visually and causes the object to remain pinned to the visual center),
            // we use the proper THREE.js frustum offset. 
            // This cleanly maps the true origin (0,0,0) to the targeted pixel coordinate.
            camera.setViewOffset(cWidth, cHeight, (cWidth / 2) - relX, (cHeight / 2) - relY, cWidth, cHeight);

            baseOffsetX = 0;
            baseOffsetY = 0;

            controls.target.set(0, 0, 0);
        }

        updateLayout(); // Initial sync
        window.addEventListener('resize', updateLayout);

        animate();
    </script>

    <!-- Full-width Speed Lines Background -->
    <script>
        (function () {
            const slCanvas = document.getElementById('speed-lines-canvas');
            const slCtx = slCanvas.getContext('2d');
            const heroSection = document.getElementById('hero-module');

            function resizeSpeedCanvas() {
                slCanvas.width = heroSection.offsetWidth;
                slCanvas.height = heroSection.offsetHeight;
            }
            resizeSpeedCanvas();
            window.addEventListener('resize', resizeSpeedCanvas);

            // Create speed line particles
            const NUM_LINES = 80;
            const lines = [];
            for (let i = 0; i < NUM_LINES; i++) {
                lines.push({
                    x: Math.random() * slCanvas.width * 2 - slCanvas.width * 0.5,
                    y: Math.random() * slCanvas.height,
                    length: Math.random() * 180 + 40,
                    speed: Math.random() * 1.5 + 0.3,
                    opacity: Math.random() * 0.10 + 0.01, 
                    thickness: Math.random() * 1.2 + 0.3
                });
            }

            function drawSpeedLines() {
                slCtx.clearRect(0, 0, slCanvas.width, slCanvas.height);

                for (let i = 0; i < NUM_LINES; i++) {
                    const l = lines[i];
                    l.x += l.speed;

                    // Reset when off right edge
                    if (l.x > slCanvas.width + l.length) {
                        l.x = -l.length - Math.random() * 200;
                        l.y = Math.random() * slCanvas.height;
                    }

                    // Draw the line with gradient fade at tips
                    const grad = slCtx.createLinearGradient(l.x, 0, l.x + l.length, 0);
                    grad.addColorStop(0, `rgba(68, 136, 255, 0)`);
                    grad.addColorStop(0.15, `rgba(68, 136, 255, ${l.opacity})`);
                    grad.addColorStop(0.85, `rgba(68, 136, 255, ${l.opacity})`);
                    grad.addColorStop(1, `rgba(68, 136, 255, 0)`);

                    slCtx.beginPath();
                    slCtx.moveTo(l.x, l.y);
                    slCtx.lineTo(l.x + l.length, l.y);
                    slCtx.strokeStyle = grad;
                    slCtx.lineWidth = l.thickness;
                    slCtx.stroke();
                }

                requestAnimationFrame(drawSpeedLines);
            }
            drawSpeedLines();
        })();
    </script>
</body>

</html>