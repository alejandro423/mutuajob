@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto px-4 py-6">

    <h1 class="text-3xl font-bold text-white mb-6">
        Mis conversaciones
    </h1>

    @forelse($conversations as $conversation)

        @php
            $authId = auth()->id();

            $otherUser = $conversation->user_one_id == $authId
                ? $conversation->userTwo
                : $conversation->userOne;
        @endphp

        <a href="{{ route('chat.show', $conversation->id) }}"
           class="block bg-zinc-900 border border-zinc-800 rounded-xl p-4 mb-3 hover:bg-zinc-800 transition">

            <div class="flex items-center justify-between">

                {{-- INFO USUARIO --}}
                <div>

                    <h2 class="text-white font-semibold text-lg">
                        {{ $otherUser->name }}
                    </h2>

                    <p class="text-zinc-400 text-sm">
                        Última conversación activa
                    </p>

                </div>

                {{-- INDICADOR --}}
                <div class="text-zinc-500 text-sm">
                    ▶
                </div>

            </div>

        </a>

    @empty

        <div class="bg-zinc-900 border border-zinc-800 rounded-xl p-8 text-center">

            <i class="bi bi-chat-dots text-5xl text-zinc-600"></i>

            <h2 class="text-xl font-bold mt-4 text-white">
                No tienes conversaciones
            </h2>

            <p class="text-zinc-400 mt-2">
                Inicia un chat desde un perfil o una oferta.
            </p>

        </div>

    @endforelse

</div>

@endsection