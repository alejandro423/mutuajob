@extends('layouts.app')

@section('content') <div class="min-h-[calc(100vh-96px)] flex items-center justify-center px-6"> <div class="w-full max-w-md bg-zinc-950 border border-zinc-800 rounded-3xl p-8 shadow-2xl">

```
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-white mb-2">
                Verificación 2FA
            </h1>
            <p class="text-zinc-400 text-sm">
                Ingresa el código generado por Google Authenticator
            </p>
        </div>

        @if ($errors->any())
            <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 text-sm rounded-xl p-3">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ url('/2fa/verify') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-sm text-zinc-300 mb-2">
                    Código de autenticación
                </label>

                <input
                    type="text"
                    name="code"
                    maxlength="6"
                    placeholder="Ej: 123456"
                    class="w-full bg-zinc-900 border border-zinc-700 text-white px-4 py-3 rounded-xl outline-none focus:border-red-600 text-center tracking-[0.3em] text-lg"
                    required
                >
            </div>

            <button
                type="submit"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-xl transition"
            >
                Verificar código
            </button>
        </form>

        <div class="mt-6 text-center">
            <p class="text-zinc-500 text-sm">
                Abre Google Authenticator y escribe el código de 6 dígitos que aparece para tu cuenta.
            </p>
        </div>

    </div>
</div>
```

@endsection
