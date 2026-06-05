@extends('layouts.dashboard')
@section('content')
{{-- HEADER --}}
<div class="flex flex-col md:flex-row
            md:items-center md:justify-between
            gap-4 mb-6">
    <div>
        <h1 class="text-3xl font-bold text-white">
            Usuarios inactivos
        </h1>
        <p class="text-zinc-400 text-sm">
            Usuarios deshabilitados del sistema
        </p>
    </div>
    <a href="{{ route('admin.usuarios.index') }}"
       class="bg-zinc-700 hover:bg-zinc-600
              text-white px-5 py-3 rounded-xl
              font-medium transition">
        Volver
    </a>
</div>
{{-- ALERTAS --}}
@if(session('success'))
    <div class="mb-4 bg-green-600/20 border border-green-600
                text-green-400 px-4 py-3 rounded-xl">
        {{ session('success') }}
    </div>
@endif
@if(session('error'))
    <div class="mb-4 bg-red-600/20 border border-red-600
                text-red-400 px-4 py-3 rounded-xl">
        {{ session('error') }}
    </div>
@endif
{{-- TABLA --}}
<div class="bg-zinc-950 border border-zinc-800 rounded-2xl overflow-hidden">
    <table class="w-full text-left">
        {{-- HEAD --}}
        <thead class="bg-zinc-900 border-b border-zinc-800">
            <tr>
                <th class="px-5 py-4 text-sm text-zinc-300">
                    Nombre
                </th>
                <th class="px-5 py-4 text-sm text-zinc-300">
                    Correo
                </th>
                <th class="px-5 py-4 text-sm text-zinc-300">
                    Rol
                </th>
                <th class="px-5 py-4 text-sm text-zinc-300 text-center">
                    Estado
                </th>
                <th class="px-5 py-4 text-sm text-zinc-300 text-center">
                    Acción
                </th>
            </tr>
        </thead>
        {{-- BODY --}}
        <tbody>
            @forelse($users as $user)
                <tr class="border-b border-zinc-800
                           bg-zinc-900/40 text-zinc-500">
                    {{-- NOMBRE --}}
                    <td class="px-5 py-4">
                        {{ $user->name }}
                    </td>
                    {{-- EMAIL --}}
                    <td class="px-5 py-4">
                        {{ $user->email }}
                    </td>
                    {{-- ROLES --}}
                    <td class="px-5 py-4">
                        <div class="flex flex-wrap gap-2">
                            @forelse($user->roles as $role)
                                <span class="bg-zinc-800 text-zinc-400
                                             text-xs px-3 py-1 rounded-full">
                                    {{ ucfirst($role->nombre) }}
                                </span>
                            @empty
                                <span class="text-zinc-600 text-sm">
                                    Sin rol
                                </span>
                            @endforelse
                        </div>
                    </td>
                    {{-- ESTADO --}}
                    <td class="px-5 py-4 text-center">
                        <span class="bg-red-600/20 text-red-400
                                     px-3 py-1 rounded-full text-xs">
                            Inactivo
                        </span>
                    </td>
                    {{-- HABILITAR --}}
                    <td class="px-5 py-4">
                        <div class="flex justify-center">
                            <form action="{{ route('admin.usuarios.habilitar', $user->id) }}"
                                  method="POST">
                                @csrf
                                @method('PUT')
                                <button type="submit"
                                        class="bg-green-600 hover:bg-green-700
                                               text-white px-4 py-2
                                               rounded-lg text-sm transition">
                                    Habilitar
                                </button>
                            </form>
                            {{-- Eliminar definitivamente --}}
                            <form action="{{ route('admin.usuarios.forceDelete', $user->id) }}"
      method="POST"
      onsubmit="return confirm(
        '¿Seguro que quieres eliminar definitivamente a este usuario?\n\n' +
        'Esta acción eliminará todos los datos relacionados y NO se puede deshacer.'
      )">

    @csrf
    @method('DELETE')

    <button type="submit"
            class="bg-red-700 hover:bg-red-800
                   text-white px-4 py-2
                   rounded-lg text-sm transition">

        Eliminar definitivamente

    </button>

</form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5"
                        class="px-5 py-6 text-center text-zinc-500">
                        No hay usuarios inactivos.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
{{-- PAGINACION --}}
<div class="mt-4">
    {{ $users->links() }}
</div>
@endsection