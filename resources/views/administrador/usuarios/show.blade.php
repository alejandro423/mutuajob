@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-white mb-2">Detalle de usuario</h1>
    <p class="text-zinc-400 mb-6">Información completa del usuario</p>

    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 space-y-5">

        <div>
            <label class="block text-sm text-zinc-500 mb-1">ID</label>
            <p class="text-white">{{ $user->id }}</p>
        </div>

        <div>
            <label class="block text-sm text-zinc-500 mb-1">Nombre</label>
            <p class="text-white">{{ $user->name }}</p>
        </div>

        <div>
            <label class="block text-sm text-zinc-500 mb-1">Correo</label>
            <p class="text-white">{{ $user->email }}</p>
        </div>

        <div>
            <label class="block text-sm text-zinc-500 mb-1">Email verificado</label>
            <p class="text-white">
                {{ $user->email_verified_at ? $user->email_verified_at->format('d/m/Y H:i') : 'No verificado' }}
            </p>
        </div>

        <div>
            <label class="block text-sm text-zinc-500 mb-1">Creado</label>
            <p class="text-white">{{ $user->created_at->format('d/m/Y H:i') }}</p>
        </div>

        <div>
            <label class="block text-sm text-zinc-500 mb-1">Actualizado</label>
            <p class="text-white">{{ $user->updated_at->format('d/m/Y H:i') }}</p>
        </div>

        <div class="flex gap-3 pt-4">
            <a href="{{ route('admin.usuarios.index') }}"
               class="bg-zinc-800 hover:bg-zinc-700 px-5 py-3 rounded-xl transition">
                Volver
            </a>

            <a href="{{ route('admin.usuarios.edit', $user->id) }}"
               class="bg-yellow-500 hover:bg-yellow-600 text-black font-medium px-5 py-3 rounded-xl transition">
                Editar
            </a>
        </div>
    </div>
</div>
@endsection