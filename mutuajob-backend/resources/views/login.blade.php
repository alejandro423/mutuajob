@extends('layouts.app')

@section('content')
    <div class="min-h-[calc(100vh-96px)] flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-zinc-950 border border-zinc-800 rounded-3xl p-8 shadow-2xl">
            
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Iniciar Sesión</h1>
                <p class="text-zinc-400 text-sm">Accede a tu cuenta de MutuaJob</p>
            </div>

            @if ($errors->any())
                <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 text-sm rounded-xl p-3">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ url('/login') }}" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Correo electrónico</label>
                    <input 
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="Ingresa tu correo"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Contraseña</label>
                    <input 
                        type="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                </div>

                <button 
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition"
                >
                    Iniciar sesión
                </button>
            </form>

            <div class="mt-6">
    <a href="{{ url('/create') }}" class="block w-full text-center bg-zinc-800 hover:bg-zinc-700 text-white font-medium py-3 rounded-xl transition">
        No tienes usuario, crea una cuenta
    </a>
</div>

        </div>
    </div>
@endsection