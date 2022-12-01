@extends('adminlte::page')
@section('title', 'Cepre')

@section('content_header')
    <h1><i class="fas fa-money-check-alt text-primary"></i> Cruce de Pagos</h1>
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
{!! Form::open(['route'=>'cepres.cruzes.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('idCepre', 'Periodo de Cepre', [null]) !!}
    {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
@if(isset($cepre))
    <div class="card border-success">
        <div class="card-header text-center">
            <h3><strong> Cepre IDEX Perú Japón - {{$cepre->periodoCepre}} </strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary"><strong>Total alumnos:</strong> {{count($estudiantes)}}</p>
        <table class="table table-hover">
            <thead>
              <tr>
                <th>DNI</th>
                <th>Apellido, Nombre</th>
                <th>Teléfonos</th>
                <th>Completo</th>
                <th>Resta</th>
                <th>Pagos</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{$estudiante->cliente->dniRuc}}</td>
                        <td>
                            <strong class="text-uppercase">{{$estudiante->cliente->apellido}}</strong>, <span class="text-capitalize">{{Str::lower($estudiante->cliente->nombre)}}</span>
                        </td>
                        <td>
                            {{$estudiante->cliente->telefono}} - {{$estudiante->cliente->telefono2}}
                        </td>
                        <td>
                            @if(ceprePorPagar($estudiante->idCepreEstudiante) == 0)
                               <span class="text-primary">SI</span>
                            @else
                                <span class="text-danger">NO</span>
                            @endif
                        </td>
                        <td style="text-align: right">
                            {{number_format(ceprePorPagar($estudiante->idCepreEstudiante),2)}}
                        </td>
                        <td>
                            <div class="btn-group dropleft">
                                <button type="button" 
                                    @if (count($estudiante->ceprePagos) == 0 )
                                        class="btn btn-danger dropdown-toggle"
                                    @else
                                        @if(ceprePorPagar($estudiante->idCepreEstudiante) == 0)
                                            class="btn btn-success dropdown-toggle"
                                        @else
                                        class="btn btn-warning dropdown-toggle"
                                        @endif
                                    @endif
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Pagos ({{count($estudiante->ceprePagos)}})
                                </button>
                                <div class="dropdown-menu">
                                    @foreach ($estudiante->ceprePagos as $pago)
                                    <a class="dropdown-item" href="#"><strong>Fecha:</strong> {{date('d-m-Y',strtotime($pago->fechaPago))}} <strong>Monto:</strong> {{$pago->montoPago}}</a>
                                    @endforeach
                                </div>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        
        </div>
        <div class="card-footer text-muted">
            Reporte Sistema SISGE-PJ
        </div>
    </div>
@endif



@stop
@section('js')
    <script>
	$(document).ready(function(){
    setTimeout(() => {
        $("#info").hide();
    }, 12000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
      }, 12000);
    });
	</script>
@stop