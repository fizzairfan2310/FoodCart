@extends('layouts.app')

@section('content')
<div class="container mx-auto px-6 pb-20">
    
    <div class="relative rounded-[40px] overflow-hidden bg-gradient-to-r from-blue-900/40 to-purple-900/40 border border-white/10 mb-16">
        <div class="flex flex-col md:flex-row items-center justify-between px-10 py-16">
            <div class="md:w-1/2 z-10">
                <span class="bg-blue-500/20 text-blue-400 text-[10px] font-black tracking-[0.3em] px-4 py-2 rounded-full uppercase mb-6 inline-block">Limited Time Offer</span>
                <h2 class="text-5xl md:text-7xl font-black text-white leading-none mb-6 uppercase italic tracking-tighter">50% OFF ON <br> <span class="text-blue-500">GALAXY PIZZA</span></h2>
                <div class="relative max-w-md mt-8">
                    <input type="text" placeholder="Search for cosmic cravings..." class="w-full bg-white/5 border border-white/10 py-5 px-6 rounded-2xl text-white outline-none focus:border-blue-500 transition-all">
                </div>
            </div>
            <div class="hidden md:block md:w-1/2">
                <img src="https://pngimg.com/uploads/pizza/pizza_PNG44090.png" class="w-[450px] animate-bounce-slow" alt="Hero Pizza">
            </div>
        </div>
    </div>

    <div class="mb-16">
        <h3 class="text-xs font-black uppercase tracking-[0.4em] text-gray-500 mb-8 ml-2">Browse Fleet</h3>
        <div class="flex gap-6 overflow-x-auto pb-4 no-scrollbar">
            @foreach($categories as $category)
            <div class="group cursor-pointer min-w-[100px]">
                <div class="w-24 h-24 bg-white/5 border border-white/10 rounded-[30px] flex items-center justify-center mb-4 group-hover:bg-blue-600 transition-all duration-300">
                    <i class="fas fa-utensils text-2xl text-gray-400 group-hover:text-white"></i>
                </div>
                <p class="text-center text-[10px] font-black uppercase tracking-widest text-gray-500 group-hover:text-white">{{ $category->name }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
        @forelse($foods as $food)
        <div class="glass-card p-4 group hover:border-blue-500/50 transition-all duration-500">
            <div class="relative mb-6 overflow-hidden rounded-2xl h-48 bg-gray-900">
                
                @php
                    // Safaya: Agar database mein 'uploads/' pehle se hai to theek, warna add karo
                    $imageName = str_replace('uploads/', '', $food->image);
                @endphp

                <img src="{{ asset('uploads/' . $imageName) }}" 
                     alt="{{ $food->name }}" 
                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                     onerror="this.onerror=null;this.src='https://placehold.co/600x400/020617/3b82f6?text=Check+Uploads+Folder';">
                
                <div class="absolute top-3 right-3 bg-black/60 backdrop-blur-md px-3 py-1 rounded-full border border-white/10">
                    <span class="text-blue-400 font-black text-xs">Rs. {{ $food->price }}</span>
                </div>
            </div>
            
            <h4 class="text-lg font-black uppercase tracking-tight text-white mb-2">{{ $food->name }}</h4>
            <p class="text-gray-500 text-xs mb-6 line-clamp-2">{{ $food->description }}</p>
            
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-1 text-orange-500 text-[10px]">
                    <i class="fas fa-star"></i> <span class="text-white">4.9</span>
                </div>
                <a href="{{ route('cart.add', $food->id) }}" class="bg-white/10 hover:bg-blue-600 text-white p-3 rounded-xl">
                    <i class="fas fa-plus text-xs"></i>
                </a>
            </div>
        </div>
        @empty
            <p class="text-white col-span-full text-center py-10">No cosmic items found.</p>
        @endforelse
    </div>
</div>

<style>
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .glass-card { background: rgba(255, 255, 255, 0.03); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 30px; }
    @keyframes bounce-slow { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
    .animate-bounce-slow { animation: bounce-slow 6s infinite; }
</style>
@endsection