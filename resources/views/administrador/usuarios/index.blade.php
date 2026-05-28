@extends('layouts.dashboard')

@section('content')

{{-- HEADER --}}
<div class="flex flex-col md:flex-row
            md:items-center md:justify-between
            gap-4 mb-6">

    <div>

        <h1 class="text-3xl font-bold text-white">
            Usuarios
        </h1>

        <p class="text-zinc-400 text-sm">
            Gestión de usuarios registrados
        </p>

    </div>
    
    <div class="flex gap-3">

        {{-- PDF --}}
        <a href="{{ route('admin.usuarios.pdf') }}"
   class="bg-blue-600 hover:bg-blue-700
          text-white px-5 py-3 rounded-xl
          font-medium transition">

    Descargar PDF

</a>

        {{-- NUEVO --}}
        <a href="{{ route('admin.usuarios.create') }}"
           class="bg-red-600 hover:bg-red-700
                  text-white px-5 py-3 rounded-xl
                  font-medium transition">

            Nuevo usuario

        </a>
<a href="{{ route('admin.usuarios.inactivos') }}"
           class="bg-yellow-600 hover:bg-yellow-700
                  text-white px-5 py-3 rounded-xl
                  font-medium transition">

            Usuarios inactivos

        </a>
    </div>

</div>

{{-- BUSCADOR --}}
<form method="GET"
      action="{{ route('admin.usuarios.index') }}"
      class="mb-6">

    <div class="flex gap-3">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar por nombre o correo..."
               class="w-full bg-zinc-900 border border-zinc-700
                      rounded-xl px-4 py-3 text-white
                      focus:outline-none focus:border-red-500">

        <button type="submit"
                class="bg-zinc-800 hover:bg-zinc-700
                       px-5 py-3 rounded-xl transition">

            Buscar

        </button>

    </div>

</form>

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
                    Acciones
                </th>

            </tr>

        </thead>

        {{-- BODY --}}
        <tbody>

            @forelse($users as $user)

                <tr class="border-b border-zinc-800 hover:bg-zinc-900/40">

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

                                <span class="bg-zinc-800 text-zinc-300
                                             text-xs px-3 py-1 rounded-full">

                                    {{ ucfirst($role->nombre) }}

                                </span>

                            @empty

                                <span class="text-zinc-500 text-sm">
                                    Sin rol
                                </span>

                            @endforelse

                        </div>

                    </td>

                    {{-- ACCIONES --}}
                    <td class="px-5 py-4">

                        <div class="flex items-center justify-center gap-2">

                            {{-- VER --}}
                            <a href="{{ route('admin.usuarios.show', $user->id) }}"
                               class="bg-blue-600 hover:bg-blue-700
                                      px-3 py-2 rounded-lg text-sm transition">

                                Ver

                            </a>

                            {{-- EDITAR --}}
                            <a href="{{ route('admin.usuarios.edit', $user->id) }}"
                               class="bg-yellow-500 hover:bg-yellow-600
                                      px-3 py-2 rounded-lg text-sm
                                      text-black font-medium transition">

                                Editar

                            </a>

                            {{-- ELIMINAR --}}
                            <form action="{{ route('admin.usuarios.destroy', $user->id) }}"
                                  method="POST"
                                  class="form-eliminar">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="bg-red-600 hover:bg-red-700
                                               px-3 py-2 rounded-lg
                                               text-sm transition">

                                    Eliminar

                                </button>

                            </form>

                        </div>

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4"
                        class="px-5 py-6 text-center text-zinc-500">

                        No hay usuarios registrados.

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

{{-- SWEET ALERT --}}
<script>

    document.querySelectorAll('.form-eliminar').forEach(form => {

        form.addEventListener('submit', function(e) {

            e.preventDefault();

            Swal.fire({

                title: '¿Eliminar usuario?',
                text: 'Esta acción no se puede deshacer.',
                icon: 'warning',
                background: '#18181b',
                color: '#fff',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#3f3f46',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar'

            }).then((result) => {

                if (result.isConfirmed) {

                    form.submit();

                }

            });

        });

    });

</script>

@endsection