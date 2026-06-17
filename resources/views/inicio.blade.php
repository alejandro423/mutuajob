@extends('layouts.app')

@section('content')

<div class="h-[calc(100vh-96px)] overflow-y-scroll snap-y snap-mandatory">

{{-- 🔵 OFERTAS (TRABAJADOR) --}}

    @forelse($ofertas as $oferta)

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

                <p>📍 {{ $oferta->ubicacion ?? 'Ubicación no especificada' }}</p>
                <p>💰 {{ $oferta->salario ? 'Bs. '.$oferta->salario : 'Salario a convenir' }}</p>
                <p>🏢 {{ $oferta->modalidad }}</p>
                <p>📋 {{ $oferta->tipo_empleo }}</p>

            </div>

            <div class="mt-6">

                <h2 class="text-lg font-semibold text-white mb-2">
                    Descripción
                </h2>

                <p class="text-zinc-300 text-sm leading-relaxed">
                    {{ $oferta->descripcion }}
                </p>

            </div>

        </div>

        <div class="mt-6 space-y-3">

            @guest
                <a href="{{ route('login') }}"
                   class="block w-full py-3 rounded-xl bg-red-800 text-center hover:bg-red-700 transition">
                    Postularme
                </a>
            @endguest

            @auth
                <form action="{{ route('solicitudes.postular', $oferta->id) }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full py-3 rounded-xl bg-red-600 hover:bg-red-700 transition">
                        Postularme
                    </button>
                </form>
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

    @forelse($perfiles as $perfil)

        <section class="h-[calc(100vh-96px)] snap-start flex items-center justify-center px-6">

    <div class="w-full max-w-xl bg-zinc-900 border border-zinc-800 rounded-2xl p-7 shadow-lg">

        <div class="flex items-center gap-4 mb-4">

    {{-- FOTO --}}
    <div class="w-24 h-24 rounded-full overflow-hidden bg-zinc-700 shrink-0">

        @if($perfil->foto)

            <img src="{{ asset('storage/' . $perfil->foto) }}"
                 alt="Foto de perfil"
                 class="w-full h-full object-cover">

        @else

            <div class="w-full h-full flex items-center justify-center text-2xl font-bold text-white">

                {{ strtoupper(substr($perfil->nombre ?? 'U', 0, 1)) }}

            </div>

        @endif

    </div>

    <div>

        <h1 class="text-2xl font-bold text-white">
            {{ $perfil->nombre }} {{ $perfil->apellido }}
        </h1>

        <p class="text-zinc-400 mt-1">
            {{ $perfil->profesion }}
        </p>

    </div>

</div>

        <div class="mt-4 space-y-1 text-sm text-zinc-400">

            <p> {{ $perfil->ubicacion }}</p>
            <p> {{ $perfil->email }}</p>
            <p> {{ $perfil->telefono }}</p>
            <p> DNI: {{ $perfil->dni }}</p>
            <p> {{ $perfil->sexo }}</p>

        </div>

       <p class="text-zinc-300 mt-4 text-sm leading-relaxed">
    {{ $perfil->resumen_profesional }}
</p>

{{-- HABILIDADES --}}
@if($perfil->habilidades->count())

<div class="mt-4">

    <h3 class="text-white font-semibold mb-2">
        Habilidades
    </h3>

    <div class="flex flex-wrap gap-2">

        @foreach($perfil->habilidades as $habilidad)

            <span class="bg-zinc-800 px-3 py-1 rounded-full text-sm text-zinc-300">

                {{ $habilidad->nombre }}
                ({{ $habilidad->pivot->nivel }}/5)

            </span>

        @endforeach

    </div>

</div>

@endif

{{-- IDIOMAS --}}
@if($perfil->idiomas->count())

<div class="mt-4">

    <h3 class="text-white font-semibold mb-2">
        Idiomas
    </h3>

    @foreach($perfil->idiomas as $idioma)

        <p class="text-zinc-300 text-sm">

            {{ $idioma->nombre }}
            (Nivel {{ $idioma->pivot->nivel }}/5)

        </p>

    @endforeach

</div>

@endif

{{-- EXPERIENCIA --}}
@if($perfil->experiencias->count())

<div class="mt-4">

    <h3 class="text-white font-semibold mb-2">
        Experiencia Laboral
    </h3>

    @foreach($perfil->experiencias as $experiencia)

        <div class="mb-2">

            <p class="text-white">

                {{ $experiencia->cargo }}

            </p>

            <p class="text-zinc-400 text-sm">

                {{ $experiencia->empresa }}

            </p>

        </div>

    @endforeach

</div>

@endif
<div class="mt-6 flex gap-3 flex-col md:flex-row">

    <a href="{{ route('perfil.show', $perfil->id) }}"
       class="flex-1 py-3 bg-zinc-700 hover:bg-zinc-600 rounded-xl text-center transition">
        Ver perfil
    </a>

    <form action="{{ route('solicitudes.invitar', [$perfil->id, 1]) }}"
          method="POST"
          class="flex-1">

        @csrf

        <button type="submit"
                class="w-full py-3 bg-blue-600 hover:bg-blue-700 rounded-xl transition">
            Invitar
        </button>

    </form>

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