@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 rounded-2xl p-6 shadow-xl">

        <h1 class="text-xl font-bold mb-6">
            Editar Habilidad del Perfil
        </h1>

        <form method="POST" action="{{ route('perfil_habilidad.update', $habilidad->id) }}" class="space-y-4">
            @csrf
            @method('PUT')

            {{-- Nombre (solo lectura) --}}
            <div>
                <label class="text-sm text-zinc-400">Habilidad</label>

                <input type="text"
                       value="{{ $habilidad->nombre }}"
                       disabled
                       class="w-full mt-1 p-2 bg-zinc-800 border border-zinc-700 rounded-lg text-zinc-400">
            </div>

            {{-- Nivel --}}
            <div>
                <label class="text-sm text-zinc-400">Nivel (1 - 5)</label>

                <input type="range"
                       name="nivel"
                       min="1"
                       max="5"
                       value="{{ $habilidad->pivot->nivel ?? 1 }}"
                       class="w-full mt-2 accent-red-600"
                       oninput="document.getElementById('nivel_val').innerText = this.value">

                <div class="text-center mt-2 text-sm text-zinc-300">
                    Nivel: <span id="nivel_val">{{ $habilidad->pivot->nivel ?? 1 }}</span> / 5
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-yellow-600 hover:bg-yellow-700 py-2 rounded-lg font-semibold">
                Actualizar
            </button>

        </form>

    </div>

</div>
@endsection