<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Nóminas</title>
    <style>
        .verticalText{
            writing-mode: vertical-lr;
            display: inline;
        }
        td{
            border: 1px solid #000;
            border-spacing: 0;
        }
        h4{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
        hr{
            page-break-after: always;
            border: none;
            margin: 0;
            padding: 0;
        }
    </style>
</head>
<body>
@foreach ($estudiantes as $estudiante)
<div class="card">
    <div class="card-header">
        {{  Str::upper($estudiante->nombreCarrera) }}
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p>{{ Str::upper($estudiante->apellido) }}, {{ Str::title($estudiante->nombre) }}</p>
            <footer class="blockquote-footer">{{ $estudiante->dniRuc }} <cite title="Source Title">{{ date('d-m-Y',strtotime($estudiante->fechaNacimiento)) }}</cite></footer>
        </blockquote>
        {{-- aca debe haber un helper que regrese los modulos --}}
        <table style="font-size: 0.6rem">
            <th style="width: 13%">MÓDULO</th>
            <th style="width: 7%">TIPO</th>
            <th style="width: 41%">SEMESTRE I</th>
            <th style="width: 2%">CRE</th>
            <th style="width: 1%;text-align: center">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            @php
                $contador = 1;
                $total = 0;
            @endphp
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "I")
                    @php
                        $total ++;
                    @endphp
                @endif
            @endforeach
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "I")
                    <tr>
                        @if ($contador == 1)
                            <td rowspan="{{ $total }}">{{ $unidad->modulo }}</td>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        {{-- aca van las notas correspondientes --}}
                        @php
                            $cont = 0;
                        @endphp
                        @foreach (notas($unidad->id,$estudiante->id) as $nota)
                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>{{ $nota->nota }}</td>
                            {{-- vamos a poner la fecha y la observacion --}}
                                @if ($nota->tipo == 'Convalidacion')
                                    <td>{{ Str::limit($nota->tipo,3,'.') }} {{ $nota->observacion }}</td>
                                @else
                                    <td>{{ Str::limit($nota->tipo,3,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @endif
                            @php
                                $cont++;
                            @endphp
                        @endforeach
                        @for ($i = $cont; $i < 3; $i++)
                            <td></td>
                            <td></td>
                        @endfor
                    </tr>
                @endif
            @endforeach
                @php
                    $contador = 1;
                @endphp
            </tbody>
        </table>
        {{-- semestre II --}}
        <table style="font-size: 0.6rem">
            <th style="width: 13%">MÓDULO</th>
            <th style="width: 7%">TIPO</th>
            <th style="width: 41%">SEMESTRE II</th>
            <th style="width: 2%">CRE</th>
            <th style="width: 1%;text-align: center">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            @php
                $contador = 1;
                $total = 0;
            @endphp
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "II")
                    @php
                        $total ++;
                    @endphp
                @endif
            @endforeach
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "II")
                    <tr>
                        @if ($contador == 1)
                            <td rowspan="{{ $total }}">{{ $unidad->modulo }}</td>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        {{-- aca van las notas correspondientes --}}
                        @php
                            $cont = 0;
                        @endphp
                        @foreach (notas($unidad->id,$estudiante->id) as $nota)
                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>{{ $nota->nota }}</td>
                            {{-- vamos a poner la fecha y la observacion --}}
                            <td>{{ Str::limit($nota->tipo,3,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                            @php
                                $cont++;
                            @endphp
                        @endforeach 
                        @for ($i = $cont; $i < 3; $i++)
                            <td></td>
                            <td></td>
                        @endfor
                    </tr>
                @endif
            @endforeach
                @php
                    $contador = 1;
                @endphp
            </tbody>
        </table>
        {{-- semestre III --}}
        <table style="font-size: 0.6rem">
            <th style="width: 13%">MÓDULO</th>
            <th style="width: 7%">TIPO</th>
            <th style="width: 41%">SEMESTRE III</th>
            <th style="width: 2%">CRE</th>
            <th style="width: 1%;text-align: center">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            @php
                $contador = 1;
                $total = 0;
            @endphp
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "III")
                    @php
                        $total ++;
                    @endphp
                @endif
            @endforeach
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "III")
                    <tr>
                        @if ($contador == 1)
                            <td rowspan="{{ $total }}">{{ $unidad->modulo }}</td>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        {{-- aca van las notas correspondientes --}}
                        @php
                            $cont = 0;
                        @endphp
                        @foreach (notas($unidad->id,$estudiante->id) as $nota)
                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>{{ $nota->nota }}</td>
                            {{-- vamos a poner la fecha y la observacion --}}
                            <td>{{ Str::limit($nota->tipo,3,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                            @php
                                $cont++;
                            @endphp
                        @endforeach 
                        @for ($i = $cont; $i < 3; $i++)
                            <td></td>
                            <td></td>
                        @endfor
                    </tr>
                @endif
            @endforeach
                @php
                    $contador = 1;
                @endphp
            </tbody>
        </table>
        {{-- semestre IV --}}
        <table style="font-size: 0.6rem">
            <th style="width: 13%">MÓDULO</th>
            <th style="width: 7%">TIPO</th>
            <th style="width: 41%">SEMESTRE IV</th>
            <th style="width: 2%">CRE</th>
            <th style="width: 1%;text-align: center">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            @php
                $contador = 1;
                $total = 0;
            @endphp
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "IV")
                    @php
                        $total ++;
                    @endphp
                @endif
            @endforeach
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "IV")
                    <tr>
                        @if ($contador == 1)
                            <td rowspan="{{ $total }}">{{ $unidad->modulo }}</td>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        {{-- aca van las notas correspondientes --}}
                        @php
                            $cont = 0;
                        @endphp
                        @foreach (notas($unidad->id,$estudiante->id) as $nota)
                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>{{ $nota->nota }}</td>
                            {{-- vamos a poner la fecha y la observacion --}}
                            <td>{{ Str::limit($nota->tipo,3,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                            @php
                                $cont++;
                            @endphp
                        @endforeach 
                        @for ($i = $cont; $i < 3; $i++)
                            <td></td>
                            <td></td>
                        @endfor
                    </tr>
                @endif
            @endforeach
                @php
                    $contador = 1;
                @endphp
            </tbody>
        </table>
        {{-- semestre V --}}
        <table style="font-size: 0.6rem">
            <th style="width: 13%">MÓDULO</th>
            <th style="width: 7%">TIPO</th>
            <th style="width: 41%">SEMESTRE V</th>
            <th style="width: 2%">CRE</th>
            <th style="width: 1%;text-align: center">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            @php
                $contador = 1;
                $total = 0;
            @endphp
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "V")
                    @php
                        $total ++;
                    @endphp
                @endif
            @endforeach
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "V")
                    <tr>
                        @if ($contador == 1)
                            <td rowspan="{{ $total }}">{{ $unidad->modulo }}</td>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        {{-- aca van las notas correspondientes --}}
                        @php
                            $cont = 0;
                        @endphp
                        @foreach (notas($unidad->id,$estudiante->id) as $nota)
                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>{{ $nota->nota }}</td>
                            {{-- vamos a poner la fecha y la observacion --}}
                            <td>{{ Str::limit($nota->tipo,3,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                            @php
                                $cont++;
                            @endphp
                        @endforeach 
                        @for ($i = $cont; $i < 3; $i++)
                            <td></td>
                            <td></td>
                        @endfor
                    </tr>
                @endif
            @endforeach
                @php
                    $contador = 1;
                @endphp
            </tbody>
        </table>
        {{-- semestre VI --}}
        <table style="font-size: 0.6rem">
            <th style="width: 13%">MÓDULO</th>
            <th style="width: 7%">TIPO</th>
            <th style="width: 41%">SEMESTRE VI</th>
            <th style="width: 2%">CRE</th>
            <th style="width: 1%;text-align: center">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            <th style="width: 1%">NO</th>
            <th style="width: 11%">Obsevacion</th>
            @php
                $contador = 1;
                $total = 0;
            @endphp
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "VI")
                    @php
                        $total ++;
                    @endphp
                @endif
            @endforeach
            @foreach ($unidades as $unidad)
                @if ($unidad->ciclo == "VI")
                    <tr>
                        @if ($contador == 1)
                            <td rowspan="{{ $total }}">{{ $unidad->modulo }}</td>
                            @php
                                $contador ++;
                            @endphp
                        @endif
                        <td>{{ $unidad->tipo }}</td>
                        <td>{{ $unidad->nombre }}</td>
                        <td>{{ $unidad->creditos }}</td>
                        {{-- aca van las notas correspondientes --}}
                        @php
                            $cont = 0;
                        @endphp
                        @foreach (notas($unidad->id,$estudiante->id) as $nota)
                            <td @if($nota->nota<13) class="text-danger" @else class="text-primary" @endif>{{ $nota->nota }}</td>
                            {{-- vamos a poner la fecha y la observacion --}}
                            <td>{{ Str::limit($nota->tipo,3,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                            @php
                                $cont++;
                            @endphp
                        @endforeach 
                        @for ($i = $cont; $i < 3; $i++)
                            <td></td>
                            <td></td>
                        @endfor
                    </tr>
                @endif
            @endforeach
                @php
                    $contador = 1;
                @endphp
            </tbody>
        </table>
        {{-- fin --}}
    </div>
</div>
<hr>
@endforeach
</body>
<footer>

</footer>
</html>