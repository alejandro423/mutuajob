<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Perfil Profesional</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #111;
        }

        h1, h2 {
            margin-bottom: 10px;
        }

        .section {
            margin-bottom: 25px;
        }

        ul {
            padding-left: 20px;
        }

    </style>
</head>
<body>

    <h1>
        {{ $perfil->nombre }} {{ $perfil->apellido }}
    </h1>

    <p>
        <strong>Email:</strong>
        {{ $perfil->email }}
    </p>

    <p>
        <strong>Teléfono:</strong>
        {{ $perfil->telefono }}
    </p>

    <p>
        <strong>Ubicación:</strong>
        {{ $perfil->ubicacion }}
    </p>

    <div class="section">

        <h2>Resumen Profesional</h2>

        <p>
            {{ $perfil->resumen_profesional }}
        </p>

    </div>

    <div class="section">

        <h2>Habilidades</h2>

        <ul>

            @foreach($perfil->habilidades as $habilidad)

                <li>
                    {{ $habilidad->nombre }}
                    - Nivel:
                    {{ $habilidad->pivot->nivel ?? 0 }}/5
                </li>

            @endforeach

        </ul>

    </div>

    <div class="section">

        <h2>Idiomas</h2>

        <ul>

            @foreach($perfil->idiomas as $idioma)

                <li>
                    {{ $idioma->nombre }}
                    - Nivel:
                    {{ $idioma->pivot->nivel ?? 0 }}/5
                </li>

            @endforeach

        </ul>

    </div>

    <div class="section">

        <h2>Certificaciones</h2>

        <ul>

            @foreach($perfil->certificaciones as $certificacion)

                <li>
                    {{ $certificacion->nombre }}
                    - {{ $certificacion->institucion }}
                </li>

            @endforeach

        </ul>

    </div>

    <div class="section">

        <h2>Experiencia Laboral</h2>

        <ul>

            @foreach($perfil->experiencias as $experiencia)

                <li>
                    {{ $experiencia->cargo }}
                    en
                    {{ $experiencia->empresa }}
                    ({{ $experiencia->fecha_inicio }}
                    -
                    {{ $experiencia->fecha_fin ?? 'Actualidad' }})
                </li>

            @endforeach

        </ul>

    </div>

</body>
</html>