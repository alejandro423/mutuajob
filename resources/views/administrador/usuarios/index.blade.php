@extends('layouts.dashboard')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-white">Usuarios</h1>
        <p class="text-zinc-400 text-sm">Gestión de usuarios registrados</p>
    </div>

    <a href="{{ route('admin.usuarios.create') }}"
       class="bg-red-600 hover:bg-red-700 text-white px-5 py-3 rounded-xl font-medium transition">
        Nuevo usuario
    </a>
</div>

@if(session('success'))
    <div class="mb-4 bg-green-600/20 border border-green-600 text-green-400 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
@endif

<div class="bg-zinc-950 border border-zinc-800 rounded-2xl overflow-hidden">
    <table class="w-full text-left">
        <thead class="bg-zinc-900 border-b border-zinc-800">
            <tr>
                <th class="px-5 py-4 text-sm text-zinc-300">Nombre</th>
                <th class="px-5 py-4 text-sm text-zinc-300">Correo</th>
                <th class="px-5 py-4 text-sm text-zinc-300">Rol</th>
                <th class="px-5 py-4 text-sm text-zinc-300 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse($users as $user)
                <tr class="border-b border-zinc-800 hover:bg-zinc-900/40">
                    <td class="px-5 py-4">{{ $user->name }}</td>
                    <td class="px-5 py-4">{{ $user->email }}</td>
                    <td class="px-5 py-4">
                        <div class="flex flex-wrap gap-2">
                            @forelse($user->roles as $role)
                                <span class="bg-zinc-800 text-zinc-300 text-xs px-3 py-1 rounded-full">
                                    {{ ucfirst($role->nombre) }}
                                </span>
                            @empty
                                <span class="text-zinc-500 text-sm">Sin rol</span>
                            @endforelse
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.usuarios.show', $user->id) }}"
                               class="bg-blue-600 hover:bg-blue-700 px-3 py-2 rounded-lg text-sm transition">
                                Ver
                            </a>

                            <a href="{{ route('admin.usuarios.edit', $user->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600 px-3 py-2 rounded-lg text-sm text-black font-medium transition">
                                Editar
                            </a>

                            <form action="{{ route('admin.usuarios.destroy', $user->id) }}" method="POST"
                                  onsubmit="return confirm('¿Eliminar este usuario?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    class="bg-red-600 hover:bg-red-700 px-3 py-2 rounded-lg text-sm transition">
                                    Eliminar
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="px-5 py-6 text-center text-zinc-500">
                        No hay usuarios registrados.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<div class="mt-4">
    {{ $users->links() }}
@endsection