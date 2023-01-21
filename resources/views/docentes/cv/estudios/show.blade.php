@extends('adminlte::page')
@section('title', 'Mostrar Estudio')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Consulta de Datos de la formacion Profesional:</h3>
	</div>
</div>


<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="esTitulo">Titulo Obtenido.</label>
            <input type="text" name="esTitulo" disabled value="{{$estudio->esTitulo}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="esInstitucion">Institucion formadora.</label>
            <input type="text" name="esInstitucion" disabled value="{{$estudio->esInstitucion}}" required class="form-control">
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esAnioInicio">Año Inicio</label>
            <input type="number" name="esAnioInicio" disabled value="{{$estudio->esAnioInicio}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="telefono">Año Fin</label>
            <input type="number" name="esAnioFin" disabled value="{{$estudio->esAnioFin}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esCiudad">Ciudad</label>
            <input type="text" name="esCiudad" disabled value="{{$estudio->esCiudad}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esDepartamento">Departamento</label>
            <input type="text" name="esDepartamento" disabled value="{{$estudio->esDepartamento}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="esPais">Pais</label>
            <input type="text" name="esPais" disabled value="{{$estudio->esPais}}" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="esDescripcion">Describa su formacion brevemente</label>
            <textarea name="esDescripcion" cols="30" disabled rows="5" class="form-control">{{$estudio->esDescripcion}}</textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
       <a class="btn btn-danger btn-lg" id="btn_cancelar" href="{{ route('docentes.cv.estudios.index') }}"><i class="fa fa-ban" aria-hidden="true"></i> Regresar</a>
    </div>
</div>
@stop