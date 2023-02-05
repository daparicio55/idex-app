<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table>
        <tbody>
            @foreach ($estudiantes as $estudiante)
                <tr>
                    <td>{{ $estudiante->cliente->dniRuc }}</td>
                    <td>{{ $estudiante->cliente->apellido }} {{ $estudiante->cliente->nombre }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>