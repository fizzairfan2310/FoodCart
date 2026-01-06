<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FoodCart')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syncopate:wght@700&family=Poppins:wght@300;600;900&display=swap');

        body {
            margin: 0;
            background: #020617;
            font-family: 'Poppins', sans-serif;
            color: white;
            min-height: 100vh;
        }

        /* Background Canvas Styling */
        #bg-canvas {
            position: fixed;
            top: 0;
            left: 0;
            z-index: -1; /* Content ke peeche */
            pointer-events: none;
        }

        .nav-glass {
            background: rgba(2, 6, 23, 0.8);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        /* Glass Cards for Home/Cart */
        .glass-card { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 30px; 
        }
    </style>
    @yield('styles')
</head>
<body>

    <canvas id="bg-canvas"></canvas>

    <nav class="nav-glass fixed top-0 w-full z-50 px-10 py-6">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-3xl font-black italic tracking-tighter text-blue-500">
                FOOD<span class="text-white">CART</span>
            </a>
            
            <div class="flex gap-8 items-center">
                <a href="{{ route('home') }}" class="text-[10px] tracking-[0.3em] font-bold text-gray-400 hover:text-white transition uppercase">
                    <i class="fas fa-home mr-1"></i> Home
                </a>
                
                <a href="{{ route('cart.index') }}" class="text-[10px] tracking-[0.3em] font-bold text-gray-400 hover:text-white transition uppercase">
                    <i class="fas fa-shopping-cart mr-1"></i> Cart
                </a>

                @if(session('user_role') === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="text-[10px] tracking-[0.3em] font-bold text-blue-500 hover:text-white transition uppercase">
                        <i class="fas fa-tachometer-alt mr-1"></i> Admin
                    </a>
                @endif

                <div class="flex items-center gap-3">
                    @if(session()->has('user_name'))
                        <a href="{{ route('logout') }}" class="bg-red-500/10 border border-red-500/50 text-red-500 hover:bg-red-500 hover:text-white px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider transition">
                            LOGOUT
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-400 text-[10px] font-black uppercase tracking-wider hover:text-white">Login</a>
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <main class="pt-32 relative z-10">
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

        // Cosmic Dust (Same as Admin)
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
    @yield('scripts')
</body>
</html>