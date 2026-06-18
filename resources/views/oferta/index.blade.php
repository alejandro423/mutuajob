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
<form method="GET" action="{{ route('oferta.index') }}"
      class="flex flex-col md:flex-row gap-3 mb-6">

    {{-- BUSCAR POR TITULO --}}
    <input type="text"
           name="search"
           value="{{ request('search') }}"
           placeholder="Buscar por título..."
           class="w-full md:w-1/2 px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700 text-white">

    {{-- FILTRO FECHA --}}
    <select name="date"
        class="w-full md:w-1/4 px-4 py-3 rounded-xl bg-zinc-900 border border-zinc-700 text-white">

    <option value="">Todo el tiempo</option>

    <option value="today" {{ request('date') == 'today' ? 'selected' : '' }}>
        Hoy
    </option>

    <option value="week" {{ request('date') == 'week' ? 'selected' : '' }}>
        Esta semana
    </option>

    <option value="month" {{ request('date') == 'month' ? 'selected' : '' }}>
        Este mes
    </option>

</select>

    <button class="bg-blue-600 px-6 py-3 rounded-xl font-semibold">
        Buscar
    </button>

</form>
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
                            @if($oferta->bloqueada)
    <span class="text-red-500 font-semibold">
        Bloqueada por administrador
    </span>

@elseif(!$oferta->estado)
    <span class="text-yellow-400 font-semibold">
        Cerrada
    </span>

@else
    <span class="text-green-400 font-semibold">
        Activa
    </span>
@endif

                        </div>

                        {{-- DESCRIPCION --}}
                        <div class="mt-5">

                            <p class="text-zinc-300 leading-relaxed break-words">
    {{ Str::limit($oferta->descripcion, 300) }}
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

@if($oferta->bloqueada)
    <div class="mb-4 p-3 rounded-lg bg-red-900 border border-red-600 text-red-200 text-sm">
        ⚠ Esta oferta fue bloqueada por el administrador y no puede modificarse.
    </div>
@endif     

<div class="flex flex-wrap gap-3 mt-6">

    {{-- EDITAR --}}
    @if(!$oferta->bloqueada)
        <a href="{{ route('oferta.edit', $oferta->id) }}"
           class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700
                  rounded-lg text-sm font-medium transition">

            <i class="bi bi-pencil-square mr-1"></i>
            Editar

        </a>
    @else
        <span class="px-4 py-2 bg-zinc-700 text-zinc-400 rounded-lg text-sm">
            Editar bloqueado
        </span>
    @endif


    {{-- ELIMINAR --}}
    @if(!$oferta->bloqueada)
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

        </form>
    @else
        <span class="px-4 py-2 bg-zinc-700 text-zinc-400 rounded-lg text-sm">
            Eliminación bloqueada
        </span>
    @endif


    {{-- PDF (SIEMPRE DISPONIBLE) --}}
    <a href="{{ route('oferta.pdf', $oferta->id) }}"
       class="px-4 py-2 bg-blue-600 hover:bg-blue-700
              rounded-lg text-sm font-medium transition">

        <i class="bi bi-file-earmark-pdf mr-1"></i>
        PDF

    </a>
{{-- ESTADO --}}
<div class="flex items-center justify-between mt-4">

    <div>
        <p class="text-sm text-zinc-400">
            Estado de la oferta
        </p>

        <p class="text-sm font-semibold">
            @if($oferta->estado)
                <span class="text-green-400">Activa</span>
            @else
                <span class="text-red-400">Cerrada</span>
            @endif
        </p>
    </div>

    <form action="{{ route('oferta.toggleEstado', $oferta->id) }}"
          method="POST">

        @csrf
        @method('PUT')

        <button type="submit"
                class="relative inline-flex h-7 w-14 items-center rounded-full transition
                {{ $oferta->estado ? 'bg-green-600' : 'bg-zinc-600' }}
                {{ $oferta->bloqueada ? 'opacity-50 cursor-not-allowed' : '' }}"
                {{ $oferta->bloqueada ? 'disabled' : '' }}>

            <span class="inline-block h-5 w-5 transform rounded-full bg-white transition
            {{ $oferta->estado ? 'translate-x-8' : 'translate-x-1' }}">
            </span>

        </button>

    </form>

</div>
</div>

                    </div>

                @endforeach
                
            {{-- VACIO --}}
@if($ofertas->isEmpty())

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
        @endif

    </div>

</div>

@endsection