@extends('layouts.dashboard')

@section('content')

<div class="min-h-screen text-white">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row
                md:items-center md:justify-between
                gap-4 mb-8">

        <div>

            <h1 class="text-3xl font-bold">
                Perfiles de usuarios
            </h1>

            <p class="text-zinc-400 mt-2">
                Lista de perfiles registrados en MutuaJob
            </p>

        </div>

    </div>
{{-- BUSCADOR --}}
<form method="GET"
      action="{{ route('administrador.perfiles_user.index') }}"
      class="mb-6">

    <div class="flex gap-3">

        <input type="text"
               name="buscar"
               value="{{ request('buscar') }}"
               placeholder="Buscar por nombre..."
               class="w-full bg-zinc-900 border border-zinc-700
                      rounded-xl px-4 py-3 text-white
                      focus:outline-none focus:border-blue-500">

        <button type="submit"
                class="bg-blue-600 hover:bg-blue-700
                       px-5 py-3 rounded-xl transition font-medium">

            Buscar

        </button>

    </div>

</form>
    {{-- TABLA --}}
    <div class="bg-zinc-900 border border-zinc-800
                rounded-2xl overflow-hidden shadow-xl">

        <table class="w-full text-left">

            {{-- HEAD --}}
            <thead class="bg-zinc-950 border-b border-zinc-800">

                <tr>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Nombre
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Email
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Teléfono
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Ubicación
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm text-center">
                        Acciones
                    </th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody>

                @forelse($perfiles as $perfil)

                    <tr class="border-b border-zinc-800 hover:bg-zinc-800/40 transition">

                        {{-- NOMBRE --}}
                        <td class="px-6 py-5">

                            <div class="flex items-center gap-3">

                                <div class="w-11 h-11 rounded-full
                                            bg-zinc-700 flex items-center
                                            justify-center font-bold">

                                    {{ strtoupper(substr($perfil->nombre ?? 'U', 0, 1)) }}

                                </div>

                                <div>

                                    <p class="font-semibold">
                                        {{ $perfil->nombre }}
                                        {{ $perfil->apellido }}
                                    </p>

                                </div>

                            </div>

                        </td>

                        {{-- EMAIL --}}
                        <td class="px-6 py-5 text-zinc-300">

                            {{ $perfil->email }}

                        </td>

                        {{-- TELEFONO --}}
                        <td class="px-6 py-5 text-zinc-300">

                            {{ $perfil->telefono ?? 'No registrado' }}

                        </td>

                        {{-- UBICACION --}}
                        <td class="px-6 py-5 text-zinc-300">

                            {{ $perfil->ubicacion ?? 'No registrada' }}

                        </td>

                        {{-- ACCIONES --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-3">

                                {{-- VER --}}
                                <a href="{{ route('administrador.perfiles_user.show', $perfil->id) }}"
                                   class="px-4 py-2 bg-blue-600
                                          hover:bg-blue-700 rounded-lg
                                          text-sm font-medium transition">

                                    Ver

                                </a>

                                {{-- EDITAR --}}
                                <a href="{{ route('administrador.perfiles_user.edit', $perfil->id) }}"
                                   class="px-4 py-2 bg-yellow-500
                                          hover:bg-yellow-600 rounded-lg
                                          text-black text-sm font-medium transition">

                                    Editar

                                </a>

                                {{-- BLOQUEAR / DESBLOQUEAR --}}
@if(!$perfil->bloqueado)
    <form action="{{ route('administrador.perfiles_user.bloquear', $perfil->id) }}"
          method="POST"
          onsubmit="return confirm('¿Bloquear este perfil?')">

        @csrf

        <button type="submit"
                class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-medium transition">

            Bloquear

        </button>
    </form>
@else
    <form action="{{ route('administrador.perfiles_user.desbloquear', $perfil->id) }}"
          method="POST"
          onsubmit="return confirm('¿Desbloquear este perfil?')">

        @csrf

        <button type="submit"
                class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-sm font-medium transition">

            Desbloquear

        </button>
    </form>
@endif

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td colspan="5"
                            class="px-6 py-10 text-center text-zinc-500">

                            No hay perfiles registrados.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection