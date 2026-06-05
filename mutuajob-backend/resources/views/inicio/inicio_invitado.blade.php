@extends('layouts.app')

@section('content')
<p class="text-zinc-400 text-lg">
    Bienvenido, {{ Auth::user()->name  ?? 'estas con cuenta de invitado' }}
</p>
    <div class="min-h-[calc(100vh-96px)] flex flex-col items-center justify-center px-6 text-center">
        <h1 class="text-4xl font-bold mb-3">
            <span class="text-white">Mutua</span><span class="text-red-600">Job</span>
        </h1>
        <p class="text-zinc-400 text-lg">Inicio</p>
    </div>
@endsection