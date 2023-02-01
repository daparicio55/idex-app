@extends('adminlte::page')
@section('title', 'Ventas Reportes')
@section('content_header')
		<h1>Reportes de Ventas</h1>
@stop
@section('content')
@include('layouts.alert')
{!! Form::open(['route'=>'ventas.reportes.index','method'=>'get','role'=>'search']) !!}
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            {!! Form::label('anio', 'Seleccione Año', [null]) !!}
            <div class="input-group mb-3">
                {!! Form::select('anio', $anios, null, ['class'=>'form-control']) !!}
                <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="submit">
                        <i class="fa fa-search"></i> Mostrar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
{{-- **************REPORTES***************** --}}
@isset($ventas)
{{-- ***ventas por mes --}}
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-4">

            <div class="card-info">
              <div class="card-header">
                    <h4 class="card-title">Ventas por Meses - Año {{ $_GET['anio'] }}</h4>
              </div>
              <div class="card-body">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Mes</th>
                        <th style="text-align: right">Total</th>
                    </thead>
                    <tbody>
                        @php
                            $total_anio = 0;
                            $total=0;
                            $datos = [];
                        @endphp
                        @for ($i = 1; $i < 13; $i++)
                            
                            <tr>
                                <td>{{ $i }}</td>
                                <td>{{ $meses[$i-1] }}</td>
                                <td style="text-align: right">
                                    @foreach ($ventas as $venta)
                                        @if (intval(date('m',strtotime($venta->fecha))) == $i)
                                            @php
                                                $total = $total + $venta->total;
                                            @endphp
                                        @endif
                                    @endforeach
                                    S/ {{ number_format($total, 2, '.', ',') }}
                                    @php
                                        $datos[] = $total;
                                        $total_anio = $total_anio + $total;
                                        $total = 0;
                                    @endphp
                                </td>
                            </tr>    
                            @endfor
                            <tr>
                                <td colspan="3" class="text-right">Total - Año {{ $_GET['anio'] }}: <span><b>S/ {{ number_format($total_anio, 2, '.', ',') }}</b></span> </td>
                            </tr>
                            @php
                                $ventas_mes = json_encode($datos);
                            @endphp
                    </tbody>
                </table>
              </div>
            </div>
        </div>
        {{-- grafico --}}
        <div class="col-sm-12 col-md-8">
            <div class="card-info">
                <div class="card-header">
                    <h4 class="card-title">Gráfico por Meses - Año {{ $_GET['anio'] }}</h4>
                </div>
                <div class="card-body">
                  {{-- <h4 class="card-title">Title</h4>
                  <p class="card-text">Text</p> --}}
                    <figure>
                        <div id="ventas_mes"></div>
                    </figure>
                </div>
              </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="card-danger">
                <div class="card-header">
                    <h4 class="card-title">
                        Ventas por servicios - Año {{ $_GET['anio'] }}
                    </h4>
                </div>
                <div class="card-body">
                    @for ($i = 1; $i < 13; $i++)
                        <div class="card-info">
                            <div class="card-header">
                                <h4 class="card-title">
                                    {{ $meses[$i-1] }}
                                </h4>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead>
                                        <th>Cant.</th>
                                        <th>Servicio</th>
                                        <th class="text-right">Total</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $total= 0;
                                        @endphp
                                        @foreach ($ventas_servicios as $servicios )
                                            @if ($servicios->mes == $i)
                                                <tr>
                                                    <td>{{ $servicios->cantidad }}</td>
                                                    <td>{{ $servicios->nombre }}</td>
                                                    <td class="text-right">{{ $servicios->total }}</td>
                                                </tr>
                                                @php
                                                    $total = $total + $servicios->total;
                                                @endphp
                                            @endif
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="3" class="h4 text-right">
                                                Total {{ $meses[$i-1] }}: <b><span class="text-success"> S/ {{ number_format($total, 2, '.', ',') }} </span></b>
                                            </th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endisset
@stop
@isset($ventas)
@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    
//ventas por mes
Highcharts.chart('ventas_mes', {
  chart: {
    type: 'spline'
  },
  title: {
    text: 'Ventas por meses'
  },
  subtitle: {
    text: 'Sisge IESTP'
  },
  xAxis: {
    categories: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun',
      'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    accessibility: {
      description: 'Meses del año'
    }
  },
  yAxis: {
    title: {
      text: 'Ventas'
    },
    labels: {
      formatter: function () {
        return 'S/ '+this.value;
      }
    }
  },
  tooltip: {
    crosshairs: true,
    shared: true
  },
  plotOptions: {
    spline: {
      marker: {
        radius: 4,
        lineColor: '#666666',
        lineWidth: 1
      }
    }
  },
  series: [{
    name: 'Venta total',
    marker: {
      symbol: 'square'
    },
    data: <?= $ventas_mes ?>
    /* data: [5.2, 5.7, 8.7, 13.9, 18.2, 21.4, 25.0, 22.8, 17.5, 12.1, 7.6] */
  }]
});   
</script>
@stop
@endisset
