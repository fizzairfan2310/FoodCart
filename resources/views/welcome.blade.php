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
        
        body { 
            margin: 0; 
            background: #020617; 
            overflow: hidden; 
            font-family: 'Poppins', sans-serif; 
            color: white; 
            height: 100vh;
        }

        #bg-canvas { 
            position: fixed; 
            top: 0; 
            left: 0; 
            z-index: 1; 
            pointer-events: none;
        }

        .hero-title { 
            font-family: 'Syncopate', sans-serif; 
            background: linear-gradient(to bottom, #ffffff 40%, #3b82f6 100%); 
            -webkit-background-clip: text; 
            -webkit-text-fill-color: transparent; 
            line-height: 0.9; 
        }

        .btn-cosmic {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.6);
            transition: all 0.4s ease;
        }
    </style>
</head>
<body>

    <canvas id="bg-canvas"></canvas>

    <nav class="fixed top-0 w-full z-50 px-10 py-8 flex justify-between items-center">
        <div class="text-3xl font-black italic tracking-tighter text-blue-500">FOOD<span class="text-white">CART</span></div>
        <div class="flex gap-8 items-center">
            <a href="{{ route('login') }}" class="text-[10px] font-bold tracking-[0.2em] text-gray-400 hover:text-white uppercase">Admin</a>
            <a href="{{ route('login') }}" class="text-[10px] font-bold tracking-[0.2em] text-gray-400 hover:text-white uppercase">Login</a>
            <a href="{{ route('register') }}" class="bg-blue-600/10 border border-blue-500/50 px-5 py-2 rounded-xl text-blue-500 font-black text-[10px] tracking-widest hover:bg-blue-600 hover:text-white transition-all uppercase">Sign Up</a>
        </div>
    </nav>

    <main class="relative z-20 h-screen flex items-center px-10 md:px-24">
        <div class="max-w-2xl">
            <h1 class="text-7xl md:text-9xl hero-title font-black mb-6 uppercase">FAST<br>FOOD.</h1>
            <p class="text-gray-400 text-xl mb-10 max-w-sm">Cosmic flavours delivered from the stars. Choose your craving.</p>
            
            <div class="mt-10">
                @if(session('user_id'))
                    <a href="{{ route('home') }}" class="btn-cosmic inline-flex items-center gap-3 px-12 py-5 rounded-2xl font-black text-lg tracking-widest text-white animate-pulse">
                        LAUNCH ORDER SEQUENCE <i class="fas fa-bolt"></i>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn-cosmic inline-flex items-center gap-3 px-12 py-5 rounded-2xl font-black text-lg tracking-widest text-white animate-pulse">
                        INITIATE LOGIN SEQUENCE <i class="fas fa-sign-in-alt"></i>
                    </a>
                @endif
            </div>
        </div>
    </main>

    <script>
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(45, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ canvas: document.getElementById('bg-canvas'), antialias: true, alpha: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);

        // --- ADMIN PANEL STYLE SLOW COSMIC DUST ---
        const starGeo = new THREE.BufferGeometry();
        const posArr = new Float32Array(4000 * 3);
        for(let i=0; i < 12000; i++) posArr[i] = (Math.random() - 0.5) * 100;
        starGeo.setAttribute('position', new THREE.BufferAttribute(posArr, 3));
        const stars = new THREE.Points(starGeo, new THREE.PointsMaterial({ size: 0.015, color: 0x3b82f6 }));
        scene.add(stars);

        scene.add(new THREE.AmbientLight(0xffffff, 1.5));
        const dirLight = new THREE.DirectionalLight(0xffffff, 2);
        dirLight.position.set(5, 5, 5);
        scene.add(dirLight);

        const loader = new THREE.GLTFLoader();
        let models = []; 

        function loadFood(path, x, y, z, scale) {
            loader.load(path, (gltf) => {
                const model = gltf.scene;
                model.scale.set(scale, scale, scale);
                model.position.set(x, y, z);
                scene.add(model);
                models.push(model);
            });
        }

        // --- BACK TO YOUR ORIGINAL CLUSTER POSITIONS ---
        loadFood('/models/pizza.glb', 4, 0, 0, 6); 
        loadFood('/models/burger.glb', 5.5, 1.8, -1, 8); 
        loadFood('/models/cake.glb', 3.5, -2, -1, 60);

        camera.position.z = 12;

        let mouseX = 0, mouseY = 0;
        window.addEventListener('mousemove', (e) => {
            mouseX = (e.clientX / window.innerWidth) - 0.5;
            mouseY = (e.clientY / window.innerHeight) - 0.5;
        });

        function animate() {
            requestAnimationFrame(animate);
            const time = Date.now() * 0.001;
            
            // Slow rotation from Admin Panel
            stars.rotation.y += 0.0003;
            stars.rotation.x += 0.0001;

            models.forEach((model, index) => {
                model.rotation.y += 0.01;
                model.position.y += Math.sin(time + index) * 0.003;
                
                // Mouse follow from your original logic
                model.rotation.x = mouseY * 0.3;
                model.position.x += (mouseX * 0.5 - (model.position.x - (4 + index))) * 0.02;
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