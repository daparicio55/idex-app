<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    {!! Form::open(['route'=>'imports.calificaciones.store','method'=>'post','enctype'=>'multipart/form-data']) !!}
    <input type="file" name="file">
    <button type="submit">
        Enviar
    </button>
    {!! Form::close() !!}
</body>
</html>




