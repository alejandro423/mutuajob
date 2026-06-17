@extends('layouts.dashboard')

@section('content')

<div class="max-w-2xl mx-auto">

    <div class="mb-6">

        <h1 class="text-3xl font-bold text-white">
            Editar Habilidad
        </h1>

        <p class="text-zinc-400 text-sm">
            Modificar una habilidad existente
        </p>

    </div>

    {{-- ERRORES --}}
    @if ($errors->any())

        <div class="mb-4 bg-red-600/20 border border-red-600 text-red-400 px-4 py-3 rounded-xl">

            <ul class="list-disc list-inside">

                @foreach ($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif

    {{-- FORMULARIO --}}
    <div class="bg-zinc-950 border border-zinc-800 rounded-2xl p-6">

        <form action="{{ route('administrador.habilidades.update', $habilidad->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="mb-6">

                <label class="block text-sm text-zinc-300 mb-2">
                    Nombre de la habilidad
                </label>

                <input
                    type="text"
                    name="nombre"
                    value="{{ old('nombre', $habilidad->nombre) }}"
                    class="w-full bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-yellow-500"
                    required
                >

            </div>

            <div class="flex gap-3">

                <a href="{{ route('administrador.habilidades.index') }}"
                   class="flex-1 text-center bg-zinc-700 hover:bg-zinc-600 py-3 rounded-xl transition">

                    Cancelar

                </a>

                <button
                    type="submit"
                    class="flex-1 bg-yellow-600 hover:bg-yellow-700 py-3 rounded-xl font-medium transition">

                    Actualizar habilidad

                </button>

            </div>

        </form>

    </div>

</div>

@endsection