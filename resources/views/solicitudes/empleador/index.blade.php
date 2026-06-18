@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-6">

    <h1 class="text-3xl font-bold text-white mb-2">
        Postulaciones recibidas
    </h1>

    <p class="text-zinc-400 mb-6">
        Trabajadores que se postularon a tus ofertas.
    </p>

    @forelse($solicitudes as $solicitud)

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 mb-4">

            <div class="flex flex-col md:flex-row md:justify-between gap-4">

                <div class="flex-1 min-w-0">

                    <h2 class="text-xl font-bold text-white break-words">
                        {{ $solicitud->perfil->nombre }}
                        {{ $solicitud->perfil->apellido }}
                    </h2>

                    <div class="mt-3 space-y-2 text-sm text-zinc-400">

                        <p class="break-words">
                            <i class="bi bi-briefcase mr-2"></i>
                            {{ $solicitud->perfil->profesion ?? 'Profesión no especificada' }}
                        </p>

                        <p class="break-words">
                            <i class="bi bi-geo-alt mr-2"></i>
                            {{ $solicitud->perfil->ubicacion ?? 'Ubicación no registrada' }}
                        </p>

                        <p class="break-words">
                            <i class="bi bi-file-earmark-text mr-2"></i>
                            {{ $solicitud->oferta->titulo }}
                        </p>

                        <p>
                            <i class="bi bi-info-circle mr-2"></i>

                            Estado:

                            @if($solicitud->estado == 'aceptada')

                                <span class="text-green-400 font-semibold">
                                    Aceptada
                                </span>

                            @elseif($solicitud->estado == 'rechazada')

                                <span class="text-red-400 font-semibold">
                                    Rechazada
                                </span>

                            @else

                                <span class="text-yellow-400 font-semibold">
                                    Pendiente
                                </span>

                            @endif

                        </p>

                    </div>

                </div>

            </div>

            <div class="flex flex-col md:flex-row gap-3 mt-6">

                <a href="{{ route('perfil.show', $solicitud->perfil->id) }}"
                   class="flex-1 py-3 bg-zinc-700 hover:bg-zinc-600 rounded-xl text-center transition">

                    Ver perfil

                </a>

                @if($solicitud->estado == 'pendiente')

                    <form action="{{ route('solicitudes.estado', $solicitud->id) }}"
                          method="POST"
                          class="flex-1">

                        @csrf

                        <button type="submit"
                                name="estado"
                                value="aceptada"
                                class="w-full py-3 bg-green-600 hover:bg-green-700 rounded-xl transition">

                            Aceptar

                        </button>

                    </form>

                    <form action="{{ route('solicitudes.estado', $solicitud->id) }}"
                          method="POST"
                          class="flex-1">

                        @csrf

                        <button type="submit"
                                name="estado"
                                value="rechazada"
                                class="w-full py-3 bg-red-600 hover:bg-red-700 rounded-xl transition">

                            Rechazar

                        </button>

                    </form>

                @endif

            </div>

        </div>

    @empty

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8 text-center">

            <i class="bi bi-person-workspace text-5xl text-zinc-600"></i>

            <h2 class="text-2xl font-bold mt-4">
                No hay postulaciones
            </h2>

            <p class="text-zinc-400 mt-2">
                Aún no has recibido postulaciones en tus ofertas.
            </p>

        </div>

    @endforelse

</div>

@endsection