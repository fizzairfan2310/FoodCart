@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto px-4">
    <div class="mb-10 text-center md:text-left">
        <h2 class="text-5xl font-black mb-2 uppercase tracking-tighter text-white">
            Add <span class="text-blue-500">Category</span>
        </h2>
        <p class="text-gray-400 tracking-widest text-sm uppercase">Initialize new food department</p>
    </div>

    <div class="glass-card p-10 border border-white/10 shadow-2xl">
        <h3 class="text-xl font-bold mb-8 text-blue-400 uppercase tracking-widest flex items-center gap-3">
            <i class="fas fa-tags"></i> Category Details
        </h3>

        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-8">
            @csrf

            <div class="space-y-2">
                <label class="block text-[10px] font-black uppercase tracking-[0.2em] text-gray-500 ml-1">
                    Department Name
                </label>
                <div class="relative">
                    <input type="text" name="name" value="{{ old('name') }}" 
                        class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 focus:outline-none focus:border-blue-500 focus:bg-white/10 transition text-white placeholder-gray-600 text-lg"
                        placeholder="e.g. Galaxy Burgers, Nebula Drinks" required>
                    <i class="fas fa-pen-nib absolute right-6 top-1/2 -translate-y-1/2 text-gray-700"></i>
                </div>
                @error('name') 
                    <p class="text-red-500 text-xs italic mt-2 ml-1">{{ $message }}</p> 
                @enderror
            </div>

            <div class="flex flex-col md:flex-row gap-4 pt-6 border-t border-white/5">
                <a href="{{ route('admin.categories.index') }}" 
                   class="flex-1 text-center py-5 rounded-2xl border border-white/10 hover:bg-white/5 font-bold transition tracking-widest text-sm text-gray-400">
                    <i class="fas fa-times mr-2"></i> ABORT
                </a>
                
                <button type="submit" 
                    class="flex-[2] bg-gradient-to-r from-blue-600 to-purple-600 py-5 rounded-2xl font-black text-lg tracking-[0.2em] shadow-xl shadow-blue-500/30 transition-all hover:scale-[1.02] active:scale-[0.98] text-white">
                    SAVE CATEGORY <i class="fas fa-rocket ml-2"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    /* Agar app.blade mein glass-card nahi define to yahan backup de raha hoon */
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
    }
</style>
@endsection