@extends('adminlte::page')
@section('title', 'Mostrar Experiencia')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de Datos de la Experiencia Laboral:</h3>
	</div>
</div>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="exEmpresa">Nombre de la Empresa.</label>
            <input type="text" name="exEmpresa" disabled value="{{$experiencia->exEmpresa}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="exCargo">Cargo Ocupado.</label>
            <input type="text" name="exCargo" disabled value="{{$experiencia->exCargo}}" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exFechaInicio">Fecha Inicio</label>
            <input type="date" name="exFechaInicio" disabled value="{{$experiencia->exFechaInicio}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exFechaFin">Fecha Fin</label>
            <input type="date" name="exFechaFin" disabled value="{{$experiencia->exFechaFin}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exCiudad">Ciudad</label>
            <input type="text" name="exCiudad" disabled value="{{$experiencia->exCiudad}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exDepartamento">Departamento</label>
            <input type="text" name="exDepartamento" disabled value="{{$experiencia->exDepartamento}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exPais">Pais</label>
            <input type="text" name="exPais" disabled value="{{$experiencia->exPais}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exSector">Sector</label>
            <input type="text" name="exSector" disabled value="{{$experiencia->exSector}}" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="exTareas">Describa sus labores en la Empresa/Institucion</label>
            <textarea name="exTareas" disabled cols="30" rows="5" class="form-control">{{$experiencia->exTareas}}</textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <a class="btn btn-danger btn-lg" href="{{ route('docentes.cv.experiencias.index') }}"><i class="fa fa-ban" aria-hidden="true"></i> Regresar</a>
    </div>
</div>
@stop