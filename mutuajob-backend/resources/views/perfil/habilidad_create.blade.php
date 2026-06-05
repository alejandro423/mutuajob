@extends('layouts.app')

@section('content')
@if(session('error'))

    <div class="bg-red-500 text-white px-4 py-3 rounded-lg mb-4">
        {{ session('error') }}
    </div>
@endif
@if(session('success'))

    <div class="bg-green-500 text-white px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>

@endif
<div class="min-h-screen bg-zinc-950 text-white flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

        <h1 class="text-xl font-bold mb-6">Agregar Habilidad al Perfil</h1>

        <form method="POST" action="{{ route('perfil_habilidad.store') }}" class="space-y-4">
            @csrf

            {{-- Habilidad --}}
            <div>
                <label class="text-sm text-zinc-400">Habilidad</label>
                <select name="habilidad_id"
                        class="w-full mt-1 p-2 bg-zinc-800 border border-zinc-700 rounded-lg">

                    @foreach($habilidades as $habilidad)
                        <option value="{{ $habilidad->id }}">
                            {{ $habilidad->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Nivel --}}
            <div>
    <label class="text-sm text-zinc-400">Nivel de habilidad</label>

    <input type="range"
           name="nivel"
           min="1"
           max="5"
           value="3"
           class="w-full mt-2 accent-red-600"
           oninput="document.getElementById('nivel_val').innerText = this.value">

    <div class="text-center mt-2 text-sm text-zinc-300">
        Nivel: <span id="nivel_val">3</span> / 5
    </div>
</div>

            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 py-2 rounded-lg font-semibold">
                Guardar
            </button>

        </form>

    </div>

</div>
@endsection