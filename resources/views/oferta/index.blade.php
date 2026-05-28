@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-zinc-950 text-white px-4 py-6">

    <div class="max-w-6xl mx-auto">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">

            <div>
                <h1 class="text-3xl font-bold">
                    Mis ofertas laborales
                </h1>

                <p class="text-zinc-400 mt-2">
                    Administra todas tus publicaciones de trabajo
                </p>
            </div>

            <a href="{{ route('oferta.create') }}"
               class="bg-blue-600 hover:bg-blue-700 transition
                      px-5 py-3 rounded-xl font-semibold text-center">

                <i class="bi bi-plus-lg mr-1"></i>

                Nueva oferta

            </a>

        </div>

        {{-- LISTA --}}
        @if($ofertas->count())

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                @foreach($ofertas as $oferta)

                    <div class="bg-zinc-900 border border-zinc-800
                                rounded-2xl p-6 shadow-xl">

                        {{-- TITULO --}}
                        <div class="flex items-start justify-between gap-4">

                            <div>

                                <h2 class="text-xl font-bold">
                                    {{ $oferta->titulo }}
                                </h2>

                                <p class="text-zinc-400 text-sm mt-1">
                                    {{ $oferta->ubicacion ?? 'Sin ubicación' }}
                                </p>

                            </div>

                            {{-- ESTADO --}}
                            @if($oferta->estado == 1)

                                <span class="bg-green-600/20 text-green-400
                                             border border-green-600/30
                                             text-xs px-3 py-1 rounded-full">

                                    Activa

                                </span>

                            @else

                                <span class="bg-red-600/20 text-red-400
                                             border border-red-600/30
                                             text-xs px-3 py-1 rounded-full">

                                    Inactiva

                                </span>

                            @endif

                        </div>

                        {{-- DESCRIPCION --}}
                        <div class="mt-5">

                            <p class="text-zinc-300 leading-relaxed">
                                {{ Str::limit($oferta->descripcion, 150) }}
                            </p>

                        </div>

                        {{-- INFORMACION --}}
                        <div class="grid grid-cols-2 gap-4 mt-6">

                            <div class="bg-zinc-800 rounded-xl p-4">

                                <p class="text-zinc-400 text-sm">
                                    Modalidad
                                </p>

                                <p class="font-semibold mt-1">
                                    {{ $oferta->modalidad }}
                                </p>

                            </div>

                            <div class="bg-zinc-800 rounded-xl p-4">

                                <p class="text-zinc-400 text-sm">
                                    Tipo empleo
                                </p>

                                <p class="font-semibold mt-1">
                                    {{ $oferta->tipo_empleo }}
                                </p>

                            </div>

                            <div class="bg-zinc-800 rounded-xl p-4">

                                <p class="text-zinc-400 text-sm">
                                    Salario
                                </p>

                                <p class="font-semibold mt-1">
                                    {{ $oferta->salario ?? 'No definido' }}
                                </p>

                            </div>

                            <div class="bg-zinc-800 rounded-xl p-4">

                                <p class="text-zinc-400 text-sm">
                                    Vacantes
                                </p>

                                <p class="font-semibold mt-1">
                                    {{ $oferta->vacantes }}
                                </p>

                            </div>

                        </div>

                        {{-- BOTONES --}}
                        <div class="flex flex-wrap gap-3 mt-6">

                            {{-- EDITAR --}}
                            <a href="{{ route('oferta.edit', $oferta->id) }}"
                               class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700
                                      rounded-lg text-sm font-medium transition">

                                <i class="bi bi-pencil-square mr-1"></i>

                                Editar

                            </a>

                            {{-- ELIMINAR --}}
                            <form action="{{ route('oferta.destroy', $oferta->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('¿Eliminar esta oferta?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="px-4 py-2 bg-red-600 hover:bg-red-700
                                               rounded-lg text-sm font-medium transition">

                                    <i class="bi bi-trash mr-1"></i>

                                    Eliminar

                                </button>
                                {{-- PDF --}}
<a href="{{ route('oferta.pdf', $oferta->id) }}"
   class="px-4 py-2 bg-blue-600 hover:bg-blue-700
          rounded-lg text-sm font-medium transition">

    <i class="bi bi-file-earmark-pdf mr-1"></i>

    PDF

</a>

                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- VACIO --}}
            <div class="bg-zinc-900 border border-dashed border-zinc-700
                        rounded-2xl p-10 text-center">

                <i class="bi bi-briefcase text-5xl text-zinc-600"></i>

                <h2 class="text-2xl font-bold mt-4">
                    No tienes ofertas
                </h2>

                <p class="text-zinc-400 mt-2">
                    Publica tu primera oferta laboral en MutuaJob
                </p>

                <a href="{{ route('oferta.create') }}"
                   class="inline-block mt-6 px-6 py-3
                          bg-blue-600 hover:bg-blue-700
                          rounded-xl font-semibold transition">

                    Crear oferta

                </a>

            </div>

        @endif

    </div>

</div>

@endsection