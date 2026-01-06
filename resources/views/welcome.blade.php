<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodCart | Cosmic Bites</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syncopate:wght@700&family=Poppins:wght@300;600;900&display=swap');
        body { margin: 0; background: #020617; overflow: hidden; font-family: 'Poppins', sans-serif; color: white; }
        #bg-canvas { position: fixed; top: 0; left: 0; z-index: -1; }
        .hero-title { font-family: 'Syncopate', sans-serif; background: linear-gradient(to bottom, #ffffff 40%, #3b82f6 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 0.9; }
        .order-btn { background: linear-gradient(90deg, #3b82f6, #8b5cf6); box-shadow: 0 0 25px rgba(59, 130, 246, 0.4); transition: all 0.3s ease; }
        
        /* New Button Style for Nav */
        .nav-link { font-[9px] font-bold uppercase tracking-[0.2em] text-gray-400 hover:text-white transition; }
        .signup-btn { background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.5); padding: 8px 20px; border-radius: 12px; color: #3b82f6; font-weight: 900; font-size: 10px; tracking: 0.2em; transition: all 0.3s; }
        .signup-btn:hover { background: #3b82f6; color: white; box-shadow: 0 0 15px rgba(59, 130, 246, 0.4); }
    </style>
</head>
<body>

    <canvas id="bg-canvas"></canvas>

    <nav class="fixed top-0 w-full z-50 px-10 py-8 flex justify-between items-center bg-gradient-to-b from-[#020617] to-transparent">
        <div class="text-3xl font-black italic tracking-tighter text-blue-500">FOOD<span class="text-white">CART</span></div>
        
        <div class="flex gap-8 items-center">
            <a href="{{ route('admin.dashboard') }}" class="text-[10px] tracking-[0.3em] font-bold text-gray-500 hover:text-white transition uppercase">Admin</a>
            
            <a href="{{ route('login') }}" class="nav-link text-[10px] font-black uppercase tracking-[0.2em]">Login</a>
            <a href="{{ route('register') }}" class="signup-btn uppercase">Sign Up</a>
        </div>
    </nav>

    <main class="relative z-10 h-screen flex items-center px-10 md:px-24 pointer-events-none">
        <div class="w-full md:w-1/2 pointer-events-auto">
            <h1 class="text-7xl md:text-9xl hero-title font-black mb-6 uppercase">FAST<br>FOOD.</h1>
            <p class="text-gray-400 text-xl mb-10 max-w-sm">Cosmic flavours delivered from the stars. Choose your craving.</p>
            <a href="{{ route('home') }}" class="order-btn inline-flex items-center gap-3 px-12 py-5 rounded-2xl font-black text-lg text-white">
                START ORDERING <i class="fas fa-bolt"></i>
            </a>
        </div>
    </main>

    <script>
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('bg-canvas'), antialias: true, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);

        // 1. Galaxy Stars
        const starGeo = new THREE.BufferGeometry();
        const posArr = new Float32Array(6000 * 3);
        for(let i=0; i < 18000; i++) posArr[i] = (Math.random() - 0.5) * 100;
        starGeo.setAttribute('position', new THREE.BufferAttribute(posArr, 3));
        scene.add(new THREE.Points(starGeo, new THREE.PointsMaterial({ size: 0.015, color: 0xffffff })));

        // 2. Lighting
        scene.add(new THREE.AmbientLight(0xffffff, 1.2));
        const dirLight = new THREE.DirectionalLight(0xffffff, 2);
        dirLight.position.set(5, 5, 5);
        scene.add(dirLight);

        // 3. Multi-Model Loading Logic
        const loader = new THREE.GLTFLoader();
        let models = []; 

        function loadFood(path, xPos, yOffset, scale) {
            loader.load(path, (gltf) => {
                const model = gltf.scene;
                model.scale.set(scale, scale, scale);
                model.position.set(xPos, 0, 0);
                model.userData.yOffset = yOffset; 
                scene.add(model);
                models.push(model);
            }, undefined, (err) => console.error("Error loading: " + path));
        }

        loadFood('/models/pizza.glb', 3.6, 0.5, 6); 
        loadFood('/models/burger.glb', 4.0, 0.5, 8); 
        loadFood('/models/cake.glb', -12.0, 0.5, 80);
        loadFood('/models/orange_juice.glb', 0, 0, 40);

        camera.position.z = 12;

        let mouseX = 0, mouseY = 0;
        window.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX / window.innerWidth) - 0.5;
            mouseY = (e.clientY / window.innerHeight) - 0.5;
        });

        function animate() {
            requestAnimationFrame(animate);
            const time = Date.now() * 0.001;
            
            models.forEach((model, index) => {
                model.rotation.y += 0.01 + (index * 0.005);
                model.rotation.x = mouseY * 0.3;
                model.position.y = Math.sin(time + index) * 0.5;
                const targetX = (mouseX * 4) + (window.innerWidth > 768 ? 4 : 0);
                const relativeX = (index - 1) * 2.5; 
                model.position.x += (targetX + relativeX - model.position.x) * 0.05;
            });

            renderer.render(scene, camera);
        }
        animate();

        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>
</html>