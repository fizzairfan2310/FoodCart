@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto px-4">
    <div class="flex flex-col md:flex-row justify-between items-center mb-10 gap-6">
        <div class="text-center md:text-left">
            <h2 class="text-5xl font-black mb-2 uppercase tracking-tighter text-white">
                Food <span class="text-blue-500">Categories</span>
            </h2>
            <p class="text-gray-400 tracking-widest text-sm uppercase">Manage your cosmic departments</p>
        </div>
        
        <a href="{{ route('admin.categories.create') }}" 
           class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-4 rounded-2xl font-black flex items-center gap-3 transition-all shadow-lg shadow-blue-500/20 hover:scale-105 active:scale-95">
            <i class="fas fa-plus-circle text-xl"></i> 
            <span class="tracking-widest">NEW CATEGORY</span>
        </a>
    </div>

    @if (session('success'))
        <div class="glass-card border-l-4 border-green-500 p-4 mb-8 bg-green-500/10 backdrop-blur-md">
            <div class="flex items-center gap-3">
                <i class="fas fa-check-circle text-green-500"></i>
                <p class="text-green-200 font-medium">{{ session('success') }}</p>
            </div>
        </div>
    @endif

    <div class="glass-card overflow-hidden border border-white/10 shadow-2xl">
        <table class="w-full text-left">
            <thead class="bg-white/5 border-b border-white/10">
                <tr>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500">Department Name</th>
                    <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-white/5">
                @forelse($categories as $category)
                <tr class="hover:bg-white/5 transition group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-2 rounded-full bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.8)]"></div>
                            <span class="text-lg font-bold text-white group-hover:text-blue-400 transition">
                                {{ $category->name }}
                            </span>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex justify-end gap-3">
                            <a href="{{ route('admin.categories.edit', $category) }}" 
                               class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-blue-500/20 rounded-xl transition-all text-blue-400 border border-white/10 hover:border-blue-500/50"
                               title="Edit Category">
                                <i class="fas fa-edit text-sm"></i>
                            </a>

                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                  class="inline" onsubmit="return confirm('Are you sure you want to delete this category?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="w-11 h-11 flex items-center justify-center bg-white/5 hover:bg-red-500/20 rounded-xl transition-all text-red-400 border border-white/10 hover:border-red-500/50"
                                        title="Delete Category">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="2" class="px-8 py-24 text-center">
                        <div class="flex flex-col items-center opacity-20">
                            <i class="fas fa-folder-open text-6xl mb-4 text-gray-500"></i>
                            <p class="text-xl font-bold uppercase tracking-widest text-gray-500">No categories found</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
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