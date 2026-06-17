@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white flex items-center justify-center px-4">

    <div class="w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-6">

        {{-- PERFIL --}}
        <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

           {{-- HEADER PERFIL --}}
<div class="border-b border-zinc-800 pb-6 mb-6">
{{-- ESTADO PERFIL --}}
<div class="flex items-center justify-between bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 mt-4">

    <div>

        <p class="text-sm text-zinc-400">
            Estado del perfil
        </p>

        <p class="text-sm font-semibold">

            @if($perfil->estado)

                <span class="text-green-400">
                    Habilitado
                </span>

            @else

                <span class="text-red-400">
                    Deshabilitado
                </span>

            @endif

        </p>

    </div>

    <form action="{{ route('perfil.toggleEstado', $perfil->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <button type="submit"
                class="relative inline-flex h-7 w-14 items-center rounded-full transition
                {{ $perfil->estado ? 'bg-green-600' : 'bg-zinc-600' }}">

            <span class="inline-block h-5 w-5 transform rounded-full bg-white transition
            {{ $perfil->estado ? 'translate-x-8' : 'translate-x-1' }}">
            </span>

        </button>

    </form>

</div>
    <div class="flex flex-col md:flex-row items-center md:items-start gap-5">

        {{-- FOTO --}}
        <div class="w-28 h-28 rounded-full overflow-hidden bg-zinc-700 shrink-0">

            @if($perfil->foto)

                <img src="{{ asset('storage/' . $perfil->foto) }}"
                     alt="Foto de perfil"
                     class="w-full h-full object-cover">

            @else

                <div class="w-full h-full flex items-center justify-center text-3xl font-bold">

                    {{ strtoupper(substr($perfil->nombre ?? 'U', 0, 1)) }}

                </div>

            @endif

        </div>
<p>{{ $perfil->foto }}</p>
        {{-- NOMBRE --}}
        <div class="flex-1 text-center md:text-left">

            <h1 class="text-3xl font-bold text-white">

                {{ $perfil->nombre ?? 'Sin nombre' }}
                {{ $perfil->apellido ?? '' }}

            </h1>

            <p class="text-zinc-400 mt-2">

                {{ $perfil->email ?? 'Sin email' }}

            </p>

        </div>

    </div>

</div>

{{-- DATOS PERFIL --}}
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

    {{-- DNI --}}
    <div>
        <p class="text-zinc-400 text-sm">
            DNI / CI
        </p>

        <p class="text-white">
            {{ $perfil->dni ?? 'No registrado' }}
        </p>
    </div>

    {{-- FECHA NACIMIENTO --}}
    <div>
        <p class="text-zinc-400 text-sm">
            Fecha de nacimiento
        </p>

        <p class="text-white">
            {{ $perfil->fecha_nacimiento ?? 'No registrada' }}
        </p>
    </div>

    {{-- SEXO --}}
    <div>
        <p class="text-zinc-400 text-sm">
            Sexo
        </p>

        <p class="text-white">
            {{ ucfirst($perfil->sexo ?? 'No registrado') }}
        </p>
    </div>

    {{-- TELEFONO --}}
    <div>
        <p class="text-zinc-400 text-sm">
            Teléfono
        </p>

        <p class="text-white">
            {{ $perfil->telefono ?? 'No registrado' }}
        </p>
    </div>

    {{-- UBICACION --}}
    <div>
        <p class="text-zinc-400 text-sm">
            Ubicación
        </p>

        <p class="text-white">
            {{ $perfil->ubicacion ?? 'No registrada' }}
        </p>
    </div>

    {{-- EMAIL --}}
    <div>
        <p class="text-zinc-400 text-sm">
            Correo electrónico
        </p>

        <p class="text-white break-all">
            {{ $perfil->email ?? 'Sin email' }}
        </p>
    </div>

</div>

{{-- DESCRIPCION --}}
<div class="mt-8">

    <p class="text-zinc-400 text-sm mb-2">
        Resumen profesional
    </p>

    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-5">

        <p class="leading-relaxed text-zinc-300">

            {{ $perfil->resumen_profesional ?? 'Sin descripción' }}

        </p>

    </div>

</div>

            <div class="mt-6 flex gap-3">
                <a href="{{ route('perfil.edit', $perfil->id ?? 0) }}"
                   class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm font-semibold">
                    Editar perfil
                </a>
