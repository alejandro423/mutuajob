@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-zinc-900 text-white py-10 px-6">

    <div class="max-w-3xl mx-auto bg-zinc-950 border border-zinc-800 rounded-2xl p-8 shadow-xl">

        <div class="mb-8">

            <h1 class="text-3xl font-bold mb-2">
                Agregar Certificación
            </h1>

            <p class="text-zinc-400">
                Añade una nueva certificación a tu perfil profesional.
            </p>

        </div>

        {{-- ERRORES --}}
        @if ($errors->any())

            <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 rounded-xl p-4">

                <ul class="space-y-1 text-sm">

                    @foreach ($errors->all() as $error)

                        <li>• {{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            action="{{ route('perfil.certificacion_store') }}"
            method="POST"
            enctype="multipart/form-data"
            class="space-y-6"
        >

            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                {{-- NOMBRE --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Nombre de la certificación
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ej: AWS Cloud Practitioner"
                        class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                    >

                </div>

                {{-- INSTITUCION --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Institución
                    </label>

                    <input
                        type="text"
                        name="institucion"
                        value="{{ old('institucion') }}"
                        placeholder="Ej: Amazon"
                        class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                    >

                </div>

                {{-- FECHA OBTENCION --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Fecha de obtención
                    </label>

                    <input
                        type="date"
                        name="fecha_obtencion"
                        value="{{ old('fecha_obtencion') }}"
                        class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white focus:outline-none focus:ring-2 focus:ring-red-600"
                    >

                </div>

                {{-- FECHA EXPIRACION --}}
                <div>

                    <label class="block mb-2 text-sm font-semibold">
                        Fecha de expiración
                    </label>

                    <input
                        type="date"
                        name="fecha_expiracion"
                        value="{{ old('fecha_expiracion') }}"
                        class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 text-white focus:outline-none focus:ring-2 focus:ring-red-600"
                    >

                    <p class="text-xs text-zinc-500 mt-2">
                        Déjalo vacío si no expira
                    </p>

                </div>

            </div>

            {{-- DESCRIPCION --}}
            <div>

                <label class="block mb-2 text-sm font-semibold">
                    Descripción
                </label>

                <textarea
                    name="descripcion"
                    rows="5"
                    placeholder="Describe brevemente esta certificación..."
                    class="w-full px-4 py-3 rounded-xl bg-zinc-800 border border-zinc-700 focus:outline-none focus:ring-2 focus:ring-red-600"
                >{{ old('descripcion') }}</textarea>

            </div>

            {{-- EVIDENCIA --}}
            <div>

                <label class="block mb-2 text-sm font-semibold">
                    Evidencia / Certificado
                </label>

                <input
        type="file"
        name="evidencia"
        accept="image/*"
        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-zinc-400 file:bg-red-600 file:border-0 file:text-white file:px-4 file:py-2 file:rounded-lg"
    >

                <p class="text-xs text-zinc-500 mt-2">
                    Formatos permitidos: JPG, PNG, WEBP y PDF
                </p>

            </div>

            {{-- BOTONES --}}
            <div class="flex items-center gap-4 pt-4">

                <button
                    type="submit"
                    class="px-6 py-3 bg-red-600 hover:bg-red-700 rounded-xl font-semibold transition"
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