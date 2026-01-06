@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 mb-10">
        <div>
            <h2 class="text-4xl font-black uppercase tracking-tighter text-white">
                Inventory <span class="text-blue-500 italic">Manifest</span>
            </h2>
            <p class="text-gray-500 text-[10px] uppercase tracking-[0.2em] mt-1">Total items registered in the cosmic database</p>
        </div>
        <div class="flex gap-4">
            <a href="{{ route('admin.foods.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white text-[10px] font-black px-6 py-3 rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.3)] uppercase tracking-[0.2em] flex items-center gap-2">
                <i class="fas fa-plus"></i> Add New Cargo
            </a>
            <a href="{{ route('admin.dashboard') }}" class="bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white text-[10px] font-black px-6 py-3 rounded-xl border border-white/5 transition-all uppercase tracking-[0.2em]">
                Return to Hub
            </a>
        </div>
    </div>

    <div class="glass-card overflow-hidden border border-white/10 shadow-2xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white/5 border-b border-white/10">
                    <tr>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Visual</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Designation</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 hidden lg:table-cell">Specifications</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-center">Sector</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-center">Credits</th>
                        <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/5">
                    @forelse($foods as $food)
                    <tr class="hover:bg-white/5 transition-colors group">
                        <td class="px-6 py-4">
                            <div class="relative w-16 h-16 rounded-xl overflow-hidden border border-white/10 group-hover:border-blue-500/50 transition-all shadow-lg">
                                <img src="/uploads/{{ $food->image }}" alt="{{ $food->name }}" class="w-full h-full object-cover">
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="text-white font-black uppercase tracking-tight">{{ $food->name }}</span>
                            <span class="block text-[8px] text-blue-500 font-mono">ID: #SYS-{{ $food->id }}</span>
                        </td>
                        <td class="px-6 py-4 hidden lg:table-cell">
                            <p class="text-xs text-gray-400 leading-relaxed max-w-xs italic opacity-70">
                                "{{ Str::limit($food->description, 60) }}"
                            </p>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-[9px] font-black uppercase tracking-widest text-purple-400 bg-purple-400/10 px-3 py-1 rounded-full border border-purple-400/20">
                                {{ $food->category->name ?? 'UNASSIGNED' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="text-white font-black text-sm">Rs {{ number_format($food->price) }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('admin.foods.edit', $food->id) }}" class="p-2 bg-blue-500/10 text-blue-400 hover:bg-blue-500 hover:text-white rounded-lg transition-all border border-blue-500/20" title="Modify">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.foods.destroy', $food->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Initiate permanent removal?')" class="p-2 bg-red-500/10 text-red-500 hover:bg-red-600 hover:text-white rounded-lg transition-all border border-red-500/20" title="Purge">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <i class="fas fa-box-open text-4xl text-gray-800 mb-4 animate-pulse"></i>
                            <p class="text-gray-500 uppercase tracking-[0.3em] font-black text-xs">No cargo detected in hangar</p>
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
        -webkit-backdrop-filter: blur(20px);
        border-radius: 24px;
    }
    /* Smooth Scrollbar for Table */
    .overflow-x-auto::-webkit-scrollbar { height: 4px; }
    .overflow-x-auto::-webkit-scrollbar-thumb { background: rgba(59, 130, 246, 0.2); border-radius: 10px; }
</style>
@endsection