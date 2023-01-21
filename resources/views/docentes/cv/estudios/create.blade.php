@extends('adminlte::page')
@section('title', 'Registrar Estudios')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de Grados Profesionales:</h3>
	</div>
</div>
{!! Form::open(array('route'=>'docentes.cv.estudios.store','method'=>'POST','autocomplete'=>'off')) !!}
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="esTitulo">Grado Académico.</label>
            <input type="text" name="esTitulo" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="esMencion">Mensión.</label>
            <input type="text" name="esMencion" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="esInstitucion">Institucion formadora.</label>
            <input type="text" name="esInstitucion" required class="form-control">
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esAnioInicio">Año Inicio</label>
            <input type="number" name="esAnioInicio" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="telefono">Año Fin</label>
            <input type="number" name="esAnioFin" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esCiudad">Ciudad</label>
            <input type="text" name="esCiudad" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esDepartamento">Departamento</label>
            <input type="text" name="esDepartamento" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esPais">Pais</label>
            <input type="text" name="esPais" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="esDescripcion">Describa su formacion brevemente</label>
            <textarea name="esDescripcion" cols="30" rows="5" class="form-control"></textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <button class="btn btn-primary btn-lg" type="submit" id="bt_guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        <a class="btn btn-danger btn-lg" id="btn_cancelar" name="btn_cancelar"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>
{!! Form::close() !!}
@stop