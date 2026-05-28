<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reporte de usuarios</title>

    <style>

        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #000;
            padding: 10px;
            text-align: left;
        }

        th {
            background: #e5e5e5;
        }

    </style>

</head>
<body>

    <h1>Reporte de Usuarios</h1>

    <table>

        <thead>

            <tr>

                <th>Nombre</th>
                <th>Correo</th>
                <th>Roles</th>

            </tr>

        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>

                        @foreach($user->roles as $role)

                            {{ $role->nombre }}

                            @if(!$loop->last)
                                ,
                            @endif

                        @endforeach

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</body>
</html>