<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $estudiante->postulante->cliente->dniRuc }} - {{ $estudiante->postulante->carrera->nombreCarrera }}</title>
    <style>
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table{
            width: 100%;
            font-size: 0.6rem;
        }
        th{
            text-align: left;
        }
    </style>
</head>
<body>
    <table>
        <tbody>
            <tr>
                <th colspan="11">
                    {{ Str::upper($estudiante->postulante->carrera->nombreCarrera) }} - {{ $estudiante->postulante->admisione->nombre }}
                </th>
            </tr>
            <tr>
                <td colspan="11">
                    <span style="font-style: italic"> {{ Str::upper($estudiante->postulante->cliente->apellido) }}, {{ Str::title($estudiante->postulante->cliente->nombre) }} -  {{ $estudiante->postulante->cliente->dniRuc }}</span>
                </td>
            </tr>
        </tbody>
    </table>
    {{-- primer semestre --}}
    <table>
        <tbody>
            <tr>
                <th colspan="11">
                    SEMESTRE I
                </th>
            </tr>
            <tr>
                <th>Unidad Didactica</th>
                <th>Cre.</th>
                <th>Hor.</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>Reg.</th>
                <th>Ext.</th>
            </tr>
       
            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $unidad)
                    @if ($unidad->ciclo == 'I')
                        <tr>
                            <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                            <td>{{ $unidad->creditos }}</td>
                            <td>{{ $unidad->horas }}</td>
                            {{-- aca van las notas correspondientes --}}
                            @php
                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                $cont = 0;
                                $desaprobado = FALSE;
                            @endphp
                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                <td @if($nota->nota<13) style="color: red; text-align: right" @else style="color: blue; text-align: right" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @if($nota->nota<13)
                                    @isset($nota->nota)
                                        @php
                                            $desaprobado = TRUE;
                                        @endphp
                                    @endisset
                                @else
                                    @php
                                        $desaprobado = FALSE;
                                    @endphp
                                @endif
                                @php
                                    $cont++;
                                @endphp
                            @endforeach
                            @for ($i = $cont; $i < 3; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                            @if($desaprobado == TRUE)
                                <td style="text-align: right">{{ $reg }}</td>
                                <td style="text-align: right">{{ $ext }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @php
                                $desaprobado = FALSE;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @endforeach
            {{-- segundo ciclo --}}
            <tr>
                <th colspan="11">
                    SEMESTRE II
                </th>
            </tr>
            <tr>
                <th>Unidad Didactica</th>
                <th>Cre.</th>
                <th>Hor.</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>Reg.</th>
                <th>Ext.</th>
            </tr>
            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $unidad)
                    @if ($unidad->ciclo == 'II')
                        <tr>
                            <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                            <td>{{ $unidad->creditos }}</td>
                            <td>{{ $unidad->horas }}</td>
                            {{-- aca van las notas correspondientes --}}
                            @php
                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                $cont = 0;
                                $desaprobado = FALSE;
                            @endphp
                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                <td @if($nota->nota<13) style="color: red; text-align: right" @else style="color: blue; text-align: right" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @if($nota->nota<13)
                                    @isset($nota->nota)
                                        @php
                                            $desaprobado = TRUE;
                                        @endphp
                                    @endisset
                                @else
                                    @php
                                        $desaprobado = FALSE;
                                    @endphp
                                @endif
                                @php
                                    $cont++;
                                @endphp
                            @endforeach
                            @for ($i = $cont; $i < 3; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                            @if($desaprobado == TRUE)
                                <td style="text-align: right">{{ $reg }}</td>
                                <td style="text-align: right">{{ $ext }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @php
                                $desaprobado = FALSE;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @endforeach
            {{-- tercer ciclo --}}
            <tr>
                <th colspan="11">
                    SEMESTRE III
                </th>
            </tr>
            <tr>
                <th>Unidad Didactica</th>
                <th>Cre.</th>
                <th>Hor.</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>Reg.</th>
                <th>Ext.</th>
            </tr>
            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $unidad)
                    @if ($unidad->ciclo == 'III')
                        <tr>
                            <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                            <td>{{ $unidad->creditos }}</td>
                            <td>{{ $unidad->horas }}</td>
                            {{-- aca van las notas correspondientes --}}
                            @php
                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                $cont = 0;
                                $desaprobado = FALSE;
                            @endphp
                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                <td @if($nota->nota<13) style="color: red; text-align: right" @else style="color: blue; text-align: right" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @if($nota->nota<13)
                                    @isset($nota->nota)
                                        @php
                                            $desaprobado = TRUE;
                                        @endphp
                                    @endisset
                                @else
                                    @php
                                        $desaprobado = FALSE;
                                    @endphp
                                @endif
                                @php
                                    $cont++;
                                @endphp
                            @endforeach
                            @for ($i = $cont; $i < 3; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                            @if($desaprobado == TRUE)
                                <td style="text-align: right">{{ $reg }}</td>
                                <td style="text-align: right">{{ $ext }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @php
                                $desaprobado = FALSE;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @endforeach
            {{-- cuarto ciclo --}}
            <tr>
                <th colspan="11">
                    SEMESTRE IV
                </th>
            </tr>
            <tr>
                <th>Unidad Didactica</th>
                <th>Cre.</th>
                <th>Hor.</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>Reg.</th>
                <th>Ext.</th>
            </tr>
            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $unidad)
                    @if ($unidad->ciclo == 'IV')
                        <tr>
                            <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                            <td>{{ $unidad->creditos }}</td>
                            <td>{{ $unidad->horas }}</td>
                            {{-- aca van las notas correspondientes --}}
                            @php
                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                $cont = 0;
                                $desaprobado = FALSE;
                            @endphp
                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                <td @if($nota->nota<13) style="color: red; text-align: right" @else style="color: blue; text-align: right" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @if($nota->nota<13)
                                    @isset($nota->nota)
                                        @php
                                            $desaprobado = TRUE;
                                        @endphp
                                    @endisset
                                @else
                                    @php
                                        $desaprobado = FALSE;
                                    @endphp
                                @endif
                                @php
                                    $cont++;
                                @endphp
                            @endforeach
                            @for ($i = $cont; $i < 3; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                            @if($desaprobado == TRUE)
                                <td style="text-align: right">{{ $reg }}</td>
                                <td style="text-align: right">{{ $ext }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @php
                                $desaprobado = FALSE;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @endforeach
            {{-- quinto ciclo --}}
            <tr>
                <th colspan="11">
                    SEMESTRE V
                </th>
            </tr>
            <tr>
                <th>Unidad Didactica</th>
                <th>Cre.</th>
                <th>Hor.</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>Reg.</th>
                <th>Ext.</th>
            </tr>
            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $unidad)
                    @if ($unidad->ciclo == 'V')
                        <tr>
                            <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                            <td>{{ $unidad->creditos }}</td>
                            <td>{{ $unidad->horas }}</td>
                            {{-- aca van las notas correspondientes --}}
                            @php
                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                $cont = 0;
                                $desaprobado = FALSE;
                            @endphp
                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                <td @if($nota->nota<13) style="color: red; text-align: right" @else style="color: blue; text-align: right" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @if($nota->nota<13)
                                    @isset($nota->nota)
                                        @php
                                            $desaprobado = TRUE;
                                        @endphp
                                    @endisset
                                @else
                                    @php
                                        $desaprobado = FALSE;
                                    @endphp
                                @endif
                                @php
                                    $cont++;
                                @endphp
                            @endforeach
                            @for ($i = $cont; $i < 3; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                            @if($desaprobado == TRUE)
                                <td style="text-align: right">{{ $reg }}</td>
                                <td style="text-align: right">{{ $ext }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @php
                                $desaprobado = FALSE;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @endforeach
            {{-- sexto ciclo --}}
            <tr>
                <th colspan="11">
                    SEMESTRE VI
                </th>
            </tr>
            <tr>
                <th>Unidad Didactica</th>
                <th>Cre.</th>
                <th>Hor.</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>No</th>
                <th>Observacion</th>
                <th>Reg.</th>
                <th>Ext.</th>
            </tr>
            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                @foreach ($modulo->unidades as $unidad)
                    @if ($unidad->ciclo == 'VI')
                        <tr>
                            <td> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                            <td>{{ $unidad->creditos }}</td>
                            <td>{{ $unidad->horas }}</td>
                            {{-- aca van las notas correspondientes --}}
                            @php
                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                $cont = 0;
                                $desaprobado = FALSE;
                            @endphp
                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                <td @if($nota->nota<13) style="color: red; text-align: right" @else style="color: blue; text-align: right" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                <td>{{ Str::limit($nota->tipo,7,'.') }} {{ date('d/m/y',strtotime($nota->ffin)) }}</td>
                                @if($nota->nota<13)
                                    @isset($nota->nota)
                                        @php
                                            $desaprobado = TRUE;
                                        @endphp
                                    @endisset
                                @else
                                    @php
                                        $desaprobado = FALSE;
                                    @endphp
                                @endif
                                @php
                                    $cont++;
                                @endphp
                            @endforeach
                            @for ($i = $cont; $i < 3; $i++)
                                <td></td>
                                <td></td>
                            @endfor
                            @if($desaprobado == TRUE)
                                <td style="text-align: right">{{ $reg }}</td>
                                <td style="text-align: right">{{ $ext }}</td>
                            @else
                                <td></td>
                                <td></td>
                            @endif
                            @php
                                $desaprobado = FALSE;
                            @endphp
                        </tr>
                    @endif
                @endforeach
            @endforeach
        </tbody>
    </table>
    
</body>
</html>