@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto px-4">
    <div class="mb-8 flex justify-between items-center">
        <a href="{{ route('admin.orders') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-400 hover:text-white transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Back to Terminal
        </a>
        <div class="flex items-center gap-3">
             <span class="text-[10px] text-gray-500 uppercase font-black tracking-widest">Signal Status:</span>
             @if($order->status === 'pending')
                <span class="px-3 py-1 rounded-full bg-yellow-500/10 text-yellow-500 border border-yellow-500/20 text-[10px] font-black uppercase tracking-widest animate-pulse">Pending</span>
            @elseif($order->status === 'processing')
                <span class="px-3 py-1 rounded-full bg-blue-500/10 text-blue-500 border border-blue-500/20 text-[10px] font-black uppercase tracking-widest">Processing</span>
            @elseif($order->status === 'delivered')
                <span class="px-3 py-1 rounded-full bg-green-500/10 text-green-500 border border-green-500/20 text-[10px] font-black uppercase tracking-widest">Delivered</span>
            @else
                <span class="px-3 py-1 rounded-full bg-red-500/10 text-red-500 border border-red-500/20 text-[10px] font-black uppercase tracking-widest">Cancelled</span>
            @endif
        </div>
    </div>

    <div class="mb-10">
        <h2 class="text-4xl font-black uppercase tracking-tighter text-white">
            Order <span class="text-blue-500 italic">#{{ $order->id }}</span>
        </h2>
        <p class="text-gray-500 text-[10px] uppercase tracking-[0.2em] mt-1">Logged on {{ $order->created_at->format('M d, Y | H:i A') }}</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="md:col-span-2 glass-card p-8 border border-white/10 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <i class="fas fa-user-astronaut text-6xl text-white"></i>
            </div>
            <h3 class="text-blue-500 text-[10px] font-black uppercase tracking-[0.3em] mb-6 flex items-center gap-2">
                <i class="fas fa-id-card"></i> Customer Entity
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-y-6">
                <div>
                    <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest">Full Name</p>
                    <p class="text-white font-bold">{{ $order->customer_name }}</p>
                </div>
                <div>
                    <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest">Contact Signal</p>
                    <p class="text-white font-bold">{{ $order->customer_phone }}</p>
                </div>
                <div>
                    <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest">Email Address</p>
                    <p class="text-white font-bold">{{ $order->customer_email }}</p>
                </div>
                <div>
                    <p class="text-[9px] text-gray-500 uppercase font-black tracking-widest">Deployment Zone</p>
                    <p class="text-white font-bold text-sm">{{ $order->customer_address }}</p>
                </div>
            </div>
        </div>

        <div class="glass-card p-8 border border-white/10 bg-blue-500/5 shadow-[inset_0_0_20px_rgba(59,130,246,0.1)]">
            <h3 class="text-yellow-500 text-[10px] font-black uppercase tracking-[0.3em] mb-6">
                <i class="fas fa-file-invoice"></i> Billing Summary
            </h3>
            <div class="space-y-4">
                <div class="flex justify-between items-center border-b border-white/5 pb-2">
                    <span class="text-[10px] text-gray-500 uppercase font-black">Cargo Size</span>
                    <span class="text-white font-bold">{{ $order->items->count() }} Units</span>
                </div>
                <div class="flex justify-between items-center border-b border-white/5 pb-2">
                    <span class="text-[10px] text-gray-500 uppercase font-black">Subtotal</span>
                    <span class="text-white font-bold">Rs {{ number_format($order->total, 2) }}</span>
                </div>
                <div class="pt-4">
                    <p class="text-[9px] text-gray-500 uppercase font-black tracking-[0.2em] mb-1">Total Payload</p>
                    <p class="text-3xl font-black text-green-400">Rs {{ number_format($order->total, 2) }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="glass-card overflow-hidden border border-white/10 mb-8">
        <div class="bg-white/5 px-8 py-4 border-b border-white/10">
            <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-gray-400">Inventory Items Manifest</h3>
        </div>
        <table class="w-full text-left">
            <thead>
                <tr class="text-[9px] font-black uppercase tracking-widest text-gray-500">
                    <th class="px-8 py-4">Item Designation</th>
                    <th class="px-8 py-4 text-center">Qty</th>
                    <th class="px-8 py-4 text-right">Unit Price</th>
                    <th class="px-8 py-4 text-right">Total Credits</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @foreach($order->items as $item)
                <tr class="text-white hover:bg-white/5 transition">
                    <td class="px-8 py-4">
                        <span class="font-black uppercase tracking-tight">{{ $item->food->name }}</span>
                    </td>
                    <td class="px-8 py-4 text-center font-mono">{{ $item->quantity }}</td>
                    <td class="px-8 py-4 text-right text-gray-400">Rs {{ number_format($item->price, 2) }}</td>
                    <td class="px-8 py-4 text-right font-black text-blue-400">Rs {{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="glass-card p-6 border border-white/10 bg-white/5">
        <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="flex flex-col md:flex-row items-center gap-6">
            @csrf
            <div class="flex items-center gap-3">
                <i class="fas fa-terminal text-blue-500"></i>
                <label class="text-[10px] font-black uppercase tracking-widest text-gray-400">Update Command Status</label>
            </div>
            <div class="flex-1 flex gap-3 w-full">
                <select name="status" class="flex-1 bg-slate-900 border border-white/10 rounded-xl px-4 py-3 text-white text-xs font-black uppercase tracking-widest outline-none focus:border-blue-500 appearance-none">
                    <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                    <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                </select>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition shadow-[0_0_15px_rgba(59,130,246,0.3)]">
                    Execute <i class="fas fa-check-double ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 24px;
    }
</style>
@endsection