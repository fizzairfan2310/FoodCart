@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto">
    <h2 class="text-4xl font-black mb-8 uppercase tracking-tighter">Your <span class="text-blue-500">Cargo Bay</span></h2>

    @if(empty($cart))
        <div class="glass-card p-16 text-center">
            <i class="fas fa-rocket text-gray-700 text-7xl mb-6"></i>
            <p class="text-xl text-gray-400 mb-8">No fuel found in cargo. Let's explore the menu!</p>
            <a href="{{ route('home') }}" class="btn-cosmic px-10 py-4 rounded-2xl font-black inline-block">GO TO MENU</a>
        </div>
    @else
        <div class="glass-card overflow-hidden border border-white/10 shadow-2xl">
            <table class="w-full">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr class="text-gray-400 text-xs uppercase tracking-[0.2em]">
                        <th class="px-6 py-5 text-left">Item</th>
                        <th class="px-6 py-5 text-center">Price</th>
                        <th class="px-6 py-5 text-center">Qty</th>
                        <th class="px-6 py-5 text-right">Total</th>
                        <th class="px-6 py-5"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @foreach($cart as $id => $item)
                    <tr class="hover:bg-white/5 transition">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-4">
                                <img src="/uploads/{{ $item['image'] }}" class="w-16 h-16 rounded-xl object-cover border border-white/10">
                                <span class="font-bold text-lg text-white">{{ $item['name'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-center text-gray-300 font-mono">Rs {{ number_format($item['price']) }}</td>
                        <td class="px-6 py-4 text-center font-black text-xl">{{ $item['quantity'] }}</td>
                        <td class="px-6 py-4 text-right font-black text-blue-400 font-mono">Rs {{ number_format($item['price'] * $item['quantity']) }}</td>
                        <td class="px-6 py-4 text-center">
                            <a href="/cart/remove/{{ $id }}" class="text-gray-500 hover:text-red-400 transition p-2"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="p-10 bg-white/5 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="text-center md:text-left">
                    <p class="text-xs text-gray-500 uppercase tracking-widest mb-1">Total Payload Cost</p>
                    <p class="text-4xl font-black text-white">Rs {{ number_format($total) }}</p>
                </div>
                <div class="flex gap-4">
                    <a href="{{ route('cart.clear') }}" class="px-6 py-4 rounded-xl border border-red-500/20 text-red-400 hover:bg-red-500/10 transition font-bold text-sm">CLEAR CARGO</a>
                    <a href="{{ route('checkout') }}" class="btn-cosmic px-12 py-4 rounded-2xl font-black text-lg tracking-widest">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection