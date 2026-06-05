@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto py-10 px-4">

    <div class="bg-zinc-900 border border-zinc-800 rounded-2xl shadow-2xl p-8">

        {{-- TITULO --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold text-white">
                Editar Experiencia Laboral
            </h1>

            <p class="text-zinc-400 mt-2">
                Actualiza la información de tu experiencia profesional.
            </p>

        </div>

        {{-- ERRORES --}}
        @if ($errors->any())

            <div class="bg-red-500/10 border border-red-500 text-red-400 rounded-xl p-4 mb-6">

                <ul class="list-disc list-inside space-y-1">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORMULARIO --}}
        <form action="{{ route('perfil.experiencia_update', $experiencia->id) }}"
              method="POST"
              class="space-y-6">

            @csrf
            @method('PUT')

            {{-- EMPRESA --}}
            <div>

                <label for="empresa"
                       class="block text-sm font-semibold text-zinc-300 mb-2">
                    Empresa
                </label>

                <input type="text"
                       id="empresa"
                       name="empresa"
                       value="{{ old('empresa', $experiencia->empresa) }}"
                       required
                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            {{-- CARGO --}}
            <div>

                <label for="cargo"
                       class="block text-sm font-semibold text-zinc-300 mb-2">
                    Cargo
                </label>

                <input type="text"
                       id="cargo"
                       name="cargo"
                       value="{{ old('cargo', $experiencia->cargo) }}"
                       required
                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            {{-- TIPO EMPLEO --}}
            <div>

                <label for="tipo_empleo"
                       class="block text-sm font-semibold text-zinc-300 mb-2">
                    Tipo de empleo
                </label>

                <input type="text"
                       id="tipo_empleo"
                       name="tipo_empleo"
                       value="{{ old('tipo_empleo', $experiencia->tipo_empleo) }}"
                       placeholder="Tiempo completo, Freelance..."
                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            {{-- UBICACION --}}
            <div>

                <label for="ubicacion"
                       class="block text-sm font-semibold text-zinc-300 mb-2">
                    Ubicación
                </label>

                <input type="text"
                       id="ubicacion"
                       name="ubicacion"
                       value="{{ old('ubicacion', $experiencia->ubicacion) }}"
                       placeholder="La Paz, Bolivia"
                       class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

            </div>

            {{-- FECHAS --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- FECHA INICIO --}}
                <div>

                    <label for="fecha_inicio"
                           class="block text-sm font-semibold text-zinc-300 mb-2">
                        Fecha de inicio
                    </label>

                    <input type="date"
                           id="fecha_inicio"
                           name="fecha_inicio"
                           value="{{ old('fecha_inicio', $experiencia->fecha_inicio) }}"
                           required
                           class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

                {{-- FECHA FIN --}}
                <div>

                    <label for="fecha_fin"
                           class="block text-sm font-semibold text-zinc-300 mb-2">
                        Fecha de finalización
                    </label>

                    <input type="date"
                           id="fecha_fin"
                           name="fecha_fin"
                           value="{{ old('fecha_fin', $experiencia->fecha_fin) }}"
                           class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">

                </div>

            </div>

            {{-- TRABAJO ACTUAL --}}
            <div class="flex items-center gap-3">

                <input type="checkbox"
                       id="trabajo_actual"
                       name="trabajo_actual"
                       {{ $experiencia->trabajo_actual ? 'checked' : '' }}
                       class="w-5 h-5 rounded bg-zinc-800 border-zinc-700 text-blue-600 focus:ring-blue-500">

                <label for="trabajo_actual"
                       class="text-zinc-300">
                    Actualmente trabajo aquí
                </label>

            </div>

            {{-- DESCRIPCION --}}
            <div>

                <label for="descripcion"
                       class="block text-sm font-semibold text-zinc-300 mb-2">
                    Descripción
                </label>

                <textarea id="descripcion"
                          name="descripcion"
                          rows="5"
                          placeholder="Describe tus responsabilidades, tecnologías usadas, logros, etc..."
                          class="w-full bg-zinc-800 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('descripcion', $experiencia->descripcion) }}</textarea>

            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end gap-3 pt-4">

                <a href="{{ route('perfil.index') }}"
                   class="px-5 py-3 bg-zinc-700 hover:bg-zinc-600 text-white rounded-xl transition">
                    Cancelar
                </a>

                <button type="submit"
                        class="px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-xl transition">
                    Guardar cambios
                </button>

            </div>

        </form>

    </div>

</div>

@endsection