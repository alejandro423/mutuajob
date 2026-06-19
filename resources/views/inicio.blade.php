@extends('layouts.app')

@section('content')

<div class="h-[calc(100vh-96px)] overflow-y-scroll snap-y snap-mandatory">

{{-- 🔵 OFERTAS (TRABAJADOR) --}}
@forelse($ofertas ?? [] as $oferta)

<section class="h-[calc(100vh-96px)] snap-start flex items-center justify-center px-6">

    <div class="w-full max-w-3xl bg-zinc-950 border border-zinc-800 rounded-2xl p-8 flex flex-col justify-between shadow-lg">

        <div>

            <span class="text-red-500 font-semibold text-sm tracking-wide">
                OFERTA LABORAL
            </span>

            <h1 class="text-3xl md:text-4xl font-bold text-white mt-3">
                {{ $oferta->titulo }}
            </h1>

            <div class="mt-5 space-y-2 text-zinc-400 text-sm">

                <p class="flex items-center gap-2">
                    <i class="bi bi-geo-alt-fill text-zinc-500"></i>
                    {{ $oferta->ubicacion ?? 'Ubicación no especificada' }}
                </p>

                <p class="flex items-center gap-2">
                    <i class="bi bi-cash-coin text-zinc-500"></i>
                    {{ $oferta->salario ? 'Bs. '.$oferta->salario : 'Salario a convenir' }}
                </p>

                <p class="flex items-center gap-2">
                    <i class="bi bi-building text-zinc-500"></i>
                    {{ $oferta->modalidad }}
                </p>

                <p class="flex items-center gap-2">
                    <i class="bi bi-briefcase text-zinc-500"></i>
                    {{ $oferta->tipo_empleo }}
                </p>

            </div>

            <div class="mt-6">
                <h2 class="text-lg font-semibold text-white mb-2">
                    Descripción
                </h2>

                <p class="text-zinc-300 text-sm leading-relaxed break-words whitespace-normal">
                    {{ $oferta->descripcion }}
                </p>
            </div>

        </div>

        <div class="mt-6 space-y-3">

    @auth

        {{-- SOLO ADMIN PUEDE VER SOLO CHAT --}}
        @if(auth()->check() && auth()->user()->hasRole('administrador'))

            <form action="{{ route('chat.start', $oferta->user_id) }}" method="POST">
                @csrf

                <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 transition rounded-xl">
                    Chat
                </button>
            </form>

        @else

            {{-- POSTULAR (TRABAJADOR / EMPLEADOR NORMAL) --}}
            <form action="{{ route('solicitudes.postular', $oferta->id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-700 transition">
                    Postularme
                </button>
            </form>

            {{-- CHAT CON EMPLEADOR --}}
            <form action="{{ route('chat.start', $oferta->user_id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 transition rounded-xl">
                    Chat con empleador
                </button>
            </form>

        @endif

    @endauth

</div>

    </div>

</section>

@empty
    <div class="h-full flex items-center justify-center">
        <p class="text-zinc-400 text-xl">
            No existen ofertas disponibles.
        </p>
    </div>
@endforelse


{{-- 🟢 PERFILES (EMPLEADOR) --}}
@forelse($perfiles ?? [] as $perfil)

<section class="h-[calc(100vh-96px)] snap-start flex items-center justify-center px-6">

    <div class="w-full max-w-xl bg-zinc-900 border border-zinc-800 rounded-2xl p-7 shadow-lg">

        <div class="flex items-center gap-4 mb-4">

            <div class="w-24 h-24 rounded-full overflow-hidden bg-zinc-700 shrink-0">

                @if($perfil->foto)
                    <img src="{{ asset('storage/' . $perfil->foto) }}"
                         class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-white">
                        {{ strtoupper(substr($perfil->nombre ?? 'U', 0, 1)) }}
                    </div>
                @endif

            </div>

            <div>
                <h1 class="text-2xl font-bold text-white break-words">
                    {{ $perfil->nombre }} {{ $perfil->apellido }}
                </h1>

                <p class="text-zinc-400 mt-1 break-words">
                    {{ $perfil->profesion }}
                </p>
            </div>

        </div>

        <div class="mt-4 space-y-1 text-sm text-zinc-400 break-words">

            <p>{{ $perfil->ubicacion }}</p>
            <p>{{ $perfil->email }}</p>
            <p>{{ $perfil->telefono }}</p>
            <p>DNI: {{ $perfil->dni }}</p>
            <p>{{ $perfil->sexo }}</p>

        </div>

        <p class="text-zinc-300 mt-4 text-sm leading-relaxed break-words">
            {{ $perfil->resumen_profesional }}
        </p>

        {{-- BOTONES --}}
        <div class="mt-6 flex flex-col gap-3 md:flex-row">

    <a href="{{ route('perfil.show', $perfil->id) }}"
       class="flex-1 py-3 bg-zinc-700 hover:bg-zinc-600 rounded-xl text-center transition">
        Ver perfil
    </a>

    @auth

        @if(auth()->check() && auth()->user()->hasRole('administrador'))

            {{-- SOLO CHAT --}}
            <form action="{{ route('chat.start', $perfil->user_id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 rounded-xl transition">
                    Chat
                </button>
            </form>

        @else

            {{-- INVITAR --}}
            <form action="{{ route('solicitudes.invitar', [$perfil->id, 1]) }}"
                  method="POST"
                  class="flex-1">
                @csrf
                <button type="submit"
                        class="w-full py-3 bg-blue-600 hover:bg-blue-700 rounded-xl transition">
                    Invitar
                </button>
            </form>

            {{-- CHAT --}}
            <form action="{{ route('chat.start', $perfil->user_id) }}" method="POST">
                @csrf
                <button type="submit"
                        class="w-full py-3 bg-zinc-700 hover:bg-zinc-600 rounded-xl transition">
                    Chat
                </button>
            </form>

        @endif

    @endauth

</div>

    </div>

</section>

@empty
    <div class="h-full flex items-center justify-center">
        <p class="text-zinc-400 text-xl">
            No hay perfiles disponibles.
        </p>
    </div>
@endforelse

</div>

@endsection