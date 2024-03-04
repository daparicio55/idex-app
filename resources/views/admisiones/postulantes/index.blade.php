@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1>Lista de Postulantes IDEX
		<a href="{{route('admisiones.postulantes.create')}}" class="btn btn-success">
			<i class="far fa-file"></i> Nuevo Postulante
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
@include('admisiones.postulantes.search')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th></th>
                    <th>Exp.</th>
                    <th>T. Modalidad</th>
                    <th>DNI</th>
                    <th>Apellidos, Nombres</th>
                    <th>Carrera</th>
                    <th>Periodo</th>
                    <th>Fecha</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($postulantes as $postulante)
                    <tr @if($postulante->anulado == "SI") class="text-danger" @endif>
                        <td>
                                @if($postulante->anulado == "NO")
                                    <a href="" data-target="#modal-anular-{{$postulante->id}}" title="anular la inscripcion" data-toggle="modal" class="btn btn-warning">
                                        <i class="fas fa-ban"></i>
                                    </a>
                                @else
                                    <a href="" data-target="#modal-anular-{{$postulante->id}}" title="reactivar la inscripcion" data-toggle="modal" class="btn btn-info">
                                        <i class="fas fa-check"></i>
                                    </a>
                                @endif
                        </td>
                        <td>
                            @php
                                $largo = Str::length($postulante->expediente);
                                if($largo == 1){
                                    $expediente = '00'.$postulante->expediente;
                                }
                                if($largo == 2){
                                    $expediente = '0'.$postulante->expediente;
                                }
                                if($largo == 3){
                                    $expediente = $postulante->expediente;
                                }
                            @endphp
                            {{$expediente}}
                        </td>
                        <td>{{$postulante->modalidadTipo}}</td>
                        <td>{{$postulante->cliente->dniRuc}}</td>
                        <td><strong class="text-uppercase">{{$postulante->cliente->apellido}}</strong>, <span class="text-capitalize">{{Str::lower($postulante->cliente->nombre)}}</span> </td>
                        <td>{{$postulante->carrera->nombreCarrera}}</td>
                        <td>{{$postulante->admisione->periodo}}</td>
                        <td style="width: 100px">{{date('d-m-Y',strtotime($postulante->fecha))}}</td>
                        <td style="text-align: center; width: 160px">
                            <a class="btn btn-info" target="_blank" href="{{route('admisiones.postulantes.show',['postulante'=>$postulante->id])}}">
                                <i class="fa fa-print" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-success" href="{{route('admisiones.postulantes.edit',['postulante'=>$postulante->id])}}">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" data-target="#modal-delete-{{$postulante->id}}" data-toggle="modal" href="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                        @include('admisiones.postulantes.delete')
                    </tr> 
                    @endforeach
                </tbody>
                @if (method_exists($postulantes, 'links'))
                    <caption>
                        {{ $postulantes->links() }}
                    </caption>                
                @endif
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