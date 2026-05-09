@extends('layouts.dashboard')

@section('content')
<div class="max-w-2xl">
    <h1 class="text-3xl font-bold text-white mb-2">Nuevo usuario</h1>
    <p class="text-zinc-400 mb-6">Crear un nuevo usuario en el sistema</p>

    <form action="{{ route('admin.usuarios.store') }}" method="POST"
          class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6 space-y-5">
        @csrf

        <div>
            <label class="block text-sm text-zinc-300 mb-2">Nombre</label>
            <input type="text" name="name" value="{{ old('name') }}"
                   class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600">
        </div>

        <div>
            <label class="block text-sm text-zinc-300 mb-2">Correo</label>
            <input type="email" name="email" value="{{ old('email') }}"
                   class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600">
        </div>

        <div>
            <label class="block text-sm text-zinc-300 mb-2">Contraseña</label>
            <input type="password" name="password"
                   class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600">
        </div>

        <div>
            <label class="block text-sm text-zinc-300 mb-3">Roles</label>

            <div class="space-y-3">
                @foreach($roles as $role)
                    <label class="flex items-center gap-3 bg-zinc-900 border border-zinc-800 px-4 py-3 rounded-xl cursor-pointer hover:border-red-600 transition">
                        <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                               class="w-4 h-4 accent-red-600"
                               {{ in_array($role->id, old('roles', [])) ? 'checked' : '' }}>
                        <span class="text-white">{{ ucfirst($role->nombre) }}</span>
                    </label>
                @endforeach
            </div>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('admin.usuarios.index') }}"
               class="bg-zinc-800 hover:bg-zinc-700 px-5 py-3 rounded-xl transition">
                Cancelar
            </a>

            <button type="submit"
                    class="bg-red-600 hover:bg-red-700 px-5 py-3 rounded-xl transition">
                Guardar
            </button>
        </div>
    </form>
</div>
@endsection