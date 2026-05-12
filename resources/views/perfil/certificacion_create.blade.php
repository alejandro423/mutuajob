@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-zinc-900 text-white py-10 px-6">

    <div class="max-w-2xl mx-auto bg-zinc-950 border border-zinc-800 rounded-2xl p-8 shadow-xl">

        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">
                Agregar Certificación
            </h1>

            <p class="text-zinc-400">
                Añade una nueva certificación a tu perfil profesional.
            </p>
        </div>

        <form action="{{ route('perfil.certificacion_store') }}" method="POST" class="space-y-6">

            @csrf

            {{-- Nombre --}}
            <div>
                <label class="block mb-2 text-sm font-semibold">
                    Nombre de la certificación
                </label>

                <input
                    type="text"
                    name="nombre"
                    value="{{ old('nombre') }}"
                    placeholder="Ej: AWS Cloud Practitioner"
                    class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 focus:outline-none focus:ring-2 focus:ring-purple-600"
                >

                @error('nombre')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Institución --}}
            <div>
                <label class="block mb-2 text-sm font-semibold">
                    Institución
                </label>

                <input
                    type="text"
                    name="institucion"
                    value="{{ old('institucion') }}"
                    placeholder="Ej: Amazon"
                    class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 focus:outline-none focus:ring-2 focus:ring-purple-600"
                >

                @error('institucion')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Descripción --}}
            <div>
                <label class="block mb-2 text-sm font-semibold">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    rows="5"
                    placeholder="Describe brevemente esta certificación..."
                    class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 focus:outline-none focus:ring-2 focus:ring-purple-600"
                >{{ old('descripcion') }}</textarea>

                @error('descripcion')
                    <p class="text-red-500 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Botones --}}
            <div class="flex items-center gap-4 pt-4">

                <button
                    type="submit"
                    class="px-6 py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold transition"
                >
                    Guardar Certificación
                </button>

                <a
                    href="{{ route('perfil.index') }}"
                    class="px-6 py-3 bg-zinc-800 hover:bg-zinc-700 rounded-xl font-semibold transition"
                >
                    Cancelar
                </a>

            </div>

        </form>

    </div>

</div>

@endsection