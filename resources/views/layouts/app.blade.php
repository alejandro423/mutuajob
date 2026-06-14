<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MutuaJob</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="bg-black text-white min-h-screen flex flex-col justify-between">

    {{-- CONTENIDO --}}
    <main class="flex-1 pb-32">
        <style>

input[type="date"]::-webkit-calendar-picker-indicator {

    filter: invert(1);

    cursor: pointer;

}

</style>

        {{-- ALERTAS --}}
        <div class="max-w-4xl mx-auto px-4 pt-4">

            @if(session('success'))

                <div class="bg-green-600 text-white px-4 py-3 rounded-xl mb-4">
                    {{ session('success') }}
                </div>

            @endif

            @if(session('error'))

                <div class="bg-red-600 text-white px-4 py-3 rounded-xl mb-4">
                    {{ session('error') }}
                </div>

            @endif

        </div>

        @yield('content')

    </main>

    {{-- BARRA INFERIOR --}}
    <nav class="fixed bottom-0 left-0 w-full bg-zinc-950 border-t border-zinc-800">

        <div class="max-w-md mx-auto flex justify-around items-center py-3 relative">

            {{-- INICIO --}}
            <a href="{{ url('/inicio') }}"
               class="flex flex-col items-center text-xs transition
               {{ request()->is('inicio') ? 'text-white' : 'text-zinc-400' }}">

                <i class="bi bi-house-door-fill text-xl mb-1"></i>

                Inicio

            </a>

            {{-- FAVORITOS --}}
            <a href="{{ url('/favoritos') }}"
               class="flex flex-col items-center text-xs transition
               {{ request()->is('favoritos') ? 'text-white' : 'text-zinc-400' }}">

                <i class="bi bi-heart text-xl mb-1"></i>

                Favoritos

            </a>

            {{-- BOTON CENTRAL --}}
<div class="flex flex-col items-center">

    @php($user = Auth::user())

    {{-- ADMIN --}}
    @if($user && $user->roles->contains('nombre', 'administrador'))

        <a href="{{ url('/administrador/inicio') }}"
           class="flex flex-col items-center">

            <div class="relative -mt-8
                {{ request()->is('administrador/*') 
                    ? 'bg-red-600 shadow-lg shadow-red-900/40' 
                    : 'bg-zinc-800' }}
                hover:bg-red-700
                w-14 h-14 rounded-2xl flex items-center justify-center transition">

                <i class="bi bi-shield-lock text-2xl text-white"></i>
            </div>

            <span class="text-xs mt-1 font-medium
                {{ request()->is('administrador/*') ? 'text-white' : 'text-zinc-400' }}">

                Admin

            </span>

        </a>

    {{-- TRABAJADOR --}}
    @elseif($user && $user->roles->contains('nombre', 'trabajador'))

        <a href="{{ url('/perfil') }}"
           class="flex flex-col items-center">

            <div class="relative -mt-8
                {{ request()->is('perfil') 
                    ? 'bg-red-600 shadow-lg shadow-red-900/40' 
                    : 'bg-zinc-800' }}
                hover:bg-red-700
                w-14 h-14 rounded-2xl flex items-center justify-center transition">

                <i class="bi bi-file-earmark-text text-2xl text-white"></i>
            </div>

            <span class="text-xs mt-1 font-medium
                {{ request()->is('perfil') ? 'text-white' : 'text-zinc-400' }}">

                Perfil

            </span>

        </a>

    {{-- EMPLEADOR --}}
    @elseif($user && $user->roles->contains('nombre', 'empleador'))

        <a href="{{ url('/oferta') }}"
           class="flex flex-col items-center">

            <div class="relative -mt-8
                {{ request()->is('ofertas') 
                    ? 'bg-blue-600 shadow-lg shadow-blue-900/40' 
                    : 'bg-zinc-800' }}
                hover:bg-blue-700
                w-14 h-14 rounded-2xl flex items-center justify-center transition">

                <i class="bi bi-briefcase text-2xl text-white"></i>
            </div>

            <span class="text-xs mt-1 font-medium
                {{ request()->is('oferta') ? 'text-white' : 'text-zinc-400' }}">

                Ofertas

            </span>

        </a>

    @endif

</div>

            {{-- SOLICITUDES --}}
            <a href="{{ route('solicitudes.index') }}"
   class="flex flex-col items-center text-xs transition
   {{ request()->is('solicitudes*') ? 'text-white' : 'text-zinc-400' }}">

    <i class="bi bi-bell text-xl mb-1"></i>

    Avisos

</a>
            {{-- CUENTA --}}
            @if(Auth::check())

                <a href="{{ url('/cuenta') }}"
                   class="flex flex-col items-center text-xs transition
                   {{ request()->is('cuenta') ? 'text-white' : 'text-zinc-400' }}">

                    <i class="bi bi-person text-xl mb-1"></i>

                    Cuenta

                </a>

            @else

                <a href="{{ url('/login') }}"
                   class="flex flex-col items-center text-xs transition
                   {{ request()->is('login') ? 'text-white' : 'text-zinc-400' }}">

                    <i class="bi bi-person text-xl mb-1"></i>

                    Iniciar sesión

                </a>

            @endif

        </div>

    </nav>
    @if(app()->environment('local'))
    <div class="fixed top-2 right-3 text-xs text-zinc-200 bg-zinc-950/80 px-3 py-1 rounded-md border border-zinc-800 backdrop-blur">

        MutuaJob v{{ config('version.version') }} | DEV

    </div>
@endif
</body>
</html>