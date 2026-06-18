@extends('layouts.app')

@section('content')

<div class="max-w-4xl mx-auto px-4 py-6">

    {{-- HEADER --}}
    <div class="mb-8">

        <h1 class="text-3xl font-bold text-white">
            Crear oferta laboral
        </h1>

        <p class="text-zinc-400 mt-2">
            Publica una nueva oportunidad de trabajo en MutuaJob
        </p>

    </div>

    {{-- ERRORES --}}
    @if($errors->any())

        <div class="bg-red-600/20 border border-red-500 text-red-300
                    rounded-2xl p-4 mb-6">

            <ul class="space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        • {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- FORMULARIO --}}
    <form action="{{ route('oferta.store') }}"
          method="POST"
          class="space-y-6">

        @csrf

        {{-- TITULO --}}
        <div>

            <label class="block text-sm font-medium mb-2">
                Título de la oferta
            </label>

            <input type="text"
                   name="titulo"
                   value="{{ old('titulo') }}"
                   placeholder="Ej: Desarrollador Laravel Senior"
                   class="w-full bg-zinc-900 border border-zinc-700
                          rounded-xl px-4 py-3 text-white
                          focus:outline-none focus:border-blue-500">

        </div>

        {{-- DESCRIPCION --}}
        <div>

            <label class="block text-sm font-medium mb-2">
                Descripción
            </label>

            <textarea name="descripcion"
                      rows="6"
                      placeholder="Describe la oferta laboral..."
                      class="w-full bg-zinc-900 border border-zinc-700
                             rounded-xl px-4 py-3 text-white
                             focus:outline-none focus:border-blue-500">{{ old('descripcion') }}</textarea>

        </div>

        {{-- GRID --}}
        <div class="grid md:grid-cols-2 gap-6">

            {{-- UBICACION --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Ubicación
                </label>

                <input type="text"
                       name="ubicacion"
                       value="{{ old('ubicacion') }}"
                       placeholder="Ej: La Paz, Bolivia"
                       class="w-full bg-zinc-900 border border-zinc-700
                              rounded-xl px-4 py-3 text-white
                              focus:outline-none focus:border-blue-500">

            </div>

            {{-- SALARIO --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Salario (Bs.)
                </label>

                <input type="number"
                  name="salario"
                 value="{{ old('salario') }}"
                  min="0"
                  step="0.1"
                 placeholder="Ej: 5000"
                 class="w-full bg-zinc-900 border border-zinc-700
              rounded-xl px-4 py-3 text-white
              focus:outline-none focus:border-blue-500">
            </div>

        </div>

        {{-- CONTACTO --}}
        <div class="grid md:grid-cols-2 gap-6">

            {{-- TELEFONO --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Número de contacto
                </label>

               <input type="tel"
       name="numero_contacto"
       value="{{ old('numero_contacto') }}"
       maxlength="20"
       pattern="[0-9+\-\s]+"
       placeholder="Ej: 77777777"
       class="w-full bg-zinc-900 border border-zinc-700
              rounded-xl px-4 py-3 text-white
              focus:outline-none focus:border-blue-500">
            </div>

            {{-- EMAIL --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Email de contacto
                </label>

                <input type="email"
                       name="email_contacto"
                       value="{{ old('email_contacto') }}"
                       placeholder="empresa@gmail.com"
                       class="w-full bg-zinc-900 border border-zinc-700
                              rounded-xl px-4 py-3 text-white
                              focus:outline-none focus:border-blue-500">

            </div>

        </div>

        {{-- REQUISITOS --}}
        <div class="space-y-6">

            {{-- INDISPENSABLES --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Requisitos indispensables
                </label>

                <textarea name="requisitos_indispensables"
                          rows="4"
                          placeholder="Ej: Experiencia en Laravel, MySQL..."
                          class="w-full bg-zinc-900 border border-zinc-700
                                 rounded-xl px-4 py-3 text-white
                                 focus:outline-none focus:border-blue-500">{{ old('requisitos_indispensables') }}</textarea>

            </div>

            {{-- DESEABLES --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Requisitos deseables
                </label>

                <textarea name="requisitos_deseables"
                          rows="4"
                          placeholder="Ej: Inglés avanzado, Docker..."
                          class="w-full bg-zinc-900 border border-zinc-700
                                 rounded-xl px-4 py-3 text-white
                                 focus:outline-none focus:border-blue-500">{{ old('requisitos_deseables') }}</textarea>

             </div>

                 </div>

        {{-- MODALIDAD --}}
        <div class="grid md:grid-cols-3 gap-6">

            {{-- MODALIDAD --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Modalidad
                </label>

                <select name="modalidad"
                        class="w-full bg-zinc-900 border border-zinc-700
                               rounded-xl px-4 py-3 text-white
                               focus:outline-none focus:border-blue-500">

                    <option value="">Seleccionar</option>

                    <option value="Presencial">Presencial</option>

                    <option value="Remoto">Remoto</option>

                    <option value="Híbrido">Híbrido</option>

                </select>

            </div>

            {{-- TIPO --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Tipo de empleo
                </label>

                <select name="tipo_empleo"
                        class="w-full bg-zinc-900 border border-zinc-700
                               rounded-xl px-4 py-3 text-white
                               focus:outline-none focus:border-blue-500">

                    <option value="">Seleccionar</option>

                    <option value="Tiempo completo">Tiempo completo</option>

                    <option value="Medio tiempo">Medio tiempo</option>

                    <option value="Freelance">Freelance</option>

                    <option value="Prácticas">Prácticas</option>

                </select>

            </div>

            {{-- VACANTES --}}
            <div>

                <label class="block text-sm font-medium mb-2">
                    Vacantes
                </label>

                <input type="number"
                 name="vacantes"
                 value="{{ old('vacantes') }}"
                 min="1"
                 max="100"
                  required
                 class="w-full bg-zinc-900 border border-zinc-700
              rounded-xl px-4 py-3 text-white
              focus:outline-none focus:border-blue-500">
                </div>

             </div>

        {{-- FECHA --}}
        <div>

            <label class="block text-sm font-medium mb-2">
                Fecha límite
            </label>

           <input type="date"
                 name="fecha_limite"
                 value="{{ old('fecha_limite') }}"
                  min="{{ date('Y-m-d') }}"
                  class="w-full bg-zinc-900 border border-zinc-700
              rounded-xl px-4 py-3 text-white
              focus:outline-none focus:border-blue-500">
        </div>

        {{-- BOTONES --}}
        <div class="flex items-center gap-4 pt-4">

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 transition
                           px-6 py-3 rounded-xl font-semibold">

                <i class="bi bi-check-lg mr-1"></i>

                Publicar oferta

            </button>

            <a href="{{ route('oferta.index') }}"
               class="bg-zinc-700 hover:bg-zinc-600 transition
                      px-6 py-3 rounded-xl font-semibold">

                Cancelar

            </a>

        </div>

    </form>

</div>

@endsection