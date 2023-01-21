@extends('adminlte::page')
@section('title', 'Editar Estudio')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de formacion Profesional:</h3>
	</div>
</div>
{!! Form::model($estudio, ['method'=>'PATCH','route'=>['docentes.cv.estudios.update',$estudio->id]]) !!}
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="esTitulo">Grado Académico.</label>
            <input type="text" name="esTitulo" required class="form-control" value="{{$estudio->esTitulo}}">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="esMencion">Mensión.</label>
            <input type="text" name="esMencion" value="{{$estudio->esMencion}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class='form-group'>
            <label for="esInstitucion">Institucion formadora.</label>
            <input type="text" name="esInstitucion" value="{{$estudio->esInstitucion}}" required class="form-control">
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esAnioInicio">Año Inicio</label>
            <input type="number" name="esAnioInicio" value="{{$estudio->esAnioInicio}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="telefono">Año Fin</label>
            <input type="number" name="esAnioFin" value="{{$estudio->esAnioFin}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esCiudad">Ciudad</label>
            <input type="text" name="esCiudad" value="{{$estudio->esCiudad}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esDepartamento">Departamento</label>
            <input type="text" name="esDepartamento" value="{{$estudio->esDepartamento}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esPais">Pais</label>
            <input type="text" name="esPais" value="{{$estudio->esPais}}" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="esDescripcion">Describa su formacion brevemente</label>
            <textarea name="esDescripcion" cols="30" rows="5" class="form-control">{{$estudio->esDescripcion}}</textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <button class="btn btn-primary btn-lg" type="submit" id="bt_guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
        
{!! Form::close() !!}
<a class="btn btn-danger btn-lg" href="{{ route('docentes.cv.estudios.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>
@stop