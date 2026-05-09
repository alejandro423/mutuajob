@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-zinc-950 px-6 py-10">

    <div class="max-w-2xl mx-auto bg-zinc-900 border border-zinc-800 rounded-3xl p-8 shadow-2xl">

        <div class="text-center mb-8">

            <div class="w-28 h-28 mx-auto rounded-full bg-zinc-800 border border-zinc-700 flex items-center justify-center mb-4">
                <i class="bi bi-person-fill text-5xl text-red-500"></i>
            </div>

            <h1 class="text-3xl font-bold text-white">
                Editar Perfil
            </h1>

            <p class="text-zinc-400 text-sm mt-2">
                Completa y actualiza tu información profesional
            </p>

        </div>

        @if ($errors->any())
            <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 rounded-xl p-4">
                <ul class="space-y-1 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>• {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('perfil.update', $perfil->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="space-y-5">

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Nombre
                    </label>

                    <input
                        type="text"
                        name="nombre"
                        value="{{ old('nombre', $perfil->nombre) }}"
                        placeholder="Ingresa tu nombre"
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-white outline-none focus:border-red-600"
                    >
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Apellido
                    </label>

                    <input
                        type="text"
                        name="apellido"
                        value="{{ old('apellido', $perfil->apellido) }}"
                        placeholder="Ingresa tu apellido"
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-white outline-none focus:border-red-600"
                    >
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Correo electrónico
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $perfil->email) }}"
                        placeholder="Ingresa tu correo"
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-white outline-none focus:border-red-600"
                    >
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Teléfono
                    </label>

                    <input
                        type="text"
                        name="telefono"
                        value="{{ old('telefono', $perfil->telefono) }}"
                        placeholder="Ingresa tu teléfono"
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-white outline-none focus:border-red-600"
                    >
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Ubicación
                    </label>

                    <input
                        type="text"
                        name="ubicacion"
                        value="{{ old('ubicacion', $perfil->ubicacion) }}"
                        placeholder="Ej: La Paz, Bolivia"
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-white outline-none focus:border-red-600"
                    >
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Resumen Profesional
                    </label>

                    <textarea
                        name="resumen_profesional"
                        rows="5"
                        placeholder="Cuéntanos sobre ti..."
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-white outline-none resize-none focus:border-red-600"
                    >{{ old('resumen_profesional', $perfil->resumen_profesional) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm text-zinc-300 mb-2">
                        Foto de perfil
                    </label>

                    <input
                        type="file"
                        name="foto"
                        class="w-full bg-zinc-950 border border-zinc-700 rounded-xl px-4 py-3 text-zinc-400 file:bg-red-600 file:border-0 file:text-white file:px-4 file:py-2 file:rounded-lg"
                    >
                </div>

                <div class="flex gap-4 pt-4">

                    <button
                        type="submit"
                        class="flex-1 bg-red-600 hover:bg-red-700 text-white py-3 rounded-xl font-semibold transition"
                    >
                        <i class="bi bi-check-circle me-2"></i>
                        Guardar cambios
                    </button>

                    <a
                        href="{{ route('perfil.index') }}"
                        class="flex-1 text-center bg-zinc-800 hover:bg-zinc-700 text-white py-3 rounded-xl font-semibold transition"
                    >
                        <i class="bi bi-arrow-left me-2"></i>
                        Volver
                    </a>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection