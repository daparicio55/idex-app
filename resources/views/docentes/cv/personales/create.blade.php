@extends('adminlte::page')
@section('title', 'Crear Hoja de Vida')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de Datos Personales:</h3>
	</div>
</div>
{!! Form::open(array('id'=>'frm_datos','frm_datos'=>'','route'=>'docentes.cv.personales.store','method'=>'POST','autocomplete'=>'off','files' => true,'enctype'=>'multipart/form-data')) !!}
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="apellido">Apellidos</label>
            <input type="text" name="apellidos" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="nombres">Nombres</label>
            <input type="text" name="nombres" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="dni">DNI</label>
            <input type="text" name="dni" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="perCiudad">Ciudad</label>
            <input type="text" name="perCiudad" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="perDepartamento">Departamento</label>
            <input type="text" name="perDepartamento" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="correoInstitucional">Correo Institucional</label>
            <input type="text" name="correoInstitucional" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="perTitulo">Titulo Profesional</label>
            <input type="text" name="perTitulo" class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class="form-group">
            <label for="perTitulo">N. Colegiatura</label>
            <input type="text" name='ncolegiatura' value="{{ $personal->ncolegiatura }}" class="form-control">
        </div>
    </div>2
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="file">Foto de Perfil</label>
            <input type="file" name="file" class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="perPerfil">Describa su perfil brevemente</label>
            <textarea name="perPerfil" cols="30" rows="5" class="form-control"></textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <button class="btn btn-primary btn-lg" type="submit" id="btn_guardar" name="btn_guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
{!! Form::close() !!}
        <a class="btn btn-danger btn-lg" href="{{ route('docentes.cvs.index') }}"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>
@stop
@section('js')
<script>
    $("#frm_datos").submit(function( event ) {
        $("#btn_guardar").attr("disabled",true);
    });
</script>
@stop