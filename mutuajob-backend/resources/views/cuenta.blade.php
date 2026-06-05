@extends('layouts.app')

@section('content')
<div class="min-h-[calc(100vh-96px)] flex items-center justify-center">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-white mb-4">
            Mi cuenta
        </h1>

        <p class="text-zinc-400">
            Bienvenido, {{ Auth::user()->name }}
        </p>

        <p class="text-zinc-500 mt-2">
            {{ Auth::user()->email }}
        </p>
        <form method="POST" action="{{ url('/logout') }}">
    @csrf

    <button type="submit"
        class="mt-6 bg-red-600 hover:bg-red-700 text-white font-semibold px-6 py-3 rounded-xl transition">
        Cerrar sesión
    </button>
    
</form>
    </div>
</div>
@endsection