<a href="{{ route('perfil.pdf') }}"
   class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg text-sm font-semibold transition">

    Descargar todo el perfil en PDF

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

        <div class="flex gap-2 items-start">

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
        <h2 class="text-xl font-bold">Idiomas que hablo</h2>

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

                    <div class="flex gap-2 items-start">

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

    <div class="flex justify-between items-center mb-6">

        <h2 class="text-xl font-bold">
            Certificaciones
        </h2>

        <a href="{{ route('perfil.certificacion_create') }}"
           class="px-4 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg text-sm font-semibold transition">

            + Agregar certificación

        </a>

    </div>

    @if($perfil && $perfil->certificaciones->count())

        <div class="space-y-4">

            @foreach($perfil->certificaciones as $certificacion)

                <div class="bg-zinc-800 p-5 rounded-2xl border border-zinc-700">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                        {{-- INFORMACION --}}
                        <div class="lg:col-span-2 space-y-4">

                            {{-- NOMBRE --}}
                            <div>

                                <h3 class="text-lg font-bold text-white">
                                    {{ $certificacion->nombre }}
                                </h3>

                                <p class="text-zinc-400">
                                    {{ $certificacion->institucion ?? 'Institución desconocida' }}
                                </p>

                            </div>

                            {{-- FECHAS --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                                <div>

                                    <p class="text-zinc-500 text-sm">
                                        Fecha de obtención
                                    </p>

                                    <p class="text-white">
                                        {{ $certificacion->fecha_obtencion ?? 'No registrada' }}
                                    </p>

                                </div>

                                <div>

                                    <p class="text-zinc-500 text-sm">
                                        Fecha de expiración
                                    </p>

                                    <p class="text-white">
                                        {{ $certificacion->fecha_expiracion ?? 'No expira' }}
                                    </p>

                                </div>

                            </div>

                            {{-- DESCRIPCION --}}
                            @if($certificacion->descripcion)

                                <div>

                                    <p class="text-zinc-500 text-sm mb-1">
                                        Descripción
                                    </p>

                                    <p class="text-zinc-300 leading-relaxed">
                                        {{ $certificacion->descripcion }}
                                    </p>

                                </div>

                            @endif

                        </div>

                        {{-- COLUMNA DERECHA --}}
                        <div class="flex flex-col items-center justify-between gap-4">

                            {{-- EVIDENCIA --}}
                            @if($certificacion->evidencia)

                                <a href="{{ asset('storage/' . $certificacion->evidencia) }}"
                                   target="_blank">

                                    <img
                                        src="{{ asset('storage/' . $certificacion->evidencia) }}"
                                        alt="Evidencia"
                                        class="w-52 h-36 object-cover rounded-xl border border-zinc-700 hover:scale-105 transition"
                                    >

                                </a>

                            @else

                                <div class="w-52 h-36 rounded-xl border border-dashed border-zinc-700 flex items-center justify-center text-zinc-500 text-sm">

                                    Sin evidencia

                                </div>

                            @endif

                            {{-- BOTONES --}}
                            <div class="flex gap-2">

                                <a href="{{ route('perfil.certificacion_edit', $certificacion->id) }}"
                                   class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg text-sm transition">

                                    Editar

                                </a>

                                <form action="{{ route('perfil.certificacion_destroy', $certificacion->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('¿Eliminar esta certificación del perfil?')">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-sm transition">

                                        Eliminar

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <div class="bg-zinc-800 border border-zinc-700 rounded-xl p-5 text-center">

            <p class="text-zinc-400">
                No hay certificaciones registradas
            </p>

        </div>

    @endif

</div>
{{--experiencia--}}
<div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">
    <div class="flex justify-between items-center mb-4">

        <h2 class="text-xl font-bold">Experiencia Laboral</h2>

        <a href="{{ route('perfil.experiencia_create') }}"
           class="px-4 py-2 bg-green-600 hover:bg-green-700 rounded-lg text-sm font-semibold transition">
            + Agregar experiencia
        </a>

    </div>

    @if($perfil && $perfil->experiencias->count())

        <div class="space-y-3">

            @foreach($perfil->experiencias as $experiencia)

                <div class="flex justify-between items-center bg-zinc-800 p-4 rounded-xl border border-zinc-700">

                    <div class="flex flex-col">

                        <span class="font-semibold text-white">
                            {{ $experiencia->cargo }} en {{ $experiencia->empresa }}
                        </span>

                        <span class="text-sm text-zinc-400">
                            {{ $experiencia->fecha_inicio }} - {{ $experiencia->fecha_fin ?? 'Actualidad' }}
                        </span>

                    </div>

                    <div class="flex gap-2 items-start">

                        <a href="{{ route('perfil.experiencia_edit', $experiencia->id) }}"
                           class="px-3 py-1.5 bg-yellow-600 hover:bg-yellow-700 rounded-lg text-sm transition">
                            Editar
                        </a>

                        <form action="{{ route('perfil.experiencia_destroy', $experiencia->id) }}"
                              method="POST"
                              onsubmit="return confirm('¿Eliminar esta experiencia del perfil?')">

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
                No hay experiencias registradas
            </p>
        </div>
    @endif
</div>