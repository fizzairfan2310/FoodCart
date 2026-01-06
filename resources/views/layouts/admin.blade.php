<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | FoodCart Cosmic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/three@0.128.0/examples/js/loaders/GLTFLoader.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syncopate:wght@700&family=Poppins:wght@300;600;900&display=swap');
        
        body { 
            margin: 0; 
            background: #020617; 
            font-family: 'Poppins', sans-serif; 
            color: white; 
            min-height: 100vh;
        }

        #bg-canvas { 
            position: fixed; 
            top: 0; 
            left: 0; 
            z-index: -1; 
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
        }

        .nav-glass {
            background: rgba(2, 6, 23, 0.8);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #020617; }
        ::-webkit-scrollbar-thumb { background: #1e293b; border-radius: 10px; }
        ::-webkit-scrollbar-thumb:hover { background: #3b82f6; }
    </style>
</head>
<body>

<canvas id="bg-canvas"></canvas>

<nav class="nav-glass sticky top-0 z-50">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center py-5">
            <a href="{{ route('admin.dashboard') }}" class="text-2xl font-black italic tracking-tighter text-blue-500">
                FOOD<span class="text-white">CART</span>
                <span class="text-[10px] uppercase tracking-[0.3em] ml-2 text-gray-500 italic">Admin</span>
            </a>
            
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('admin.dashboard') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-blue-400 transition">
                    <i class="fas fa-tachometer-alt mr-1"></i> Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-blue-400 transition">
                    <i class="fas fa-list mr-1"></i> Categories
                </a>
                <a href="{{ route('admin.foods.index') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-blue-400 transition">
                    <i class="fas fa-hamburger mr-1"></i> Foods
                </a>
                <a href="{{ route('admin.orders') }}" class="text-[10px] font-bold uppercase tracking-widest text-gray-400 hover:text-blue-400 transition">
                    <i class="fas fa-shopping-bag mr-1"></i> Orders
                </a>

                <!-- ✅ LOGOUT BUTTON (ADDED) -->
                <a href="{{ route('logout') }}"
                   class="bg-red-500/10 border border-red-500/40 text-red-400 hover:bg-red-500 hover:text-white px-4 py-2 rounded-lg text-[10px] font-black uppercase tracking-widest transition">
                    <i class="fas fa-sign-out-alt mr-1"></i> Logout
                </a>

                <a href="{{ route('home') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-black px-4 py-2 rounded-lg transition uppercase tracking-widest" target="_blank">
                    View Site <i class="fas fa-external-link-alt ml-1"></i>
                </a>
            </div>
        </div>
    </div>
</nav>

<div class="container mx-auto px-6 mt-6">
    @if(session('success'))
        <div class="glass-card bg-green-500/10 border-green-500/20 text-green-400 px-6 py-4 mb-4">
            <span class="text-sm font-bold uppercase tracking-wide">{{ session('success') }}</span>
        </div>
    @endif
</div>

<main class="container mx-auto px-6 py-8">
    @yield('content')
</main>

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
