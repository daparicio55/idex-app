@extends('adminlte::page')
@section('title','Inicio')
@section('content_header')
    <h1>Sisge Perú Japón - Sistema de Gestión</h1>
@stop
@section ('content')
<div class="row">
    @can('dashboard.postulaciones.index')
        <p>Estudiantes</p>
    @endcan
    <img src="{{asset('img/bg.webp')}}" class="rounded mx-auto d-block img-fluid">
</div>       
@stop
@section('footer')
    Sistema de Gestion v0.9.8 <small class="text-primary">© Todos los derechos reservados Oficina de Soporte TI 2023</small>
@endsection