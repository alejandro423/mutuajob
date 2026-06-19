@extends('layouts.app')

@section('content')

<div class="min-h-[calc(100vh-96px)] flex items-center justify-center px-6">

```
<div class="w-full max-w-md bg-zinc-950 border border-zinc-800 rounded-3xl p-8 shadow-2xl">

    <div class="text-center mb-8">
        <h1 class="text-3xl font-bold text-white mb-2">
            Activar 2FA
        </h1>
        <p class="text-zinc-400 text-sm">
            Protege tu cuenta con autenticación de dos factores
        </p>
    </div>

    @if ($errors->any())
        <div class="mb-4 bg-red-900/30 border border-red-700 text-red-400 text-sm rounded-xl p-3">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="flex justify-center mb-6 bg-white p-4 rounded-2xl">
        {!! $qr !!}
    </div>

    <div class="mb-6">
        <p class="text-zinc-300 text-sm mb-2">
            Código manual de respaldo:
        </p>

        <div class="bg-zinc-900 border border-zinc-700 rounded-xl p-3 text-center">
            <code class="text-red-400 break-all">
                {{ $secret }}
            </code>
        </div>
    </div>

    <form method="POST" action="{{ url('/2fa/confirm') }}" class="space-y-5">
        @csrf

        <div>
            <label class="block text-sm text-zinc-300 mb-2">
                Código de Google Authenticator
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
            Activar 2FA
        </button>
    </form>

    <div class="mt-6 text-center">
        <p class="text-zinc-500 text-sm">
            Escanea el código QR con Google Authenticator y luego introduce el código de 6 dígitos generado por la aplicación.
        </p>
    </div>

</div>
```

</div>
@endsection
