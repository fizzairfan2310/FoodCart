@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 pb-12">
    <div class="mb-6">
        <h2 class="text-3xl font-black uppercase tracking-tighter text-white">Final <span class="text-blue-500">Checkout</span></h2>
        <p class="text-gray-500 tracking-widest text-[9px] uppercase">Confirm your docking station</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
        <div class="lg:col-span-4 order-2 lg:order-1">
            <div class="glass-card p-5 bg-white/5 border-white/10">
                <h3 class="text-xs font-black mb-5 text-blue-400 uppercase tracking-widest">Order Summary</h3>
                <div class="space-y-4 max-h-[300px] overflow-y-auto pr-2 custom-scrollbar">
                    @foreach($cart as $id => $item)
                    <div class="flex justify-between items-center text-xs">
                        <div class="flex items-center gap-3">
                            <img src="/uploads/{{ $item['image'] }}" class="w-10 h-10 rounded-lg object-cover border border-white/5">
                            <div>
                                <p class="font-bold text-white uppercase">{{ $item['name'] }} <span class="text-blue-500">x{{ $item['quantity'] }}</span></p>
                                <p class="text-[9px] text-gray-500">Rs {{ number_format($item['price']) }}</p>
                            </div>
                        </div>
                        <p class="font-bold text-white">Rs {{ number_format($item['price'] * $item['quantity']) }}</p>
                    </div>
                    @endforeach
                </div>
                <div class="mt-5 pt-4 border-t border-white/10 space-y-2">
                    <div class="flex justify-between text-[10px] uppercase text-gray-500 font-bold">
                        <span>Delivery</span>
                        <span class="text-green-500">Free</span>
                    </div>
                    <div class="flex justify-between items-end pt-2">
                        <span class="text-[9px] font-black text-blue-400 uppercase">Total:</span>
                        <span class="text-2xl font-black text-white">Rs {{ number_format($total) }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="lg:col-span-8 order-1 lg:order-2">
            <div class="glass-card p-8 border-white/10 relative overflow-hidden">
                <form action="{{ route('place.order') }}" method="POST" class="space-y-5">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black uppercase text-gray-500 ml-1">Commander Name</label>
                            <input type="text" name="customer_name" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-blue-500 text-sm text-white" required>
                        </div>
                        <div class="space-y-1.5">
                            <label class="text-[9px] font-black uppercase text-gray-500 ml-1">Email</label>
                            <input type="email" name="customer_email" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-blue-500 text-sm text-white" required>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black uppercase text-gray-500 ml-1">Contact Hotline</label>
                        <input type="text" name="customer_phone" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-blue-500 text-sm text-white font-mono" placeholder="+92 ..." required>
                    </div>
                    <div class="space-y-1.5">
                        <label class="text-[9px] font-black uppercase text-gray-500 ml-1">Space Station Address</label>
                        <textarea name="customer_address" rows="2" class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 focus:border-blue-500 text-sm text-white resize-none" required></textarea>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 pt-2">
                        <a href="{{ route('cart.index') }}" class="flex-1 text-center py-3.5 rounded-xl border border-white/5 text-gray-500 hover:text-white text-[9px] font-black uppercase tracking-widest transition">Abort</a>
                        <button type="submit" class="flex-[2] btn-cosmic py-3.5 rounded-xl font-black text-xs tracking-widest hover:scale-[1.02] transition-all">PLACE ORDER</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .glass-card { background: rgba(255, 255, 255, 0.02); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.05); border-radius: 24px; }
    .btn-cosmic { background: linear-gradient(135deg, #3b82f6, #8b5cf6); color: white; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); }
    .custom-scrollbar::-webkit-scrollbar { width: 3px; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 10px; }
</style>
@endsection