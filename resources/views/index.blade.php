<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>SISGE | Sistema de Gestión</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .h1{
            font-weight: 800;
            color: white;
            font-size: 35px;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        p{
            color: whitesmoke;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        .btn{
            min-width: 100%;
            padding: 15px;
            border: 3px white solid;
        }
        .card-body{
            background-color: rgba(0, 0, 0, 0.7);
            box-shadow: 0px;
        }
        header{
            margin-top: 50px;
        }
        main{
            background-color: rgb(104, 99, 99);
            border-top-color: #7abdc7;;
            border-top-width: 20px;
            border-top-style: solid;
            margin-top: 50px;
            border-bottom-color: #08c6e4;
            border-bottom-width: 50px;
            border-bottom-style: solid;
        }
        .container-left{
            padding: 40px;
        }
        .btn-img{
            max-width: 60px;
        }
        .botones{
            width: 90%
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <img src="{{ asset('img/cropped-logo-300x93.webp') }}" alt="" class="img-fluid mx-auto d-block">
        </header>
        <main>
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-8 d-flex justify-content-center align-items-center">
                    <div class="container-left">
                        <h1 class="h1">
                            Sistema de Gestión 
                        </h1>
                        <h1 class="h1">
                            IEST Público Perú Japón
                        </h1>
                        <p>
                            Esta plataforma agrupa a los sitemas informáticos que ayudan a registrar la información de las instituciones de educación superior tecnológica en relación a los registros académicos y otros.
                        </p>
                    </div>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex justify-content-center align-items-center" style="height: 400px">
                    <div class="botones">
                        <a href="{{ route('home') }}" class="btn btn-info btn-lg"><img src="{{ asset('img/oficina.png') }}" alt=""> Acceso a trabajadores</a>
                        <a href="{{ route('home') }}" class="btn btn-info btn-lg mt-4"><img class="btn-img" src="{{ asset('img/estudiando.png') }}" alt=""> Acceso a estudiantes</a>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>