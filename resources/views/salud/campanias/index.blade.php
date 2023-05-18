@extends('adminlte::page')
@section('title', 'Gestion de Campañas')
@section('content_header')
<h1>Campañas de atencion.
    <a href="{{route('salud.campanias.create')}}" class="btn btn-success">
        <i class="fas fa-hospital"></i> Nueva Campaña
    </a>
</h1>
<p class="mt-2">puede subir los datos de forma masiva, recuerde respetar las columnas.. descarge el modelo desde <a target="_blank" href="https://drive.google.com/file/d/1-DsuhJj_gqClVh-XVtaQ4UurEVR0rV-0/view?usp=share_link">aca</a></p>
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
                    <th>Nombre</th>
                    <th>Fecha</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($campanias as $campania)
                    <tr>
                        <td>{{ $campania->nombre }}</td>
                        <td>{{ date('d-m-Y',strtotime($campania->fecha)) }}</td>
                        <td>
                            <a class="btn btn-info" data-toggle="modal" data-target="#modal-csv-{{ $campania->id }}">
                                <i class="fas fa-file-csv"></i>
                            </a>
                            <a href="{{ route('salud.campanias.edit',$campania->id) }}" class="btn btn-success" title="editar">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" title="eliminar">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                        @include('salud.campanias.modal')
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