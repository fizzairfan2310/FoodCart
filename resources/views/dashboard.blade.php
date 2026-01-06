@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="glass-card overflow-hidden shadow-sm p-6">
            <h2 class="text-2xl font-black uppercase italic tracking-tighter mb-4 text-blue-500">
                User <span class="text-white">Dashboard</span>
            </h2>
            <div class="text-gray-300">
                Welcome back, {{ session('user_name') }}! You're logged into the cosmic station.
            </div>
        </div>
    </div>
</div>
@endsection