@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-6">

    <h1 class="text-3xl font-bold text-white mb-6">
        Mis Solicitudes
    </h1>

    @forelse($solicitudes as $solicitud)

<div class="bg-zinc-900 border border-zinc-800 rounded-xl p-5 mb-4">

    <h2 class="text-xl font-bold text-white">
        {{ $solicitud->perfil->nombre }}
        {{ $solicitud->perfil->apellido }}
    </h2>

    <p class="text-zinc-400">
        Oferta:
        {{ $solicitud->oferta->titulo }}
    </p>

    <p class="text-zinc-400">
        Profesión:
        {{ $solicitud->perfil->profesion }}
    </p>

    <p class="text-zinc-400">
        Ubicación:
        {{ $solicitud->perfil->ubicacion }}
    </p>

    <p class="text-zinc-400">
        Estado:
        {{ ucfirst($solicitud->estado) }}
    </p>
    <form method="POST" action="{{ route('solicitud.estado', $solicitud->id) }}">
    @csrf

    <button name="estado" value="aceptada"
        class="bg-green-600 px-3 py-1 rounded">
        Aceptar
    </button>

    <button name="estado" value="rechazada"
        class="bg-red-600 px-3 py-1 rounded">
        Rechazar
    </button>
</form>

</div>

@empty

<div class="bg-zinc-900 border border-zinc-800 rounded-xl p-6 text-center">

    <p class="text-zinc-400">
        No tienes solicitudes.
    </p>

</div>

@endforelse

</div>

@endsection