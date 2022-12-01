@extends('adminlte::page')
@section('title', 'Cepre Pagos')

@section('content_header')
    <h1>Lista de Pagos Cepre
		<a href="{{route('cepres.pagos.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Registrar Pago
		</a>
	</h1>
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
@include('cepres.pagos.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Año</th>
                    <th>DNI</th>
                    <th>Apellidos, Nombres</th>
                    <th>Pro. Estudio</th>
                    <th>Fecha</th>
                    <th>Tipo</th>
                    <th>Num.</th>
                    <th>Monto</th>
                    <th>Resta</th>
                </thead>
                @foreach ($ceprepagos as $ceprepago)
                <tr @if(ceprePorPagar($ceprepago->cepreEstudiante->idCepreEstudiante) == 0) style="color : green" @endif>
                    <td>{{$ceprepago->cepreEstudiante->cepre->periodoCepre}}</td>
                    <td>{{$ceprepago->cepreEstudiante->cliente->dniRuc}}</td>
                    <td><strong class="text-uppercase">{{$ceprepago->cepreEstudiante->cliente->apellido}}</strong>, <span class="text-capitalize">{{Str::lower($ceprepago->cepreEstudiante->cliente->nombre)}}</span></td>
                    <td>{{ $ceprepago->cepreEstudiante->carrera->nombreCarrera }}</td>
                    <td>{{date('d-m-Y',strtotime($ceprepago->fechaPago))}}</td>
                    <td>{{$ceprepago->tipoComprobante}}</td>
                    <td>{{ $ceprepago->numeroComprobante }}</td>
                    <td>{{$ceprepago->montoPago}}</td>
                    <td>{{ceprePorPagar($ceprepago->cepreEstudiante->idCepreEstudiante)}}</td>
                    <td>
                        <a class="btn btn-primary" href="{{route('cepres.pagos.edit',['pago'=>$ceprepago->idCeprePago])}}">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger" data-target="#modal-delete-{{$ceprepago->idCeprePago}}" data-toggle="modal" href="">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                    @include('cepres.pagos.modal')
                </tr> 
                @endforeach
            </table>
        </div>
    </div>
</div>
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