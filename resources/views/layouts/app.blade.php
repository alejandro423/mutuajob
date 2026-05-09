<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MutuaJob</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-black text-white min-h-screen flex flex-col justify-between">

    <!-- Contenido -->
    <main class="flex-1 pb-24">
        @yield('content')
    </main>

    <!-- Barra inferior -->
    <nav class="fixed bottom-0 left-0 w-full bg-zinc-950 border-t border-zinc-800">
        <div class="max-w-md mx-auto flex justify-around items-center py-3 relative">

            <a href="{{ url('/inicio') }}" class="flex flex-col items-center text-white text-xs">
                <i class="bi bi-house-door-fill text-xl mb-1"></i>
                Inicio
            </a>

            <a href="#" class="flex flex-col items-center text-zinc-400 text-xs">
                <i class="bi bi-heart text-xl mb-1"></i>
                Favoritos
            </a>

            <div class="flex flex-col items-center">

    <a href="{{ url('/perfil') }}" class="flex flex-col items-center">

    @php($user = Auth::user())

@if($user && $user->roles->contains('nombre', 'trabajador'))

    <!-- TRABAJADOR: PERFIL -->
    <a href="{{ url('/perfil') }}" class="flex flex-col items-center">

        <div class="relative -mt-8 bg-red-600 hover:bg-red-700 w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg shadow-red-900/40 transition">
            <i class="bi bi-file-earmark-text text-2xl text-white"></i>
        </div>

        <span class="text-xs mt-1 text-gray-600 font-medium">
            Perfil
        </span>

    </a>

@elseif($user && $user->roles->contains('nombre', 'empleador'))

    <!-- EMPLEADOR: OFERTAS -->
    <a href="{{ url('/ofertas') }}" class="flex flex-col items-center">

        <div class="relative -mt-8 bg-blue-600 hover:bg-blue-700 w-14 h-14 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-900/40 transition">
            <i class="bi bi-briefcase text-2xl text-white"></i>
        </div>

        <span class="text-xs mt-1 text-gray-600 font-medium">
            Ofertas
        </span>

    </a>

@endif

</a>

</div>

            <a href="#" class="flex flex-col items-center text-zinc-400 text-xs">
                <i class="bi bi-bell text-xl mb-1"></i>
                Avisos
            </a>

            @if (Auth::check())
    <a href="{{ url('/cuenta') }}" class="flex flex-col items-center text-zinc-400 text-xs">
        <i class="bi bi-person text-xl mb-1"></i>
        Cuenta
    </a>
@else
    <a href="{{ url('/login') }}" class="flex flex-col items-center text-zinc-400 text-xs">
        <i class="bi bi-person text-xl mb-1"></i>
        Iniciar sesión
    </a>
@endif
        </div>
    </nav>

</body>
</html>