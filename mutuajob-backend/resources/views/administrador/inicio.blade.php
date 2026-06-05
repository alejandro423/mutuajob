@extends('layouts.dashboard')

@section('content')
<div class="min-h-[calc(100vh-96px)] flex items-center justify-center">
    <h1 class="text-3xl font-bold text-white">
        Panel Administrador, bienvenido {{ auth()->user()->name }}!
    </h1>
</div>
<div class="text-sm text-zinc-400">
    Backend v{{ config('version.backend_version') }}
</div>
@endsection