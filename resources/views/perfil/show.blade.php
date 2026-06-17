@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto p-6">
    

    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl p-8">

        {{-- FOTO --}}
        <div class="flex justify-center mb-6">

            <div class="w-32 h-32 rounded-full overflow-hidden bg-zinc-700">

                @if($perfil->foto)

                    <img src="{{ asset('storage/' . $perfil->foto) }}"
                         alt="Foto"
                         class="w-full h-full object-cover">

                @else

                    <div class="w-full h-full flex items-center justify-center text-4xl font-bold text-white">

                        {{ strtoupper(substr($perfil->nombre ?? 'U', 0, 1)) }}

                    </div>

                @endif

            </div>

        </div>

        <h1 class="text-3xl font-bold text-white text-center">
            {{ $perfil->nombre }} {{ $perfil->apellido }}
        </h1>

        <p class="text-zinc-400 text-center mt-2">
            {{ $perfil->profesion }}
        </p>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4 text-zinc-300">

            <div>
                <strong>Email:</strong>
                {{ $perfil->email }}
            </div>

            <div>
                <strong>Teléfono:</strong>
                {{ $perfil->telefono }}
            </div>

            <div>
                <strong>Ubicación:</strong>
                {{ $perfil->ubicacion }}
            </div>

            <div>
                <strong>DNI:</strong>
                {{ $perfil->dni }}
            </div>

            <div>
                <strong>Sexo:</strong>
                {{ $perfil->sexo }}
            </div>

            <div>
                <strong>Disponibilidad:</strong>
                {{ $perfil->disponibilidad }}
            </div>

            <div>
                <strong>Modalidad:</strong>
                {{ $perfil->modalidad }}
            </div>

            <div>
                <strong>Salario esperado:</strong>
                Bs. {{ $perfil->salario_esperado }}
            </div>

        </div>

        @if($perfil->resumen_profesional)

            <div class="mt-8">

                <h2 class="text-xl font-semibold text-white mb-3">
                    Resumen Profesional
                </h2>

                <p class="text-zinc-300">
                    {{ $perfil->resumen_profesional }}
                </p>

            </div>

        @endif

        <div class="mt-8">

            <a href="{{ url()->previous() }}"
               class="inline-block px-6 py-3 bg-zinc-700 hover:bg-zinc-600 rounded-xl transition">

                Volver

            </a>

        </div>

    </div>
{{-- HABILIDADES --}}
<div class="mt-8 bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

    <h2 class="text-xl font-bold mb-4">
        Habilidades
    </h2>

    @if($perfil->habilidades->count())

        <div class="space-y-2">

            @foreach($perfil->habilidades as $habilidad)

                <div class="flex justify-between items-center bg-zinc-800 p-3 rounded-lg">

                    <span>
                        {{ $habilidad->nombre }}
                    </span>

                    <div class="flex items-center gap-3">

    <span class="text-sm text-zinc-400 min-w-[40px]">
        {{ $habilidad->pivot->nivel }}/5
    </span>

    <div class="w-32 bg-zinc-700 rounded-full h-2">

        <div class="bg-green-500 h-2 rounded-full"
             style="width: {{ (($habilidad->pivot->nivel ?? 0) / 5) * 100 }}%">
        </div>

    </div>

</div>

                </div>

            @endforeach

        </div>

    @else

        <p class="text-zinc-400">
            No hay habilidades registradas.
        </p>

    @endif

</div>
{{-- IDIOMAS --}}
<div class="mt-8 bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

    <h2 class="text-xl font-bold mb-4">
        Idiomas
    </h2>

    @if($perfil->idiomas->count())

        <div class="space-y-2">

            @foreach($perfil->idiomas as $idioma)

                <div class="flex justify-between items-center bg-zinc-800 p-3 rounded-lg">

                    <span>
                        {{ $idioma->nombre }}
                    </span>

                    <div class="flex items-center gap-3">

                        <span class="text-sm text-zinc-400 min-w-[40px]">
                            {{ $idioma->pivot->nivel ?? 0 }}/5
                        </span>

                        <div class="w-32 bg-zinc-700 rounded-full h-2">

                            <div class="bg-blue-500 h-2 rounded-full"
                                 style="width: {{ (($idioma->pivot->nivel ?? 0) / 5) * 100 }}%">
                            </div>

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <p class="text-zinc-400">
            No hay idiomas registrados.
        </p>

    @endif

{{-- CERTIFICACIONES --}}
<div class="mt-8 bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

    <h2 class="text-xl font-bold mb-4">
        Certificaciones
    </h2>

    @if($perfil->certificaciones->count())

        <div class="space-y-4">

            @foreach($perfil->certificaciones as $certificacion)

                <div class="bg-zinc-800 p-5 rounded-xl border border-zinc-700">

                    <div class="flex flex-col md:flex-row gap-6">

                        {{-- EVIDENCIA --}}
                        <div class="flex justify-center">

                            @if($certificacion->evidencia)

                                <a href="{{ asset('storage/' . $certificacion->evidencia) }}"
                                   target="_blank">

                                    <img
                                        src="{{ asset('storage/' . $certificacion->evidencia) }}"
                                        alt="Certificación"
                                        class="w-48 h-32 object-cover rounded-xl border border-zinc-700"
                                    >

                                </a>

                            @else

                                <div class="w-48 h-32 rounded-xl border border-dashed border-zinc-700 flex items-center justify-center text-zinc-500">

                                    Sin evidencia

                                </div>

                            @endif

                        </div>

                        {{-- INFORMACIÓN --}}
                        <div class="flex-1">

                            <h3 class="text-lg font-bold text-white">
                                {{ $certificacion->nombre }}
                            </h3>

                            <p class="text-zinc-400">
                                {{ $certificacion->institucion }}
                            </p>

                            <div class="mt-3 text-sm text-zinc-400">

                                <p>
                                    Obtenida:
                                    {{ $certificacion->fecha_obtencion ?? 'No registrada' }}
                                </p>

                                <p>
                                    Expira:
                                    {{ $certificacion->fecha_expiracion ?? 'No expira' }}
                                </p>

                            </div>

                            @if($certificacion->descripcion)

                                <p class="mt-4 text-zinc-300">
                                    {{ $certificacion->descripcion }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            @endforeach

        </div>

    @else

        <p class="text-zinc-400">
            No hay certificaciones registradas.
        </p>

    @endif

</div>
{{-- EXPERIENCIA LABORAL --}}
<div class="mt-8 bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

    <h2 class="text-xl font-bold mb-4">
        Experiencia Laboral
    </h2>

    @if($perfil->experiencias->count())

        <div class="space-y-4">

            @foreach($perfil->experiencias as $experiencia)

                <div class="bg-zinc-800 p-5 rounded-xl border border-zinc-700">

                    <div class="flex justify-between items-start">

                        <div>

                            <h3 class="text-lg font-semibold text-white">
                                {{ $experiencia->cargo }}
                            </h3>

                            <p class="text-zinc-400">
                                {{ $experiencia->empresa }}
                            </p>

                        </div>

                        <span class="text-sm text-zinc-500">
                            {{ $experiencia->fecha_inicio }}
                            -
                            {{ $experiencia->fecha_fin ?? 'Actualidad' }}
                        </span>

                    </div>

                    @if($experiencia->descripcion)

                        <div class="mt-4">

                            <p class="text-zinc-300 leading-relaxed">
                                {{ $experiencia->descripcion }}
                            </p>

                        </div>

                    @endif

                </div>

            @endforeach

        </div>

    @else

        <p class="text-zinc-400">
            No hay experiencias registradas.
        </p>

    @endif

</div>

@endsection