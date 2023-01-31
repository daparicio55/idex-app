@extends('adminlte::page')
@section('title', 'Atenciones de Campañas')
@section('content_header')
<h1>Atenciones Realizadas.
    <a href="{{route('salud.acampanias.create')}}" class="btn btn-success">
        <i class="fas fa-hospital"></i> Nueva Atención
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
{{-- contenido --}}

<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Atencion</th>
                    <th>Fecha</th>
                    <th>Telefono</th>
                    <th>DNI</th>
                    <th>Alumno</th>
                    <th>Programa de Estudios</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($atenciones as $atencione)
                    <tr>
                        <td>{{ ceros($atencione->numero) }}</td>
                        <td>{{ $atencione->campania->nombre }}</td>
                        <td>{{ date('d-m-Y',strtotime($atencione->fecha)) }}</td>
                        <td>{{ $atencione->estudiante->postulante->cliente->telefono }}</td>
                        <td>{{ $atencione->estudiante->postulante->cliente->dniRuc }}</td>
                        <td>
                            <b class="text-uppercase">{{ $atencione->estudiante->postulante->cliente->apellido }},</b>
                            <span class="text-capitalize">{{ strtolower($atencione->estudiante->postulante->cliente->nombre) }}</span>
                        </td>
                        <td>{{ $atencione->estudiante->postulante->carrera->nombreCarrera }}</td>
                        <td>
                            <a data-toggle="modal" data-target="#modal-show-{{ $atencione->id }}" class="btn btn-info" title="mostrar atencion">
                                <i class="fa fa-eye"></i>
                            </a>
                            <a href="{{ route('salud.acampanias.edit',$atencione->id) }}" class="btn btn-success" title="editar atencion">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a data-toggle="modal" data-target="#modal-delete-{{ $atencione->id }}" class="btn btn-danger" title="eliminar atencion">
                                <i class="fa fa-trash"></i>
                            </a>
                            @include('salud.acampanias.modal')
                        </td>
                    </tr>
                @endforeach
            </tbody>
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
    })
    const frm = document.getElementById('frm');
    frm.addEventListener('submit',function(event){
        const txt = document.getElementById('searchText');
        if(txt.value.trim() == ""){
            event.preventDefault();
            alert('debe ingresar un criterio a buscar')
        }
    });
</script>
@stop