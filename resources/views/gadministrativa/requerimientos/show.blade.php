<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Requerimiento</title>
    <style>
        header table {
            width: 100%;
            /* border: 1px solid black; */
            border-bottom-width: 2px;
            border-bottom-style: dashed;
            border-bottom-color: black;
            padding-bottom: 1rem;
        }
        header h4{
            text-align: center;
        }
        header p{
            text-align: right;
        }
        header{
            font-size: 0.9rem;
        }
        body{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-left: 4rem;
            padding-right: 4rem;
            padding-top: 3rem;
        }
        .puntos{
            /* min-width: 1rem;
            max-width: 1rem; */
        }
        th{
            text-align: left;
            /* min-width: 2rem; */
        }
        main{
            font-size: 0.8rem;
        }
        main p{
            text-indent: 6rem;
            text-align: justify;
        }
        main ul{
            padding-left: 7rem;
        }
        footer{
            padding-top: 6rem;
            text-align: center;
        }
        footer span{
            font-size: 0.9rem;
            border-top: 1px solid black;
            padding-top: 1rem;
        }
    </style>
</head>
<body>    
    <header>
        <h4>"{{ Str::upper($config->anioNombre) }}"</h4>
        <p>Chachapoyas, {{ date('d',strtotime($requerimiento->fecha)) }} {{ __(date('F',strtotime($requerimiento->fecha))) }} del {{ date('Y',strtotime($requerimiento->fecha)) }}</p>
        <table>
            <thead>
                <tr>
                    <th colspan="3">{{ $requerimiento->encabezado }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th style="width: 90px">SEÑOR</th>
                    <td style="width: 10px">:</td>
                    <td>DR. MARIO Y. TORREJON ARELLANOS DIRECTOR GENERAL DEL IEST Público Perú Japón</td>
                </tr>
                <tr>
                    <th>ASUNTO</th>
                    <td>:</td>
                    <td>{{ $requerimiento->asunto }}</td>
                </tr>
            </tbody>
        </table>        
    </header>
    <main>
        <p>{{ $requerimiento->justificacion }}</p>
        <ul>
            @foreach ($requerimiento->re_detalles as $detalle)
                <li>{{ $detalle->cantidad }} {{ $detalle->ncatalogo->denominacion }} - {{ $detalle->observacion }}</li>
            @endforeach
        </ul>
        <p>Es cuanto lo que tengo que solicitar a su despacho. Aprovecho la oportunidad para expresarle las muestras de mi especial consideracion y estima.</p>
        <p>Atentamente</p>
    </main>
    <footer>
        <span>{{ Auth::user()->name }}</span>
    </footer>
</body>
</html>