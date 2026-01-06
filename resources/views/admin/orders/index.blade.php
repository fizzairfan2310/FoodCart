@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-white">
                Orders <span class="text-yellow-500 italic">Terminal</span>
            </h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.2em] mt-1">Live transaction monitoring & logistics</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.dashboard') }}" class="bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white text-[10px] font-black px-6 py-3 rounded-xl border border-white/5 transition-all uppercase tracking-[0.2em]">
                <i class="fas fa-arrow-left mr-2"></i> Command Center
            </a>
        </div>
    </div>

    <div class="glass-card overflow-hidden border border-white/10 shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Flux ID</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Customer Entity</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Contact</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Credits</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Deployment Status</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Timestamp</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($orders as $order)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-6">
                            <span class="font-mono text-blue-400 font-bold tracking-tighter">#{{ $order->id }}</span>
                        </td>
                        <td class="px-6 py-6">
                            <p class="text-white font-black uppercase tracking-tight">{{ $order->customer_name }}</p>
                            <p class="text-[10px] text-gray-500 italic">{{ $order->customer_email }}</p>
                        </td>
                        <td class="px-6 py-6 text-sm text-gray-400 font-medium">
                            {{ $order->customer_phone }}
                        </td>
                        <td class="px-6 py-6">
                            <span class="text-green-400 font-black">Rs {{ number_format($order->total) }}</span>
                        </td>
                        <td class="px-6 py-6">
                            <form action="{{ route('admin.orders.status', $order->id) }}" method="POST" class="relative group/select">
                                @csrf
                                <select name="status" onchange="this.form.submit()" 
                                    class="bg-white/5 border border-white/10 rounded-lg px-3 py-1.5 text-[10px] font-black uppercase tracking-widest text-white outline-none focus:border-blue-500 cursor-pointer appearance-none pr-8">
                                    <option value="pending" class="bg-slate-900" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="processing" class="bg-slate-900" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                    <option value="delivered" class="bg-slate-900" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                    <option value="cancelled" class="bg-slate-900" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <i class="fas fa-chevron-down absolute right-3 top-1/2 -translate-y-1/2 text-[8px] text-gray-500 pointer-events-none"></i>
                            </form>
                        </td>
                        <td class="px-6 py-6">
                            <span class="text-[10px] text-gray-500 font-bold uppercase">{{ $order->created_at->format('M d, Y') }}</span>
                            <span class="block text-[8px] text-gray-600 italic">{{ $order->created_at->format('H:i') }}</span>
                        </td>
                        <td class="px-6 py-6">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all border border-blue-500/20" title="View Stream">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Purge this record?')" class="p-2 bg-red-500/10 text-red-500 hover:bg-red-600 hover:text-white rounded-lg transition-all border border-red-500/20" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-8 py-20 text-center">
                            <i class="fas fa-satellite text-4xl text-gray-800 mb-4 animate-pulse"></i>
                            <p class="text-gray-500 uppercase tracking-[0.3em] font-black text-xs">No signals received yet</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .glass-card {
        background: rgba(255, 255, 255, 0.02);
        backdrop-filter: blur(20px);
        border-radius: 24px;
    }
    select option { background: #0f172a; color: white; }
    /* Table scroll styling */
    .overflow-x-auto::-webkit-scrollbar { height: 4px; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: rgba(234, 179, 8, 0.2); border-radius: 10px; }
</style>
@endsection