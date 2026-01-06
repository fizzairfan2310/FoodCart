@extends('layouts.admin')

@section('content')
<div class="max-w-lg mx-auto px-4">
    <div class="mb-8">
        <a href="{{ route('admin.categories.index') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-400 hover:text-white transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Return to Fleet
        </a>
    </div>

    <div class="mb-10">
        <h2 class="text-4xl font-black uppercase tracking-tighter text-white">
            Modify <span class="text-purple-500 italic">Sector</span>
        </h2>
        <p class="text-gray-500 text-[10px] uppercase tracking-[0.2em] mt-1">Update category parameters in the cosmic database</p>
    </div>

    <div class="glass-card p-8 border border-white/10 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-10 -top-10 w-32 h-32 bg-purple-600/10 rounded-full blur-3xl group-hover:bg-purple-600/20 transition-all duration-500"></div>

        <form method="POST" action="{{ route('admin.categories.update', $category) }}" class="relative z-10">
            @csrf
            @method('PUT')

            <div class="mb-8">
                <label class="block text-gray-400 font-black uppercase text-[10px] tracking-[0.2em] mb-3 ml-1">
                    Category Designation
                </label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-4 text-white focus:border-purple-500 focus:ring-1 focus:ring-purple-500 outline-none transition-all duration-300 @error('name') border-red-500/50 @enderror"
                       placeholder="Enter sector name...">
                
                @error('name')
                    <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">
                        <i class="fas fa-exclamation-triangle mr-1"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit"
                        class="flex-1 bg-purple-600 hover:bg-purple-700 text-white font-black text-xs uppercase tracking-[0.2em] py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(168,85,247,0.2)] hover:shadow-[0_0_30px_rgba(168,85,247,0.4)]">
                    Sync Changes <i class="fas fa-sync-alt ml-2"></i>
                </button>
                
                <a href="{{ route('admin.categories.index') }}"
                   class="px-6 py-4 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-all border border-white/5 text-xs font-black uppercase tracking-widest">
                    Abort
                </a>
            </div>
        </form>
    </div>

    <div class="mt-8 text-center">
        <p class="text-gray-600 text-[9px] uppercase tracking-[0.3em]">System: Category ID #{{ $category->id }} stable</p>
    </div>
</div>

<style>
    /* Agar layout mein glass-card nahi hai toh ye ensure karega */
    .glass-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border-radius: 24px;
    }
</style>
@endsection