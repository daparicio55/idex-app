@extends('layouts.registros.portada')
<!-- Portada -->
@section('programa')
    {{ $uasignada->unidad->modulo->carrera->nombreCarrera  }}
@endsection
@section('modulo')
    {{ $uasignada->unidad->modulo->nombre }}
@endsection
@section('udidactica')
    {{ $uasignada->unidad->nombre }}
@endsection
@section('periodo')
    {{ $uasignada->periodo->nombre }}
@endsection
@section('ciclo')
    {{ $uasignada->unidad->ciclo }}
@endsection
@section('creditos')
    {{ $uasignada->unidad->creditos }}
@endsection
@section('horas')
    {{ $uasignada->unidad->horas }}
@endsection
@section('docente')
    {{ $uasignada->user->name }}
@endsection
<!-- Lista de Alumnos -->
@section('alumnos')
    @foreach ($estudiantes as $key=>$estudiante)
        <tr>
            <td class="p-0 text-center border border-1">{{ cero($key +1) }}</td>
            <td class="pl-2 pb-0 pt-0 border border-1">{{ $estudiante->dniRuc }}</td>
            <td class="pl-2 pb-0 pt-0 border border-1"><span class="text-uppercase">{{  $estudiante->apellido }},</span> <span class="text-capitalize">{{ strtolower($estudiante->nombre) }}</span></td>
            <td class="p-0 border border-1">{{ $estudiante->periodo }}</td>
        </tr>
    @endforeach
@endsection
<!-- Lista de NOTAS con capacidades e indicadores -->
@section('notas_header_capacidades')
    @foreach ($uasignada->capacidades as $capacidade )
        @php
            $col = count($capacidade->indicadores)
        @endphp
        <th colspan="{{ $col }}" class="p-0 text-center border">{{ $capacidade->nombre }}</th>
        <th class="p-0 text-center border bg-light" rowspan="2">Logro</th>
    @endforeach
@endsection
@section('notas_header_indicadores')
    @foreach ($uasignada->capacidades as $capacidade)
        @foreach ($capacidade->indicadores as $indicadore)
            <th class="p-0 text-center border">{{ $indicadore->nombre }}</th>
        @endforeach
    @endforeach
@endsection
<!-- Resumen de asistencias -->
@section('fechas_asistencia')
    <th class="pl-0 pr-0 pt-1 pb-1 text-center border">#</th>
    @foreach ($fechas as $fecha)
        <th class="pl-0 pr-0 pt-1 pb-1 text-center border vertical-text">{{ date('d-m-Y',strtotime($fecha['fecha'])) }}</th>
    @endforeach
    @php
        $total_fechas = count($fechas);
        $maximo = $total_fechas * 0.30;
        $maximo = ceil($maximo);
    @endphp
@endsection
@section('asistencias')
    @foreach ($estudiantes as $key=>$estudiante)
        <tr>
            {{-- calculamos las faltas --}}
            @php
                $faltas = 0;
            @endphp
            @foreach ($fechas as $dia)
                @php
                    $valor = \App\Models\Docentes\Asistencias::where('fecha','=',$dia['fecha'])->where('emdetalle_id','=',$estudiante->id)->first();
                    if(isset($valor->estado)){
                        if($valor->estado == "F"){
                            $faltas ++;
                        }
                    }
                @endphp
            @endforeach
            {{-- revizamos si las faltas superan el %30 --}}
            <td>{{ cero($key+1) }}</td>
            @if($estudiante->licencia == "SI")
                <td class="border text-center" colspan="{{ $total_fechas }}">Licencia - {{ $estudiante->licenciaObservacion }}</td>
            @else
                @foreach ($fechas as $kd => $dia)
                        
                            @if ($faltas >= $maximo)
                                @if ($kd == 0)
                                    <td class="border text-center text-danger" colspan="{{ $total_fechas }}">Inhabilitado por superar el 30% de inasistencias</td>
                                @endif
                            @else
                                @php
                                    $valor = \App\Models\Docentes\Asistencias::where('fecha','=',$dia['fecha'])->where('emdetalle_id','=',$estudiante->id)->first();
                                    if(isset($valor->estado)){
                                        $estado = $valor->estado;
                                        if($estado == "P"){
                                            $color = "primary";
                                        }else{
                                            $color = "danger";
                                        }
                                    }else{
                                        $estado = "NR";
                                        $color = "warning";
                                    }
                                @endphp
                            <td class="border text-{{ $color }}">{{ $estado }}</td>
                            @endif
                @endforeach
            @endif
        </tr>
    @endforeach
@endsection
<!-- Resumen de Notas con los Indicadores -->
@section('notas_cuerpo')
    @foreach ($estudiantes as $key=>$estudiante)
    @if ($estudiante->tipo == "Convalidacion" || $estudiante->licencia == "SI")
        @php
            $colu = 0;
        @endphp
        @foreach ($uasignada->capacidades as $capacidade)
            @foreach ($capacidade->indicadores as $indicadore)
                @php
                    $colu ++;
                @endphp
            @endforeach
        @endforeach
        <tr>
            <td class="p-0 text-center border">{{ cero($key+1) }}</td>
            @if($estudiante->licencia == "SI")
                <td class="p-0 text-center border" colspan="{{ $colu + 2 }}">Licencia - {{ $estudiante->licenciaObservacion }}</td>
            @else
                <td class="p-0 text-center border" colspan="{{ $colu + 2 }}">{{ $estudiante->tipo }} - {{ $estudiante->observacion }}</td>
            @endif
        </tr>
    @else
        <tr>
            <td class="p-0 text-center border">{{ cero($key+1) }}</td>
            @foreach ($uasignada->capacidades as $capacidade)
            @php
                $nota = 0;
                $suma = 0;
                $contador = 0;
            @endphp
                @foreach ($capacidade->indicadores as $indicadore)
                    <td class="p-0 text-center @if(number_format(indicador_calificacion($indicadore->id, $estudiante->id),0,'.','')>12) text-primary @else text-danger @endif">{{ cero(number_format(indicador_calificacion($indicadore->id, $estudiante->id),0,'.','')) }}</td>    
                    @php
                        /* if(indicador_calificacion($indicadore->id, $estudiante->id) <> "NC"){ */
                            $suma = $suma + number_format(indicador_calificacion($indicadore->id, $estudiante->id),0,'.','');
                            $contador ++;
                        /* } */
                    @endphp
                @endforeach
                @php
                    $nota = $suma / $contador;
                    $nota = round(number_format($nota,2,'.',''),0);
                @endphp
                
            <td class="p-0 text-center bg-light border @if($nota>12) text-primary @else text-danger @endif" >{{ cero($nota) }}</td>
            @endforeach
        </tr>
    @endif
    @endforeach
@endsection
<!-- Resumen de Notas -->
@section('resumen_header_capacidades')
    @foreach ($uasignada->capacidades as $capacidade )
        <th class="p-0 text-center border">{{ $capacidade->nombre }}</th>
    @endforeach
@endsection
@section('resumen_cuerpo_notas')
    @foreach ($estudiantes as $key=>$estudiante)
    <tr>
        <td class="p-0 text-center border">{{ cero($key + 1)  }}</td>
        <td class="pl-2 pb-0 pt-0 border border-1">{{ $estudiante->dniRuc }}</td>
        <td class="pl-2 pb-0 pt-0 border"><span class="text-uppercase">{{  $estudiante->apellido }},</span> <span class="text-capitalize">{{ strtolower($estudiante->nombre) }}</span></td>
        @if ($estudiante->tipo == "Convalidacion" || $estudiante->licencia == "SI")

            @if($estudiante->licencia == "SI")
                <td class="p-0 border text-center" colspan="{{ count($uasignada->capacidades) + 1 }}">
                    Licencia - {{ $estudiante->licenciaObservacion }}
                </td>
            @else
                <td class="p-0 border text-center" colspan="{{ count($uasignada->capacidades) + 1 }}">
                    {{ $estudiante->tipo }} - {{ $estudiante->observacion }}
                </td>
            @endif
        @else
            @php
                $cont=0;
                $sum=0;
                $pro=0;
            @endphp
            @foreach ($uasignada->capacidades as $capacidade)
                @php
                    $nota = 0;
                    $suma = 0;
                    $contador = 0;
                @endphp
                @foreach ($capacidade->indicadores as $indicadore)
                    @php
                        $suma = $suma + number_format(indicador_calificacion($indicadore->id, $estudiante->id),2,'.','');
                        $contador ++;
                    @endphp
                @endforeach
                @php
                    $nota = $suma / $contador;
                    $nota = round(number_format($nota,2,'.',''),0);
                    $sum = $sum + $nota;
                    $cont++;
                @endphp
                <td class="p-0 border text-center @if($nota>12) text-primary @else text-danger @endif">{{ cero($nota) }}</td>
            @endforeach
            @php
                $pro = $sum/$cont;
                $pro = round(number_format($pro,2,'.',''),0);
            @endphp
            <td class="p-0 border text-center @if($pro>12) text-primary @else text-danger @endif">{{ cero($pro) }}</td>
        @endif
    </tr>
    @endforeach
@endsection
<!-- ACTA FINAL -->
@section('acta_carrera')
    {{ $uasignada->unidad->modulo->carrera->nombreCarrera }}
@endsection
@section('acta_modulo')
    {{ $uasignada->unidad->modulo->nombre }}
@endsection
@section('acta_docente')
    {{ $uasignada->user->name }}
@endsection
@section('acta_fecha')
    {{ date('d-m-Y',strtotime($uasignada->periodo->ffin)) }}
@endsection
@section('acta_creditos')
    {{ $uasignada->unidad->creditos }}
@endsection
@section('acta_unidad')
    {{ $uasignada->unidad->nombre }}
@endsection
@section('acta_ciclo')
    {{ $uasignada->unidad->ciclo }}
@endsection
@section('acta_notas')
    @foreach ($estudiantes as $key=>$estudiante)
    <tr>
        <td class="p-0 border text-center">{{ cero($key+1) }}</td>
        <td class="pl-2 pb-0 pt-0 border border-1">{{ $estudiante->dniRuc }}</td>
        <td class="pl-2 pb-0 pt-0 border"><span class="text-uppercase">{{  $estudiante->apellido }},</span> <span class="text-capitalize">{{ strtolower($estudiante->nombre) }}</span></td>
        <td class="p-0 border text-center">{{ $estudiante->periodo }}</td>
            @if ($estudiante->tipo == "Convalidacion" || $estudiante->licencia == "SI")

                @if($estudiante->licencia == "SI")
                    <td class="p-0 border text-center" colspan="3">
                        Licencia - {{ $estudiante->licenciaObservacion }}
                    </td>
                @else
                    <td class="p-0 border text-center" colspan="3">
                        {{ $estudiante->tipo }} - {{ $estudiante->observacion }}
                    </td>
                @endif
            @else
                @php
                $cont=0;
                $sum=0;
                $pro=0;
                @endphp
                @foreach ($uasignada->capacidades as $capacidade)
                    @php
                        $nota = 0;
                        $suma = 0;
                        $contador = 0;
                    @endphp
                    @foreach ($capacidade->indicadores as $indicadore)
                        @php
                            $suma = $suma + number_format(indicador_calificacion($indicadore->id, $estudiante->id),2,'.','');
                            $contador ++;
                        @endphp
                    @endforeach
                    @php
                        $nota = $suma / $contador;
                        $nota = round(number_format($nota,2,'.',''),0);
                        $sum = $sum + $nota;
                        $cont++;
                    @endphp
                    
                @endforeach
                @php
                    $pro = $sum/$cont;
                    $pro = round(number_format($pro,2,'.',''),0);
                @endphp
                <td class="p-0 border text-center @if($pro>12) text-primary @else text-danger @endif">{{ cero($pro) }}</td>
                <td class="p-0 text-center">{{ letras($pro) }}</td>
                <td class="p-0 border text-center">{{ cero($pro * $uasignada->unidad->creditos) }}</td>
            @endif
    </tr>
    @endforeach
@endsection
