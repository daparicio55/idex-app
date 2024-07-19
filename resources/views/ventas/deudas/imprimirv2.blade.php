<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Comprobante DEUDA</title>
    <link rel="stylesheet" href="{{ asset('css/deudas.css') }}">
</head>
<body>
    @include('ventas.deudas.partials.deudabody')
    <div class="page-break-before"></div>
    @include('ventas.deudas.partials.deudabody')
</body>
</html>