<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        hr{
            page-break-after: always;
            border: none;
            margin: 0;
            padding: 0;
        }
        label{
            padding: 0px;
        }
        strong{
            padding: 0px;
        }
        p{
            padding: 0px;
            margin: 0px;
        }
    </style>
    <title>Carnets Cepre {{$cepre->periodoCepre}}</title>
</head>
<body>
    @php
        $count = count($estudiantes)-1;
        $fila = 0;
    @endphp
    @for ($i = 0; $i < $count; $i++)
    @php
        $fila++;
    @endphp
    <div class="row">
        <div class="col-6">
            <div class="card mb-3" style="max-width: 8.1cm; height: 5.1cm; background-image: url('https://sisge.idexperujapon.edu.pe/img/fondoCarnet.png') ; background-size: 8.1cm">
                <div class="card-header  fw-bold" style="color: #6e1a05fa ; border:1px solid rgb(4, 4, 74) ">
                    <img src="{{ asset('img/logo.png') }}" style="height: 0.7cm;" alt="">
                    CEPRE IDEX PERÚ JAPÓN
                </div>
                <div class="card-body" style="height: 3cm; padding-top: 6px; padding-left: 5px; color: #6e1a05fa">
                    <div class="row">
                        <div class="col-7" style="line-height: 19px">
                            <p style="margin-top: 0px"><strong><label for="">DNI:</label><label for="">{{$estudiantes[$i]->cliente->dniRuc}}</label></strong></p>
                            <p><strong>
                                <label for="">Periodo:</label>
                                <label for="">{{$cepre->periodoCepre}}</label>
                            </strong></p>
                            <div class="form-group">
                                <strong>
                                    <label for="">Prog. de Estudios:</label>
                                    <label for="">
                                        @if ($estudiantes[$i]->carrera->nombreCarrera == 'Arquitectura de Plataformas y Servicios de Tecnologías de la Información')
                                            Arq. Pla. Servicios TIC
                                        @else
                                            @if ($estudiantes[$i]->carrera->nombreCarrera == 'Laboratorio Clínico y Anatomía Patológica')
                                                Laboratorio Clínico y Anatomía Pat.
                                            @else
                                                {{$estudiantes[$i]->carrera->nombreCarrera}}
                                            @endif
                                        @endif
                                    </label>
                                </strong>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="{{ Storage::url($estudiantes[$i]->url) }}" style="width: 85%" alt="">
                        </div>
                    </div>
                </div>
                <?php
                    $largo = strlen($estudiantes[$i]->cliente->apellido) + strlen($estudiantes[$i]->cliente->nombre);
                    $nombres = $estudiantes[$i]->cliente->nombre;
                    if ($largo > 29){
                        $pos = strpos($nombres," ");
                        $abre = substr($nombres,$pos+1,1);
                        $nombre = substr($nombres,0,$pos).' ' . $abre .'.';
                    }else{
                        $pos = 0;
                        $nombre = $nombres;
                    }
                ?>
                <div class="card-footer bg-transparent h7" style="text-align: center;padding:0px; border:1px solid rgb(4, 4, 74)">
                    <strong class="text-uppercase">{{$estudiantes[$i]->cliente->apellido}}</strong>,<span class="text-capitalize"> {{strtolower($nombre)}}</span>
                </div>
            </div>
        </div>
        @php
            $i++;
        @endphp

        <div class="col-6">
            <div class="card mb-3" style="max-width: 8.1cm; height: 5.1cm; background-image: url('https://sisge.idexperujapon.edu.pe/img/fondoCarnet.png') ; background-size: 8.1cm">
                <div class="card-header  fw-bold" style="color: #6e1a05fa ; border:1px solid rgb(4, 4, 74) ">
                    <img src="{{ asset('img/logo.png') }}" style="height: 0.7cm;" alt="">
                    CEPRE IDEX PERÚ JAPÓN
                </div>
                <div class="card-body" style="height: 3cm; padding-top: 6px; padding-left: 5px; color: #6e1a05fa">
                    <div class="row">
                        <div class="col-7" style="line-height: 19px">
                            <p style="margin-top: 0px"><strong><label for="">DNI:</label><label for="">{{$estudiantes[$i]->cliente->dniRuc}}</label></strong></p>
                            <p><strong>
                                <label for="">Periodo:</label>
                                <label for="">{{$cepre->periodoCepre}}</label>
                            </strong></p>
                            <div class="form-group">
                                <strong>
                                    <label for="">Prog. de Estudios:</label>
                                    <label for="">
                                        @if ($estudiantes[$i]->carrera->nombreCarrera == 'Arquitectura de Plataformas y Servicios de Tecnologías de la Información')
                                            Arq. Pla. Servicios TIC
                                        @else
                                            @if ($estudiantes[$i]->carrera->nombreCarrera == 'Laboratorio Clínico y Anatomía Patológica')
                                                Laboratorio Clínico y Anatomía Pat.
                                            @else
                                                {{$estudiantes[$i]->carrera->nombreCarrera}}
                                            @endif
                                        @endif
                                    </label>
                                </strong>
                            </div>
                        </div>
                        <div class="col-5">
                            <img src="{{ Storage::url($estudiantes[$i]->url) }}" style="width: 85%" alt="">
                        </div>
                    </div>
                </div>
                <?php
                    $largo = strlen($estudiantes[$i]->cliente->apellido) + strlen($estudiantes[$i]->cliente->nombre);
                    $nombres = $estudiantes[$i]->cliente->nombre;
                    if ($largo > 29){
                        $pos = strpos($nombres," ");
                        $abre = substr($nombres,$pos+1,1);
                        $nombre = substr($nombres,0,$pos).' ' . $abre .'.';
                    }else{
                        $pos = 0;
                        $nombre = $nombres;
                    }
                ?>
                <div class="card-footer bg-transparent h7" style="text-align: center;padding:0px; border:1px solid rgb(4, 4, 74)">
                    <strong class="text-uppercase">{{$estudiantes[$i]->cliente->apellido}}</strong>,<span class="text-capitalize"> {{strtolower($nombre)}}</span>
                </div>
            </div>
        </div>



        
    </div>
    @if ($fila == 5)
        <hr>
        @php
            $fila = 0;
        @endphp
    @endif
    @endfor
    
    
</body>
</html>