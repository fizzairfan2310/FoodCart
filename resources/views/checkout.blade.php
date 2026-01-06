@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-4">
    <div class="mb-10 text-center md:text-left">
        <h2 class="text-5xl font-black mb-2 uppercase tracking-tighter text-white">
            Final <span class="text-blue-500">Checkout</span>
        </h2>
        <p class="text-gray-400 tracking-widest text-sm uppercase">Confirm your cargo destination</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10">
        
        <div class="lg:col-span-5">
            <div class="glass-card p-8 sticky top-32 border border-white/10 shadow-2xl">
                <h3 class="text-xl font-bold mb-6 text-blue-400 uppercase tracking-widest flex items-center gap-3">
                    <i class="fas fa-shopping-basket"></i> Order Summary
                </h3>
                
                <div class="space-y-6 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cart as $id => $item)
                    <div class="flex justify-between items-center group">
                        <div class="flex items-center gap-4">
                            <div class="relative">
                                <img src="/uploads/{{ $item['image'] }}" class="w-16 h-16 rounded-xl object-cover border border-white/10 group-hover:border-blue-500/50 transition">
                                <span class="absolute -top-2 -right-2 bg-blue-600 text-[10px] font-black w-5 h-5 flex items-center justify-center rounded-full border border-[#020617]">
                                    {{ $item['quantity'] }}
                                </span>
                            </div>
                            <div>
                                <p class="font-bold text-white group-hover:text-blue-400 transition">{{ $item['name'] }}</p>
                                <p class="text-xs text-gray-500">Unit Price: Rs {{ number_format($item['price']) }}</p>
                            </div>
                        </div>
                        <p class="font-black text-white">Rs {{ number_format($item['price'] * $item['quantity']) }}</p>
                    </div>
                    @endforeach
                </div>
                
                <div class="mt-8 pt-6 border-t border-white/10">
                    <div class="flex justify-between items-center mb-2">
                        <p class="text-gray-400">Subtotal</p>
                        <p class="text-white font-bold">Rs {{ number_format($total) }}</p>
                    </div>
                    <div class="flex justify-between items-center mb-6">
                        <p class="text-gray-400">Shipping</p>
                        <p class="text-green-400 font-bold uppercase text-xs tracking-widest">Free Delivery</p>
                    </div>
                    <div class="flex justify-between items-center bg-white/5 p-4 rounded-2xl border border-white/5">
                        <p class="text-lg font-bold text-blue-400">Total Payload:</p>
                        <p class="text-3xl font-black text-white">Rs {{ number_format($total) }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-7">
            <div class="glass-card p-10 border border-white/10 shadow-2xl">
                <h3 class="text-xl font-bold mb-8 text-blue-400 uppercase tracking-widest flex items-center gap-3">
                    <i class="fas fa-truck-fast"></i> Delivery Details
                </h3>

                <form action="{{ route('place.order') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Commander Name</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}" 
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:outline-none focus:border-blue-500 focus:bg-white/10 transition text-white placeholder-gray-600"
                                placeholder="Full Name" required>
                            @error('customer_name') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                        </div>

                        <div class="space-y-2">
                            <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Email Address</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}" 
                                class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:outline-none focus:border-blue-500 focus:bg-white/10 transition text-white placeholder-gray-600"
                                placeholder="name@galaxy.com" required>
                            @error('customer_email') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Contact Number</label>
                        <div class="relative">
                            <span class="absolute left-5 top-1/2 -translate-y-1/2 text-gray-500 border-r border-white/10 pr-3">+92</span>
                            <input type="text" name="customer_phone" value="{{ old('customer_phone') }}" 
                                class="w-full bg-white/5 border border-white/10 rounded-2xl pl-20 pr-5 py-4 focus:outline-none focus:border-blue-500 focus:bg-white/10 transition text-white placeholder-gray-600"
                                placeholder="300 1234567" required>
                        </div>
                        @error('customer_phone') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">Space Station Address</label>
                        <textarea name="customer_address" rows="4" 
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-5 py-4 focus:outline-none focus:border-blue-500 focus:bg-white/10 transition text-white placeholder-gray-600 resize-none"
                            placeholder="Street, House, Sector, City..." required>{{ old('customer_address') }}</textarea>
                        @error('customer_address') <p class="text-red-500 text-xs italic">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex flex-col md:flex-row gap-4 pt-4">
                        <a href="{{ route('cart.index') }}" class="flex-1 text-center py-4 rounded-2xl border border-white/10 hover:bg-white/5 font-bold transition">
                            <i class="fas fa-arrow-left mr-2"></i> BACK TO CARGO
                        </a>
                        <button type="submit" class="flex-[2] btn-cosmic py-4 rounded-2xl font-black text-lg tracking-widest shadow-xl shadow-blue-500/30 transition-all hover:scale-[1.02]">
                            PLACE COSMIC ORDER <i class="fas fa-paper-plane ml-2"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    /* Custom Scrollbar for Order Summary */
    .custom-scrollbar::-webkit-scrollbar { width: 4px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 10px; }
    .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: rgba(59, 130, 246, 0.5); }
</style>
@endsection