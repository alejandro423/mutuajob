<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MutuaJob</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-br from-black via-zinc-900 to-red-950 flex items-center justify-center">

    <div class="text-center px-6">
        <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6">
            <span class="text-white">Bienvenido a</span><br>
            <span class="text-white">Mutua</span><span class="text-red-600">Job</span>
        </h1>
        <a href="{{ url('/inicio') }}"
           class="inline-block bg-red-600 hover:bg-red-700 text-white text-lg font-semibold px-10 py-4 rounded-2xl shadow-lg shadow-red-900/30 transition duration-300">
            Empezar
        </a>
    </div>

</body>
</html>