<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | FoodCart Cosmic</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;600;900&display=swap');
        body { background: #020617; font-family: 'Poppins', sans-serif; color: white; }
        .glass-card { background: rgba(255,255,255,0.05); backdrop-filter: blur(20px); border: 1px solid rgba(255,255,255,0.1); }
        .btn-cosmic { background: linear-gradient(135deg, #3b82f6, #8b5cf6); box-shadow: 0 0 30px rgba(59,130,246,0.5); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

    <div class="glass-card p-10 rounded-3xl shadow-2xl w-full max-w-md border border-white/10">
        <div class="text-center mb-10">
            <h1 class="text-5xl font-black uppercase tracking-tighter mb-2">FOOD<span class="text-blue-500">CART</span></h1>
            <p class="text-gray-400 text-sm uppercase tracking-widest">Join the Cosmic Fleet</p>
        </div>

        @if(session('success'))
            <div class="bg-green-500/20 border border-green-500/50 text-green-400 p-4 rounded-xl mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ url('/register') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-gray-400 text-xs uppercase tracking-widest mb-2">Name</label>
                <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-blue-500 outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 text-xs uppercase tracking-widest mb-2">Email</label>
                <input type="email" name="email" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-blue-500 outline-none">
            </div>

            <div class="mb-6">
                <label class="block text-gray-400 text-xs uppercase tracking-widest mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-blue-500 outline-none">
            </div>

            <div class="mb-8">
                <label class="block text-gray-400 text-xs uppercase tracking-widest mb-2">Confirm Password</label>
                <input type="password" name="password_confirmation" required class="w-full bg-white/5 border border-white/10 rounded-xl px-5 py-4 text-white focus:border-blue-500 outline-none">
            </div>

            <button type="submit" class="btn-cosmic w-full py-5 rounded-2xl font-black text-lg tracking-widest uppercase hover:scale-105 transition-all shadow-xl">
                Initialize Account <i class="fas fa-user-plus ml-2"></i>
            </button>
        </form>

        <p class="text-center mt-8 text-gray-500 text-xs uppercase tracking-widest">
            Already registered? 
            <a href="{{ route('login') }}" class="text-blue-400 font-black hover:text-white">Login Here</a>
        </p>
    </div>

</body>
</html>