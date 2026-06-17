@extends('layouts.dashboard')

@section('content')

<div class="min-h-screen bg-zinc-950 text-white px-4 py-6">

    <div class="max-w-2xl mx-auto">

        {{-- HEADER --}}
        <div class="mb-8">

            <h1 class="text-3xl font-bold">
                Nuevo idioma
            </h1>

            <p class="text-zinc-400 mt-1">
                Registra un nuevo idioma en el catálogo
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
        <div class="bg-zinc-900 border border-zinc-800
                    rounded-2xl p-6">

            <form action="{{ route('administrador.idiomas.store') }}"
                  method="POST"
                  class="space-y-6">

                @csrf

                {{-- NOMBRE --}}
                <div>

                    <label class="block text-sm font-medium mb-2">
                        Nombre del idioma
                    </label>

                    <input type="text"
                           name="nombre"
                           value="{{ old('nombre') }}"
                           placeholder="Ej: Inglés"
                           class="w-full bg-zinc-950 border border-zinc-700
                                  rounded-xl px-4 py-3 text-white
                                  focus:outline-none focus:border-blue-500">

                </div>

                {{-- BOTONES --}}
                <div class="flex flex-wrap gap-4 pt-2">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 transition
                                   px-6 py-3 rounded-xl font-semibold">

                        <i class="bi bi-plus-lg mr-1"></i>

                        Crear idioma

                    </button>

                    <a href="{{ route('administrador.idiomas.index') }}"
                       class="bg-zinc-800 hover:bg-zinc-700 transition
                              px-6 py-3 rounded-xl font-semibold">

                        Cancelar

                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection