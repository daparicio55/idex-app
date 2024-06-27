<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $estudiante->postulante->cliente->dniRuc }} - {{ $estudiante->postulante->carrera->nombreCarrera }}</title>
    <style>
        main{
            font-family: Arial, sans-serif;
            font-size: 0.5rem;
        }
        main table{
            width: 100%;
            border-collapse: collapse;
        }
        main table td {
            border: 1px solid black; /* Añade el borde a todas las celdas */
            text-align: left;
            padding-left: 0.4rem;
        }
        main table th{
            padding: 3px;
            border: 1px solid black; /* Añade el borde a todas las celdas */
            text-align: left;
        }
        .header-semestre{
            background-color: #918b8b;
        }
        .header-unidad{
            background-color: #d3d3d3;
        }
        .image-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }
        td p {
            margin: 0;
            font-size: 0.55rem;
        }
        .td-contenido{
            font-size: 0.48rem;
        }
    </style>
</head>
<body>
    <main>
        <table>
            <thead style="border-top: 0px">
                <tr style="border-top: 0px">
                    <th colspan="9" style="border-top: 0px; border-left: 0px; border-right: 0px">
                        <div style="width: 25%; display: inline-block">
                            <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" style="width: 95%" alt="a">
                        </div>
                        <div style="width: 48%; display: inline-block; text-align: center">
                            <p style="padding: 0px; margin: 10px" style="margin: ">FAMILIA TECNOLÓGICA: "LA UNIDAD ES LA MEDALLA QUE NOS DISTINGUE"</p>
                            <p style="padding: 0px; margin: 0px"><b> INSTITUTO SUPERIOR TECNOLÓGICO PÚBLICO "PERÚ JAPÓN"</b></p>
                        </div>
                        <div style="width: 25%; display: inline-block">
                            <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png" style="width: 70%" alt="b">
                        </div>
                    </th>
                </tr>
                <tr>
                    <th colspan="9">
                        <span style="font-style: italic"> {{ Str::upper($estudiante->postulante->cliente->apellido) }}, {{ Str::title($estudiante->postulante->cliente->nombre) }} -  {{ $estudiante->postulante->cliente->dniRuc }}</span>
                    </th>
                </tr>
                <tr>
                    <th colspan="9">
                        {{ Str::upper($estudiante->postulante->carrera->nombreCarrera) }} - {{ $estudiante->postulante->admisione->nombre }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ciclos as $ciclo)
                    <tr>
                        <th colspan="9" class="header-semestre">
                            SEMESTRE {{ $ciclo }}
                        </th>
                    </tr>
                    <tr class="header-unidad">
                        <th style="min-width: 250px">Unidad Didactica</th>
                        <th style="text-align: center">Cre.</th>
                        <th style="text-align: center">Hor.</th>
                        <th style="text-align: center">No</th>
                        <th>Observacion</th>
                        <th style="text-align: center">No</th>
                        <th>Observacion</th>
                        <th style="text-align: center">No</th>
                        <th>Observacion</th>
                    </tr>
                    @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                    @foreach ($modulo->unidades as $unidad)
                        @if ($unidad->ciclo == 'I')
                            <tr>
                                <td class="td-contenido"> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                <td class="td-contenido" style="text-align: center; width: 20px">{{ $unidad->creditos }}</td>
                                <td class="td-contenido" style="text-align: center; width: 20px">{{ $unidad->horas }}</td>
                                {{-- aca van las notas correspondientes --}}
                                @php
                                    $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                    $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                    $cont = 0;
                                    $desaprobado = FALSE;
                                @endphp
                                @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                    <td class="td-contenido" @if($nota->nota<13) style="color: red; text-align: center; width: 20px" @else style="color: blue; text-align: center; width: 20px" @endif> @if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                    <td class="td-contenido">{{ Str::limit($nota->tipo,15,'.') }} {{ date('d/m/y',strtotime($nota->matricula->matricula->ffin)) }}</td>
                                    
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
                                @php
                                    $desaprobado = FALSE;
                                @endphp
                            </tr>
                        @endif
                    @endforeach
                @endforeach
                @endforeach
            </tbody>
        </table>
    </main>
    
</body>
</html>