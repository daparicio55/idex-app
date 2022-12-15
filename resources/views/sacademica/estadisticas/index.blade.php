@extends('adminlte::page')
@section('title', 'Estadisticas')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Reporte de Matrículas</h1>
@stop
@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif
{!! Form::open(['route'=>'sacademica.estadisticas.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Admision', [null]) !!}
    @if(isset($_GET['id']))
    {!! Form::select('id',$periodos, $_GET['id'], ['class'=>'form-control']) !!}  
    @else
    {!! Form::select('id',$periodos, null, ['class'=>'form-control']) !!}  
    @endif
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
{!! Form::close() !!}
@php
    $json = null;
@endphp

@if(isset($_GET['id']))
<div class="row">
    <div class="col-sm-12">
        <figure>
            <div id="container"></div>
            <p class="text-center">
              Grafico Estadístico
            </p>
        </figure>
    </div>  
    @php
        $puntos = [];
    @endphp  
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <tr class="bg-info">
                        <th>Programa de Estudios</th>
                        <th>Varones</th>
                        <th>Mujeres</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $tmasculino = 0;
                        $tfenemino = 0;
                        $total = 0;
                        
                    @endphp
                    @foreach ($carreras as $carrera)
                        @php
                            $masculino = totalProgramaSexos($_GET['id'],$carrera->idCarrera,'Masculino');
                            $femenino = totalProgramaSexos($_GET['id'],$carrera->idCarrera,'Femenino');
                            $totalprograma = totalPrograma($_GET['id'],$carrera->idCarrera);
                        @endphp  
                        @if($totalprograma>0)
                        <tr>
                            <td>{{ $carrera->nombreCarrera }}</td>
                            <td>{{ $masculino }}</td>
                            <td>{{ $femenino }}</td>
                            <td>{{ $totalprograma }}</td>
                        </tr>
                        @php
                            $tmasculino = $tmasculino + $masculino;
                            $tfenemino = $tfenemino + $femenino;
                            $total = $total + $totalprograma;
                            $puntos[] = [
                                'name'=>$carrera->nombreCarrera,'y'=>$totalprograma
                            ];                            
                        @endphp                  
                        @endif
                    @endforeach
                    @php
                        $json = json_encode($puntos);
                    @endphp
                    <tr class="bg-info">
                        <td class="text-right">Totales</td>
                        <td>{{ $tmasculino }}</td>
                        <td>{{ $tfenemino }}</td>
                        <td>{{ $total }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endif
@stop
@section('js')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script>
	// Data retrieved from https://netmarketshare.com
    Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Reporte total de Matriculados para el periodo Acádemico'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    accessibility: {
        point: {
        valueSuffix: '%'
        }
    },
    plotOptions: {
        pie: {
        allowPointSelect: true,
        cursor: 'pointer',
        dataLabels: {
            enabled: true,
            format: '<b>{point.name}</b>: {point.percentage:.1f} %'
        }
        }
    },
    series: [{
        name: 'Brands',
        colorByPoint: true,
        data: <?= $json ?>
    }]
    });
	</script>
@stop