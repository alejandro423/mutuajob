@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white flex items-center justify-center px-4">

    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- PERFIL --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

            <div class="flex items-center gap-4 border-b border-zinc-800 pb-4 mb-6">
                <div class="w-16 h-16 rounded-full bg-zinc-700 flex items-center justify-center text-xl font-bold">
                    {{ strtoupper(substr($perfil->nombre ?? 'U', 0, 1)) }}
                </div>

                <div>
                    <h1 class="text-xl font-bold">
                        {{ $perfil->nombre ?? 'Sin nombre' }} {{ $perfil->apellido ?? '' }}
                    </h1>
                    <p class="text-sm text-zinc-400">{{ $perfil->email ?? 'Sin email' }}</p>
                </div>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-zinc-400 text-sm">Teléfono</p>
                    <p>{{ $perfil->telefono ?? 'No registrado' }}</p>
                </div>

                <div>
                    <p class="text-zinc-400 text-sm">Ubicación</p>
                    <p>{{ $perfil->ubicacion ?? 'No registrada' }}</p>
                </div>

                <div>
                    <p class="text-zinc-400 text-sm">Descripción</p>
                    <p class="leading-relaxed">
                        {{ $perfil->resumen_profesional ?? 'Sin descripción' }}
                    </p>
                </div>
            </div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('perfil.edit', $perfil->id ?? 0) }}"
                   class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-semibold">
                    Editar perfil
                </a>

                <a href="{{ url('/') }}"
                   class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 rounded-lg text-sm">
                    Volver
                </a>
            </div>

        </div>

        {{-- HABILIDADES --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

    <div class="flex justify-between items-center mb-4">

        <h2 class="text-xl font-bold">Habilidades</h2>

        <a href="{{ route('habilidades.create') }}"
           class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-sm font-semibold">
            + Agregar habilidad
        </a>

    </div>

@if($perfil && $perfil->habilidades->count())
        <div class="space-y-2">

@foreach($perfil->habilidades as $habilidad)
    <div class="flex justify-between items-center bg-zinc-800 p-3 rounded-lg">

        <div class="flex flex-col">

            <span>{{ $habilidad->nombre }}</span>

            {{-- NIVEL --}}
            <span class="text-xs text-zinc-400">
                Nivel: {{ $habilidad->pivot->nivel ?? 0 }}/5
            </span>

        </div>

        <div class="flex gap-2">

            <a href="{{ route('perfil_habilidad.edit', $habilidad->id) }}"
               class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 rounded text-sm">
                Editar nivel
            </a>

            <form action="{{ route('perfil_habilidad.destroy', $habilidad->id) }}"
                  method="POST"
                  onsubmit="return confirm('¿Eliminar esta habilidad del perfil?')">

                @csrf
                @method('DELETE')

                <button type="submit"
                        class="px-3 py-1 bg-red-600 hover:bg-red-700 rounded text-sm">
                    Eliminar
                </button>

            </form>

        </div>

    </div>
@endforeach

        </div>

    @else
        <p class="text-zinc-400">No hay habilidades registradas</p>
    @endif

</div>
{{-- IDIOMAS --}}
<div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold">Idiomas</h2>

        <a href="{{ route('perfil.idioma_create') }}"
           class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-semibold transition">
            + Agregar idioma
        </a>
    </div>

    @if($perfil && $perfil->idiomas->count())

        <div class="space-y-3">

            @foreach($perfil->idiomas as $idioma)

                <div class="flex justify-between items-center bg-zinc-800 p-4 rounded-xl border border-zinc-700">

                    <div class="flex flex-col">
                        <span class="font-semibold text-white">
                            {{ $idioma->nombre }}
                        </span>

                        <span class="text-sm text-zinc-400">
                            Nivel: {{ $idioma->pivot->nivel ?? 0 }}/5
                        </span>
                    </div>

                    <div class="flex gap-2">

                        <a href="{{ route('perfil_idioma.edit', $idioma->id) }}"
                           class="px-3 py-1.5 bg-yellow-600 hover:bg-yellow-700 rounded-lg text-sm transition">
                            Editar
                        </a>

                        <form action="{{ route('perfil_idioma.destroy', $idioma->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Eliminar este idioma del perfil?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-3 py-1.5 bg-red-600 hover:bg-red-700 rounded-lg text-sm transition">
                                Eliminar
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-zinc-800 border border-zinc-700 rounded-xl p-4 text-center">
            <p class="text-zinc-400">
                No hay idiomas registrados
            </p>
        </div>
    @endif
</div>
{{-- CERTIFICACIONES --}}
<div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">
    <div class="flex justify-between items-center mb-4">

        <h2 class="text-xl font-bold">Certificaciones</h2>

        <a href="{{ route('perfil.certificacion_create') }}"
           class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg text-sm font-semibold transition">
            + Agregar certificación
        </a>

    </div>

    @if($perfil && $perfil->certificaciones->count())

        <div class="space-y-3">

            @foreach($perfil->certificaciones as $certificacion)

                <div class="flex justify-between items-center bg-zinc-800 p-4 rounded-xl border border-zinc-700">

                    <div class="flex flex-col">

                        <span class="font-semibold text-white">
                            {{ $certificacion->nombre }}
                        </span>

                        <span class="text-sm text-zinc-400">
                            {{ $certificacion->institucion ?? 'Institución desconocida' }}
                        </span>

                    </div>

                    <div class="flex gap-2">

                        <a href="{{ route('perfil.certificacion_edit', $certificacion->id) }}"
                           class="px-3 py-1.5 bg-yellow-600 hover:bg-yellow-700 rounded-lg text-sm transition">
                            Editar
                        </a>

                        <form action="{{ route('perfil.certificacion_destroy', $certificacion->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Eliminar esta certificación del perfil?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="px-3 py-1.5 bg-red-600 hover:bg-red-700 rounded-lg text-sm transition">
                                Eliminar
                            </button>

                        </form>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-zinc-800 border border-zinc-700 rounded-xl p-4 text-center">
            <p class="text-zinc-400">
                No hay certificaciones registradas
            </p>
        </div>

    @endif

</div>