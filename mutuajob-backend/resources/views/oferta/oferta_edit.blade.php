@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-zinc-950 text-white px-4 py-6">

    <div class="max-w-6xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-6">

            <h1 class="text-3xl font-bold">
                Editar oferta laboral
            </h1>

            <p class="text-zinc-400 mt-1">
                Actualiza la información de tu oferta publicada
            </p>

        </div>

        {{-- ERRORES --}}
        @if($errors->any())

            <div class="bg-red-600/20 border border-red-500
                        text-red-300 rounded-xl p-4 mb-6">

                <ul class="space-y-1 text-sm">

                    @foreach($errors->all() as $error)

                        <li>• {{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        {{-- FORMULARIO --}}
        <form action="{{ route('oferta.update', $oferta->id) }}"
              method="POST"
              class="space-y-5">

            @csrf
            @method('PUT')

            {{-- TITULO + SALARIO --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">

                <div class="lg:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Título de la oferta
                    </label>

                    <input type="text"
                           name="titulo"
                           value="{{ old('titulo', $oferta->titulo) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

                <div>

                    <label class="block text-sm font-medium mb-2">
                        Salario
                    </label>

                    <input type="number"
                           step="0.01"
                           name="salario"
                           value="{{ old('salario', $oferta->salario) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

            </div>

            {{-- DESCRIPCION --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Descripción
                </label>

                <textarea name="descripcion"
                          rows="4"
                          class="w-full bg-zinc-900 border border-zinc-700
                                 rounded-xl px-4 py-3 text-white
                                 focus:outline-none focus:border-blue-500">{{ old('descripcion', $oferta->descripcion) }}</textarea>

            </div>

            {{-- INFO GENERAL --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- UBICACION --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Ubicación
                    </label>

                    <input type="text"
                           name="ubicacion"
                           value="{{ old('ubicacion', $oferta->ubicacion) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

                {{-- TELEFONO --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Contacto
                    </label>

                    <input type="text"
                           name="numero_contacto"
                           value="{{ old('numero_contacto', $oferta->numero_contacto) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

                {{-- EMAIL --}}
                <div class="lg:col-span-2">

                    <label class="block text-sm font-medium mb-2">
                        Email de contacto
                    </label>

                    <input type="email"
                           name="email_contacto"
                           value="{{ old('email_contacto', $oferta->email_contacto) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

            </div>

            {{-- REQUISITOS --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">

                {{-- INDISPENSABLES --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Requisitos indispensables
                    </label>

                    <textarea name="requisitos_indispensables"
                              rows="5"
                              class="w-full bg-zinc-900 border border-zinc-700
                                     rounded-xl px-4 py-3 text-white
                                     focus:outline-none focus:border-blue-500">{{ old('requisitos_indispensables', $oferta->requisitos_indispensables) }}</textarea>

                </div>

                {{-- DESEABLES --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Requisitos deseables
                    </label>

                    <textarea name="requisitos_deseables"
                              rows="5"
                              class="w-full bg-zinc-900 border border-zinc-700
                                     rounded-xl px-4 py-3 text-white
                                     focus:outline-none focus:border-blue-500">{{ old('requisitos_deseables', $oferta->requisitos_deseables) }}</textarea>

                </div>

            </div>

            {{-- CONFIGURACION --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- MODALIDAD --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Modalidad
                    </label>

                    <select name="modalidad"
                            class="w-full bg-zinc-900 border border-zinc-700
                                   rounded-xl px-4 py-3 text-white
                                   focus:outline-none focus:border-blue-500">

                        <option value="Presencial"
                            {{ $oferta->modalidad == 'Presencial' ? 'selected' : '' }}>
                            Presencial
                        </option>

                        <option value="Remoto"
                            {{ $oferta->modalidad == 'Remoto' ? 'selected' : '' }}>
                            Remoto
                        </option>

                        <option value="Híbrido"
                            {{ $oferta->modalidad == 'Híbrido' ? 'selected' : '' }}>
                            Híbrido
                        </option>

                    </select>

                </div>

                {{-- TIPO EMPLEO --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Tipo empleo
                    </label>

                    <select name="tipo_empleo"
                            class="w-full bg-zinc-900 border border-zinc-700
                                   rounded-xl px-4 py-3 text-white
                                   focus:outline-none focus:border-blue-500">

                        <option value="Tiempo completo"
                            {{ $oferta->tipo_empleo == 'Tiempo completo' ? 'selected' : '' }}>
                            Tiempo completo
                        </option>

                        <option value="Medio tiempo"
                            {{ $oferta->tipo_empleo == 'Medio tiempo' ? 'selected' : '' }}>
                            Medio tiempo
                        </option>

                        <option value="Freelance"
                            {{ $oferta->tipo_empleo == 'Freelance' ? 'selected' : '' }}>
                            Freelance
                        </option>

                    </select>

                </div>

                {{-- VACANTES --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Vacantes
                    </label>

                    <input type="number"
                           name="vacantes"
                           min="1"
                           value="{{ old('vacantes', $oferta->vacantes) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

                {{-- FECHA --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Fecha límite
                    </label>

                    <input type="date"
                           name="fecha_limite"
                           value="{{ old('fecha_limite', optional($oferta->fecha_limite)->format('Y-m-d')) }}"
                           class="w-full bg-zinc-900 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

            </div>

            {{-- BOTONES --}}
            <div class="flex flex-wrap gap-4 pt-2">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 transition
                               px-6 py-3 rounded-xl font-semibold">

                    <i class="bi bi-check-lg mr-1"></i>

                    Guardar cambios

                </button>

                <a href="{{ route('oferta.index') }}"
                   class="bg-zinc-800 hover:bg-zinc-700 transition
                          px-6 py-3 rounded-xl font-semibold">

                    Cancelar

                </a>

            </div>

        </form>

    </div>

</div>

@endsection