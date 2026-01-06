@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 pb-12">
    <div class="mb-8">
        <h2 class="text-3xl font-black uppercase tracking-tighter text-white">
            Your <span class="text-blue-500 italic">Cargo</span>
        </h2>
        <p class="text-gray-500 text-[9px] tracking-[0.2em] uppercase ml-0.5">Review items before launch</p>
    </div>

    @if(empty($cart))
        <div class="glass-card p-12 text-center border-dashed border border-white/10">
            <i class="fas fa-rocket text-blue-500/20 text-4xl mb-4"></i>
            <p class="text-gray-400 text-sm mb-6 uppercase tracking-widest">Cargo bay is empty</p>
            <a href="{{ route('home') }}" class="btn-cosmic px-6 py-3 rounded-xl font-bold text-[10px] tracking-widest inline-block">GO TO MENU</a>
        </div>
    @else
        <div class="space-y-3 mb-8">
            @foreach($cart as $id => $item)
            <div class="glass-card p-3 flex items-center justify-between gap-4 hover:border-blue-500/30 transition-all">
                <div class="flex items-center gap-4 flex-1">
                    <img src="/uploads/{{ $item['image'] }}" class="w-14 h-14 rounded-xl object-cover border border-white/5">
                    <div>
                        <h4 class="text-sm font-black text-white uppercase tracking-tight">{{ $item['name'] }}</h4>
                        <p class="text-blue-400 font-mono text-[10px]">Rs {{ number_format($item['price']) }}</p>
                    </div>
                </div>

                <div class="flex items-center gap-3 bg-white/5 px-3 py-1.5 rounded-lg border border-white/5">
                    <span class="text-gray-500 text-[9px] font-bold uppercase">Qty</span>
                    <span class="text-sm font-black text-white">{{ $item['quantity'] }}</span>
                </div>

                <div class="text-right min-w-[100px]">
                    <p class="text-sm font-black text-white font-mono text-blue-400">Rs {{ number_format($item['price'] * $item['quantity']) }}</p>
                </div>

                <a href="/cart/remove/{{ $id }}" class="w-8 h-8 rounded-lg flex items-center justify-center bg-red-500/10 text-red-500 hover:bg-red-500 hover:text-white transition-all">
                    <i class="fas fa-trash-alt text-[10px]"></i>
                </a>
            </div>
            @endforeach
        </div>

        <div class="glass-card p-6 flex flex-col md:flex-row justify-between items-center gap-6 border-t-0 shadow-xl shadow-blue-900/10">
            <div class="text-center md:text-left">
                <p class="text-[9px] text-gray-500 uppercase tracking-widest mb-1">Total Payload</p>
                <p class="text-3xl font-black text-white italic">Rs {{ number_format($total) }}</p>
            </div>
            <div class="flex gap-3 w-full md:w-auto">
                <a href="{{ route('cart.clear') }}" class="flex-1 md:flex-none px-5 py-3 rounded-xl border border-white/10 text-gray-500 hover:text-red-400 text-[9px] font-black uppercase tracking-widest text-center">Clear</a>
                <a href="{{ route('checkout') }}" class="flex-[2] md:flex-none btn-cosmic px-8 py-3 rounded-xl font-black text-sm tracking-widest text-white text-center">CHECKOUT</a>
            </div>
        </div>
    @endif
</div>
@endsection