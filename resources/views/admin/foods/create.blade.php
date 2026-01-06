@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="mb-8">
        <a href="{{ route('admin.foods.index') }}" class="text-[10px] font-black uppercase tracking-[0.3em] text-blue-400 hover:text-white transition flex items-center gap-2">
            <i class="fas fa-arrow-left"></i> Return to Inventory
        </a>
    </div>

    <div class="mb-10">
        <h2 class="text-4xl font-black uppercase tracking-tighter text-white">
            Deploy <span class="text-blue-500 italic">New Cargo</span>
        </h2>
        <p class="text-gray-500 text-[10px] uppercase tracking-[0.2em] mt-1">Register new food items into the cosmic supply chain</p>
    </div>

    <div class="glass-card p-8 border border-white/10 shadow-2xl relative overflow-hidden group">
        <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-600/10 rounded-full blur-3xl group-hover:bg-blue-600/20 transition-all duration-500"></div>

        <form method="POST" action="{{ route('admin.foods.store') }}" enctype="multipart/form-data" class="relative z-10">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="mb-2">
                    <label class="block text-gray-400 font-black uppercase text-[10px] tracking-[0.2em] mb-3 ml-1">Item Designation</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-all @error('name') border-red-500/50 @enderror"
                           placeholder="e.g. Galactic Burger">
                    @error('name') <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-2">
                    <label class="block text-gray-400 font-black uppercase text-[10px] tracking-[0.2em] mb-3 ml-1">Credits (Rs.)</label>
                    <input type="number" name="price" step="0.01" value="{{ old('price') }}"
                           class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-all @error('price') border-red-500/50 @enderror"
                           placeholder="0.00">
                    @error('price') <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="mt-6 mb-6">
                <label class="block text-gray-400 font-black uppercase text-[10px] tracking-[0.2em] mb-3 ml-1">Item Specifications</label>
                <textarea name="description" rows="3"
                          class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-all @error('description') border-red-500/50 @enderror"
                          placeholder="Describe the item flavor profile...">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label class="block text-gray-400 font-black uppercase text-[10px] tracking-[0.2em] mb-3 ml-1">Fleet Sector</label>
                    <select name="category_id"
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white focus:border-blue-500 outline-none transition-all appearance-none @error('category_id') border-red-500/50 @enderror">
                        <option value="" class="bg-slate-900">-- Select Sector --</option>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" class="bg-slate-900" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id') <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-gray-400 font-black uppercase text-[10px] tracking-[0.2em] mb-3 ml-1">Visual Archive</label>
                    <div class="relative group/file">
                        <input type="file" name="image" accept="image/*"
                               class="w-full text-xs text-gray-400 file:mr-4 file:py-3 file:px-4 file:rounded-xl file:border-0 file:text-[10px] file:font-black file:uppercase file:tracking-widest file:bg-blue-600 file:text-white hover:file:bg-blue-700 cursor-pointer bg-white/5 rounded-xl border border-white/10">
                    </div>
                    @error('image') <p class="text-red-500 text-[10px] font-bold uppercase tracking-widest mt-2 ml-1">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex items-center gap-4 border-t border-white/5 pt-8">
                <button type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-black text-xs uppercase tracking-[0.2em] py-4 rounded-xl transition-all shadow-[0_0_20px_rgba(59,130,246,0.2)] hover:shadow-[0_0_30px_rgba(59,130,246,0.4)]">
                    Confirm Deployment <i class="fas fa-rocket ml-2"></i>
                </button>
                <a href="{{ route('admin.foods.index') }}"
                   class="px-8 py-4 bg-white/5 hover:bg-white/10 text-gray-400 hover:text-white rounded-xl transition-all border border-white/5 text-xs font-black uppercase tracking-widest">
                    Abort
                </a>
            </div>
        </form>
    </div>
</div>

<style>
    /* Styling select options for dark/glass theme */
    select option {
        background: #0f172a;
        color: white;
    }
</style>
@endsection