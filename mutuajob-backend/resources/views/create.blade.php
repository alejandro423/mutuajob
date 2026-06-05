@extends('layouts.app')

@section('content')
    <div class="min-h-[calc(100vh-96px)] flex items-center justify-center px-6">
        <div class="w-full max-w-md bg-zinc-950 border border-zinc-800 rounded-3xl p-8 shadow-2xl">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Crear cuenta</h1>
                <p class="text-zinc-400 text-sm">Regístrate en MutuaJob</p>
            </div>

            <form method="POST" action="{{ url('/register') }}" class="space-y-5">
               @if ($errors->any())
    <div class="mb-4 bg-red-500/10 border border-red-500 text-red-400 text-sm rounded-xl p-4">
        <ul class="space-y-1">
            @foreach ($errors->all() as $error)
                <li>• {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                @csrf

                <!-- Nombre -->
                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Nombre</label>
                    <input 
                        type="text"
                        name="name"
                        placeholder="Ingresa tu nombre"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Correo electrónico</label>
                    <input 
                        type="email"
                        name="email"
                        placeholder="Ingresa tu correo"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                </div>

                <!-- Contraseña -->
                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Contraseña</label>
                    <input 
                        type="password"
                        name="password"
                        placeholder="Ingresa tu contraseña"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                </div>

                <!-- Repetir contraseña -->
                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Repetir contraseña</label>
                    <input 
                        type="password"
                        name="password_confirmation"
                        placeholder="Repite tu contraseña"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                </div>

                <!-- Rol -->
                <div>
                    <label class="block text-sm text-zinc-300 mb-2">Selecciona tu rol</label>
                    <select 
                        name="role"
                        class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600"
                    >
                        <option value="trabajador">Trabajador</option>
                        <option value="empleador">Empleador</option>
                    </select>
                </div>

                <!-- Botón -->
                <button 
                    type="submit"
                    class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition"
                >
                    Crear cuenta
                </button>
            </form>

            <div class="mt-6">
                <a href="{{ url('/login') }}" class="block w-full text-center bg-zinc-800 hover:bg-zinc-700 text-white font-medium py-3 rounded-xl transition">
                    Ya tengo cuenta
                </a>
            </div>

        </div>
    </div>
@endsection