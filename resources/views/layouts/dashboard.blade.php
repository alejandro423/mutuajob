<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MutuaJob - Administrador</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body class="bg-black text-white min-h-screen flex">

    <!-- Sidebar -->
    <aside class="w-64 bg-zinc-950 border-r border-zinc-800 flex flex-col justify-between p-6">
        
        <!-- Parte superior -->
        <div>
            <h1 class="text-3xl font-bold mb-10">
                <span class="text-white">Mutua</span><span class="text-red-600">Job</span>
            </h1>

            <nav class="space-y-3">
    <a href="{{ url('/administrador/inicio') }}"
       class="flex items-center gap-3 bg-zinc-900 hover:bg-zinc-800 px-4 py-3 rounded-xl transition">
        <i class="bi bi-house-door text-lg"></i>
        Inicio
    </a>

    <a href="{{ url('/administrador/usuarios') }}"
       class="flex items-center gap-3 bg-zinc-900 hover:bg-zinc-800 px-4 py-3 rounded-xl transition">
        <i class="bi bi-people text-lg"></i>
        Usuarios
    </a>
    <a href="{{ url('/administrador/bitacora') }}"
   class="flex items-center gap-3 bg-zinc-900 hover:bg-zinc-800 px-4 py-3 rounded-xl transition">
    <i class="bi bi-journal-text text-lg"></i>
    Bitácora
</a>
</nav>
        </div>

        <!-- Parte inferior -->
        <div>
            <a href="{{ url('/cuenta') }}"
               class="flex items-center gap-3 bg-red-600 hover:bg-red-700 px-4 py-3 rounded-xl transition">
                <i class="bi bi-arrow-left text-lg"></i>
                Volver
            </a>
        </div>
    </aside>

    <!-- Contenido -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>

</body>
</html>