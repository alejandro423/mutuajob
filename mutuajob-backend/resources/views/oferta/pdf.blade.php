<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Oferta laboral</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            color: #222;
        }

        h1 {
            margin-bottom: 5px;
        }

        .subtitulo {
            color: #666;
            margin-bottom: 25px;
        }

        .bloque {
            margin-bottom: 20px;
        }

        .titulo {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .caja {
            background: #f3f3f3;
            padding: 10px;
            border-radius: 6px;
        }

    </style>

</head>
<body>

    <h1>{{ $oferta->titulo }}</h1>

    <p class="subtitulo">
        Oferta laboral publicada en MutuaJob
    </p>

    <div class="bloque">

        <div class="titulo">Descripción</div>

        <div class="caja">
            {{ $oferta->descripcion }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Ubicación</div>

        <div class="caja">
            {{ $oferta->ubicacion ?? 'No especificada' }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Modalidad</div>

        <div class="caja">
            {{ $oferta->modalidad }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Tipo de empleo</div>

        <div class="caja">
            {{ $oferta->tipo_empleo }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Vacantes</div>

        <div class="caja">
            {{ $oferta->vacantes }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Salario</div>

        <div class="caja">
            {{ $oferta->salario ?? 'No definido' }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Requisitos indispensables</div>

        <div class="caja">
            {{ $oferta->requisitos_indispensables ?? 'No especificados' }}
        </div>

    </div>

    <div class="bloque">

        <div class="titulo">Requisitos deseables</div>

        <div class="caja">
            {{ $oferta->requisitos_deseables ?? 'No especificados' }}
        </div>

    </div>

</body>
</html>