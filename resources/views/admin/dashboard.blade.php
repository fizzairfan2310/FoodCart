@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="mb-10 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h2 class="text-5xl font-black mb-2 uppercase tracking-tighter text-white">
                Admin <span class="text-blue-500 italic">Command</span> Center
            </h2>
            <p class="text-gray-400 tracking-[0.2em] text-xs uppercase opacity-70">Real-time system telemetry & order management</p>
        </div>
        <div class="flex items-center gap-3">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
            </span>
            <span class="text-green-500 font-black text-xs uppercase tracking-widest">System Online</span>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
        <div class="glass-card p-6 relative overflow-hidden group border border-white/10">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-600/10 rounded-full blur-2xl group-hover:bg-blue-600/20 transition-all duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Total Orders</p>
                    <p class="text-4xl font-black text-white leading-none">{{ $totalOrders }}</p>
                </div>
                <div class="w-14 h-14 bg-blue-500/10 rounded-2xl flex items-center justify-center text-blue-500 border border-blue-500/20 shadow-[0_0_15px_rgba(59,130,246,0.2)]">
                    <i class="fas fa-shopping-cart text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="glass-card p-6 relative overflow-hidden group border border-white/10">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-yellow-600/10 rounded-full blur-2xl group-hover:bg-yellow-600/20 transition-all duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Pending Payload</p>
                    <p class="text-4xl font-black text-white leading-none">{{ $pendingOrders }}</p>
                </div>
                <div class="w-14 h-14 bg-yellow-500/10 rounded-2xl flex items-center justify-center text-yellow-500 border border-yellow-500/20 shadow-[0_0_15px_rgba(234,179,8,0.2)]">
                    <i class="fas fa-bolt text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="glass-card p-6 relative overflow-hidden group border border-white/10">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-green-600/10 rounded-full blur-2xl group-hover:bg-green-600/20 transition-all duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Cargo Items</p>
                    <p class="text-4xl font-black text-white leading-none">{{ $totalFoods }}</p>
                </div>
                <div class="w-14 h-14 bg-green-500/10 rounded-2xl flex items-center justify-center text-green-500 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.2)]">
                    <i class="fas fa-hamburger text-2xl"></i>
                </div>
            </div>
        </div>

        <div class="glass-card p-6 relative overflow-hidden group border border-white/10">
            <div class="absolute -right-6 -top-6 w-24 h-24 bg-purple-600/10 rounded-full blur-2xl group-hover:bg-purple-600/20 transition-all duration-500"></div>
            <div class="relative z-10 flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-[10px] font-black uppercase tracking-[0.2em] mb-1">Departments</p>
                    <p class="text-4xl font-black text-white leading-none">{{ $totalCategories }}</p>
                </div>
                <div class="w-14 h-14 bg-purple-500/10 rounded-2xl flex items-center justify-center text-purple-500 border border-purple-500/20 shadow-[0_0_15px_rgba(168,85,247,0.2)]">
                    <i class="fas fa-th-large text-2xl"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-12">
        <h3 class="text-sm font-black text-blue-400 uppercase tracking-[0.4em] mb-6 ml-1">Quick Access Protocols</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.categories.index') }}" class="glass-card p-6 flex flex-col items-center group hover:bg-white/5 transition border border-white/5">
                <i class="fas fa-folder-open text-3xl mb-3 text-purple-400 group-hover:scale-110 transition duration-300"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-white">Categories</span>
            </a>
            <a href="{{ route('admin.foods.create') }}" class="glass-card p-6 flex flex-col items-center group hover:bg-white/5 transition border border-white/5">
                <i class="fas fa-plus-square text-3xl mb-3 text-blue-400 group-hover:scale-110 transition duration-300"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-white">Add Food</span>
            </a>
            <a href="{{ route('admin.foods.index') }}" class="glass-card p-6 flex flex-col items-center group hover:bg-white/5 transition border border-white/5">
                <i class="fas fa-database text-3xl mb-3 text-green-400 group-hover:scale-110 transition duration-300"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-white">Inventory</span>
            </a>
            <a href="{{ route('admin.orders') }}" class="glass-card p-6 flex flex-col items-center group hover:bg-white/5 transition border border-white/5">
                <i class="fas fa-stream text-3xl mb-3 text-yellow-400 group-hover:scale-110 transition duration-300"></i>
                <span class="text-[10px] font-black uppercase tracking-widest text-white">All Orders</span>
            </a>
        </div>
    </div>

    <div class="mb-8 flex items-center justify-between ml-1">
        <h3 class="text-sm font-black text-blue-400 uppercase tracking-[0.4em]">Recent Flux Transactions</h3>
    </div>
    
    <div class="glass-card overflow-hidden border border-white/10 shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">ID</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Client Entity</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Credits</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Status</th>
                        <th class="px-8 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-right">Protocol</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($recentOrders as $order)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-8 py-6 font-mono text-sm text-blue-400 font-bold">#{{ $order->id }}</td>
                        <td class="px-8 py-6">
                            <p class="font-bold text-white uppercase tracking-tight">{{ $order->customer_name }}</p>
                            <p class="text-[10px] text-gray-500 font-medium">{{ $order->created_at->format('M d, Y') }}</p>
                        </td>
                        <td class="px-8 py-6">
                            <span class="text-white font-black">Rs {{ number_format($order->total) }}</span>
                        </td>
                        <td class="px-8 py-6 text-sm">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest border
                                {{ $order->status === 'pending' ? 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20 shadow-[0_0_10px_rgba(234,179,8,0.1)]' : 
                                   ($order->status === 'processing' ? 'bg-blue-500/10 text-blue-500 border-blue-500/20 shadow-[0_0_10px_rgba(59,130,246,0.1)]' : 
                                   ($order->status === 'delivered' ? 'bg-green-500/10 text-green-500 border-green-500/20 shadow-[0_0_10px_rgba(34,197,94,0.1)]' : 
                                   'bg-red-500/10 text-red-500 border-red-500/20')) }}">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <a href="{{ route('admin.orders.show', $order->id) }}" class="inline-flex items-center gap-2 text-[10px] font-black uppercase tracking-[0.2em] text-blue-400 hover:text-white transition-all transform hover:translate-x-1">
                                VIEW DATA <i class="fas fa-chevron-right text-[8px]"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-8 py-20 text-center">
                            <i class="fas fa-satellite-dish text-4xl text-gray-700 mb-4 animate-pulse"></i>
                            <p class="text-gray-500 uppercase tracking-[0.3em] font-black text-xs">No active signals detected</p>
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
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 20px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .glass-card:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }
    /* Simple custom scrollbar for the table */
    .overflow-x-auto::-webkit-scrollbar { height: 4px; }
    .overflow-x-auto::-webkit-scrollbar-track { background: rgba(255,255,255,0.05); }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.3); border-radius: 10px; }
</style>
@endsection