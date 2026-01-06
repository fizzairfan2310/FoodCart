<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FoodCart | Cosmic Bites</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;800&display=swap');
        
        body { 
            margin: 0; 
            background: #020617; 
            font-family: 'Poppins', sans-serif; 
            color: white; 
            min-height: 100vh;
        }

        /* 3D Canvas Background */
        #bg-canvas { 
            position: fixed; 
            top: 0; 
            left: 0; 
            z-index: -1; 
        }

        /* Glassmorphism Classes */
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
        }

        .nav-glass {
            background: rgba(2, 6, 23, 0.8);
            backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .btn-cosmic {
            background: linear-gradient(90deg, #3b82f6, #8b5cf6);
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
        }
        .btn-cosmic:hover { transform: translateY(-2px); box-shadow: 0 0 25px rgba(59, 130, 246, 0.5); }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
    </style>
</head>
<body>

    <canvas id="bg-canvas"></canvas>

    <nav class="fixed top-0 w-full z-50 nav-glass px-6 md:px-12 py-5 flex justify-between items-center">
        <a href="{{ route('home') }}" class="text-3xl font-black italic text-blue-500 tracking-tighter">
            FOOD<span class="text-white">CART</span>
        </a>
        <div class="flex gap-8 items-center">
            <a href="{{ route('home') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 hover:text-blue-400 transition">Home</a>
            <a href="{{ route('cart.index') }}" class="relative text-white group">
                <i class="fas fa-shopping-cart text-lg"></i>
                <span class="absolute -top-3 -right-3 bg-blue-600 text-[10px] font-bold px-2 py-0.5 rounded-full border-2 border-[#020617]">
                    {{ session('cart') ? count(session('cart')) : 0 }}
                </span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="text-[9px] tracking-[0.3em] font-black text-gray-500 hover:text-white transition border border-white/10 px-4 py-2 rounded-xl">
                ADMIN
            </a>
        </div>
    </nav>

    <div class="container mx-auto px-6 pt-32 pb-12 relative z-10">
        @yield('content')
    </div>

    <script>
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ 
            canvas: document.getElementById('bg-canvas'), 
            antialias: true, 
            alpha: true 
        });
        renderer.setSize(window.innerWidth, window.innerHeight);
        renderer.setPixelRatio(window.devicePixelRatio);

        // 3D Cosmic Dust (Admin Stars)
        const starGeo = new THREE.BufferGeometry();
        const posArr = new Float32Array(4000 * 3);
        for(let i=0; i < 12000; i++) posArr[i] = (Math.random() - 0.5) * 100;
        starGeo.setAttribute('position', new THREE.BufferAttribute(posArr, 3));
        const stars = new THREE.Points(starGeo, new THREE.PointsMaterial({ size: 0.015, color: 0x3b82f6 }));
        scene.add(stars);

        camera.position.z = 5;

        function animate() {
            requestAnimationFrame(animate);
            stars.rotation.y += 0.0003;
            stars.rotation.x += 0.0001;
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