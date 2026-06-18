@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-4 py-6 flex flex-col h-[calc(100vh-96px)]">

    {{-- HEADER --}}
    <div class="border-b border-zinc-800 pb-4 mb-4">
        <h2 class="text-xl font-bold text-white">
            Chat con {{ $otherUser->name }}
        </h2>
    </div>

    {{-- MENSAJES --}}
<div class="flex-1 overflow-y-auto space-y-3 px-2">

    @forelse($conversation->messages as $message)

        <div class="flex {{ $message->sender_id == auth()->id() ? 'justify-end' : 'justify-start' }}">

            <div class="
                max-w-[60%] sm:max-w-[75%] md:max-w-[45%]
                px-3 py-2 rounded-2xl text-sm break-words
                leading-relaxed shadow-sm
                {{ $message->sender_id == auth()->id()
                    ? 'bg-blue-600 text-white rounded-br-sm'
                    : 'bg-zinc-800 text-white rounded-bl-sm' }}
            ">

                {{-- NOMBRE --}}
                @if($message->sender_id != auth()->id())
                    <p class="text-[11px] opacity-70 mb-1">
                        {{ $message->sender->name }}
                    </p>
                @endif

                {{-- MENSAJE --}}
                <p class="whitespace-pre-wrap break-words">
                    {{ $message->message }}
                </p>

                {{-- HORA --}}
                <span class="text-[10px] opacity-60 block mt-1 text-right">
                    {{ $message->created_at->format('H:i') }}
                </span>

            </div>

        </div>

    @empty

        <p class="text-zinc-500 text-center">
            No hay mensajes todavía
        </p>

    @endforelse

</div>

    {{-- INPUT --}}
    <form action="{{ route('chat.send', $conversation->id) }}"
          method="POST"
          class="mt-4 flex gap-2">

        @csrf

        <input type="text"
               name="message"
               class="flex-1 bg-zinc-900 border border-zinc-700 rounded-xl px-4 py-3 text-white"
               placeholder="Escribe un mensaje..."
               required>

        <button class="bg-blue-600 hover:bg-blue-700 px-5 rounded-xl">
            Enviar
        </button>

    </form>

</div>

@endsection