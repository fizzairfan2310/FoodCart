<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Fleet | FoodCart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;900&display=swap');
        body { margin: 0; background: #020617; font-family: 'Poppins', sans-serif; color: white; display: flex; align-items: center; justify-content: center; min-height: 100vh; overflow: hidden; }
        
        .glass-card { 
            background: rgba(255, 255, 255, 0.03); 
            backdrop-filter: blur(15px); 
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 24px; 
        }
        .btn-cosmic { 
            background: linear-gradient(90deg, #3b82f6, #8b5cf6); 
            box-shadow: 0 0 25px rgba(59, 130, 246, 0.3);
            transition: all 0.3s ease; 
        }
        .btn-cosmic:hover { transform: translateY(-2px); box-shadow: 0 0 35px rgba(59, 130, 246, 0.5); }
        
        .bg-glow {
            position: absolute;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
            z-index: -1;
        }
    </style>
</head>
<body>
    <div class="bg-glow"></div>

    <div class="glass-card p-10 w-full max-w-md relative mx-4">
        <a href="{{ route('landing') }}" class="absolute top-6 left-6 text-gray-500 hover:text-white transition text-[10px] uppercase tracking-widest font-black">
            <i class="fas fa-chevron-left mr-2"></i> Exit
        </a>

        <div class="mt-8 text-center">
            <h2 class="text-3xl font-black uppercase tracking-tighter text-white mb-2">Access <span class="text-purple-500">Fleet</span></h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.3em] mb-10">Enter your cosmic credentials</p>
        </div>

        <form method="GET" action="{{ route('home') }}" class="space-y-6">
            <div>
                <label class="text-[9px] font-black uppercase tracking-widest text-gray-500 block mb-2">Pilot Identity (Email)</label>
                <input type="email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white focus:border-purple-500 outline-none transition" placeholder="COMMANDER@GALAXY.COM" required>
            </div>

            <div>
                <div class="flex justify-between items-center mb-2">
                    <label class="text-[9px] font-black uppercase tracking-widest text-gray-500 block">Security Key</label>
                    <a href="#" class="text-[8px] font-black text-purple-500 uppercase tracking-widest hover:text-white transition">Lost Key?</a>
                </div>
                <input type="password" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white focus:border-purple-500 outline-none transition" placeholder="••••••••" required>
            </div>

            <button type="submit" class="btn-cosmic w-full py-4 rounded-xl font-black text-[10px] tracking-[0.4em] text-white mt-4 uppercase">
                Initialize Login
            </button>

            <p class="text-center text-[9px] text-gray-500 uppercase tracking-widest mt-8">
                New to the mission? <a href="{{ route('register') }}" class="text-purple-500 font-black hover:text-white transition">Create Identity</a>
            </p>
        </form>
    </div>
</body>
</html>