@extends('layouts.dashboard')

@section('content')

<div class="min-h-screen text-white">

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row
                md:items-center md:justify-between
                gap-4 mb-8">

        <div>

            <h1 class="text-3xl font-bold">
                Ofertas de empleo
            </h1>

            <p class="text-zinc-400 mt-2">
                Gestión de ofertas publicadas por empleadores
            </p>

        </div>

    </div>

    {{-- BUSCADOR --}}
    <form method="GET"
          action="{{ route('administrador.ofertas_user.index') }}"
          class="mb-6">

        <div class="flex gap-3">

            <input type="text"
                   name="buscar"
                   value="{{ request('buscar') }}"
                   placeholder="Buscar por título..."
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
                        Título
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Empresa
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Modalidad
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Tipo
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm">
                        Estado
                    </th>

                    <th class="px-6 py-4 text-zinc-300 text-sm text-center">
                        Acciones
                    </th>

                </tr>

            </thead>

            {{-- BODY --}}
            <tbody>

                @forelse($ofertas as $oferta)

                    <tr class="border-b border-zinc-800 hover:bg-zinc-800/40 transition">

                        {{-- TITULO --}}
                        <td class="px-6 py-5 font-semibold">
                            {{ $oferta->titulo }}
                        </td>

                        {{-- EMPRESA --}}
                        <td class="px-6 py-5 text-zinc-300">

                            {{ $oferta->user->name ?? 'N/A' }}

                        </td>

                        {{-- MODALIDAD --}}
                        <td class="px-6 py-5 text-zinc-300">
                            {{ $oferta->modalidad }}
                        </td>

                        {{-- TIPO --}}
                        <td class="px-6 py-5 text-zinc-300">
                            {{ $oferta->tipo_empleo }}
                        </td>

                        {{-- ESTADO --}}
                        <td class="px-6 py-5">

                            @if($oferta->bloqueada ?? false)

                                <span class="text-red-500 font-semibold">
                                    Bloqueada
                                </span>

                            @elseif(!$oferta->estado)

                                <span class="text-yellow-400 font-semibold">
                                    Cerrada
                                </span>

                            @else

                                <span class="text-green-400 font-semibold">
                                    Activa
                                </span>

                            @endif

                        </td>

                        {{-- ACCIONES --}}
                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-3">

                                {{-- VER --}}
                                <a href="{{ route('administrador.ofertas_user.show', $oferta->id) }}"
                                   class="px-4 py-2 bg-blue-600
                                          hover:bg-blue-700 rounded-lg
                                          text-sm font-medium transition">

                                    Ver

                                </a>

                                {{-- EDITAR --}}
                                <a href="{{ route('administrador.ofertas_user.edit', $oferta->id) }}"
                                   class="px-4 py-2 bg-yellow-500
                                          hover:bg-yellow-600 rounded-lg
                                          text-black text-sm font-medium transition">

                                    Editar

                                </a>

                                {{-- BLOQUEAR / DESBLOQUEAR --}}
                                @if(!$oferta->bloqueada)

                                    <form action="{{ route('administrador.ofertas_user.bloquear', $oferta->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Bloquear esta oferta?')">

                                        @csrf

                                        <button type="submit"
                                                class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-medium transition">

                                            Bloquear

                                        </button>

                                    </form>

                                @else

                                    <form action="{{ route('administrador.ofertas_user.desbloquear', $oferta->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('¿Desbloquear esta oferta?')">

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

                        <td colspan="6"
                            class="px-6 py-10 text-center text-zinc-500">

                            No hay ofertas registradas.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>

@endsection