@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-6">

    <h1 class="text-3xl font-bold text-white mb-2">
        Mis solicitudes
    </h1>

    <p class="text-zinc-400 mb-6">
        Invitaciones recibidas y postulaciones realizadas.
    </p>

    @forelse($solicitudes as $solicitud)

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 mb-4">

            <div class="flex flex-col gap-4">

                <div>

                    <h2 class="text-xl font-bold text-white break-words">
                        {{ $solicitud->oferta->titulo }}
                    </h2>

                    <div class="mt-3 space-y-2 text-sm text-zinc-400">

                        <p>
                            <i class="bi bi-tag mr-2"></i>

                            Tipo:

                            @if($solicitud->tipo === 'invitacion')

                                <span class="text-blue-400 font-semibold">
                                    Invitación
                                </span>

                            @else

                                <span class="text-purple-400 font-semibold">
                                    Postulación
                                </span>

                            @endif

                        </p>

                        <p>
                            <i class="bi bi-info-circle mr-2"></i>

                            Estado:

                            @if($solicitud->estado === 'aceptada')

                                <span class="text-green-400 font-semibold">
                                    Aceptada
                                </span>

                            @elseif($solicitud->estado === 'rechazada')

                                <span class="text-red-400 font-semibold">
                                    Rechazada
                                </span>

                            @else

                                <span class="text-yellow-400 font-semibold">
                                    Pendiente
                                </span>

                            @endif

                        </p>

                        @if($solicitud->oferta->ubicacion)

                            <p class="break-words">
                                <i class="bi bi-geo-alt mr-2"></i>
                                {{ $solicitud->oferta->ubicacion }}
                            </p>

                        @endif

                        @if($solicitud->oferta->modalidad)

                            <p>
                                <i class="bi bi-building mr-2"></i>
                                {{ $solicitud->oferta->modalidad }}
                            </p>

                        @endif

                        @if($solicitud->oferta->tipo_empleo)

                            <p>
                                <i class="bi bi-briefcase mr-2"></i>
                                {{ $solicitud->oferta->tipo_empleo }}
                            </p>

                        @endif

                    </div>

                </div>

                {{-- CAMBIAR ESTADO --}}
@if($solicitud->tipo === 'invitacion')

<div class="flex flex-col md:flex-row gap-3">

    <form action="{{ route('solicitudes.estado', $solicitud->id) }}"
          method="POST"
          class="flex-1">

        @csrf
        @method('PUT')

        <button type="submit"
                name="estado"
                value="aceptada"
                class="w-full py-3 rounded-xl transition
                {{ $solicitud->estado === 'aceptada'
                    ? 'bg-green-800 border border-green-500'
                    : 'bg-green-600 hover:bg-green-700' }}">

            <i class="bi bi-check-circle mr-2"></i>

            Aceptar invitación

        </button>

    </form>

    <form action="{{ route('solicitudes.estado', $solicitud->id) }}"
          method="POST"
          class="flex-1">

        @csrf
        @method('PUT')

        <button type="submit"
                name="estado"
                value="rechazada"
                class="w-full py-3 rounded-xl transition
                {{ $solicitud->estado === 'rechazada'
                    ? 'bg-red-800 border border-red-500'
                    : 'bg-red-600 hover:bg-red-700' }}">

            <i class="bi bi-x-circle mr-2"></i>

            Rechazar invitación

        </button>

    </form>

</div>

@endif

            </div>

        </div>

    @empty

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8 text-center">

            <i class="bi bi-inbox text-5xl text-zinc-600"></i>

            <h2 class="text-2xl font-bold mt-4">
                No tienes solicitudes
            </h2>

            <p class="text-zinc-400 mt-2">
                Cuando te postules o recibas invitaciones aparecerán aquí.
            </p>

        </div>

    @endforelse

</div>

@endsection