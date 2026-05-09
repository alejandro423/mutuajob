@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-zinc-950 text-white flex items-center justify-center px-4">

    <div class="w-full max-w-md bg-zinc-900 border border-zinc-800 rounded-2xl p-6">

        <h1 class="text-xl font-bold mb-6">Agregar Idioma al Perfil</h1>

        <form method="POST" action="{{ route('perfil_idioma.store') }}" class="space-y-4">
            @csrf

            {{-- Idioma --}}
            <div>
                <label class="text-sm text-zinc-400">Idioma</label>

                <select name="idioma_id"
                        class="w-full mt-1 p-2 bg-zinc-800 border border-zinc-700 rounded-lg">

                    @foreach($idiomas as $idioma)
                        <option value="{{ $idioma->id }}">
                            {{ $idioma->nombre }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Nivel --}}
            <div>
                <label class="text-sm text-zinc-400">Nivel de idioma</label>

                <input type="range"
                       name="nivel"
                       min="1"
                       max="5"
                       value="3"
                       class="w-full mt-2 accent-blue-600"
                       oninput="document.getElementById('nivel_val').innerText = this.value">

                <div class="text-center mt-2 text-sm text-zinc-300">
                    Nivel: <span id="nivel_val">3</span> / 5
                </div>
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 py-2 rounded-lg font-semibold">
                Guardar
            </button>

        </form>

    </div>

</div>
@endsection