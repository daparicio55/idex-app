@extends('adminlte::page')
@section('title', 'Registrar Experiencia')
@section('content')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de Datos de la Experiencia Laboral:</h3>
	</div>
</div>
{!! Form::open(array('route'=>'docentes.cv.experiencias.store','method'=>'POST','autocomplete'=>'off')) !!}
{!! Form::token() !!}

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="exEmpresa">Nombre de la Empresa.</label>
            <input type="text" name="exEmpresa" required class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="exCargo">Cargo Ocupado.</label>
            <input type="text" name="exCargo" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exFechaInicio">Fecha Inicio</label>
            <input type="date" name="exFechaInicio" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exFechaFin">
                Fecha Fin
                <small>
                    {!! Form::checkbox('exActual', null, null, ['id'=>'chkactual']) !!}
                    actual
                </small>
            </label>
            
            <input type="date" id="exFechaFin" name="exFechaFin" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exCiudad">Ciudad</label>
            <input type="text" name="exCiudad" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exDepartamento">Departamento</label>
            <input type="text" name="exDepartamento" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exPais">Pais</label>
            <input type="text" name="exPais" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="exSector">Sector</label>
            {{-- <input type="text" name="exSector" required class="form-control"> --}}
            {!! Form::select('exSector', $exSector, null, ['class'=>'form-control']) !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="exTareas">Describa sus labores en la Empresa/Institucion</label>
            <textarea name="exTareas" cols="30" rows="5" class="form-control"></textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <button class="btn btn-primary btn-lg" type="submit" id="bt_guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
{!! Form::close() !!}
<a class="btn btn-danger btn-lg" href="{{ route('docentes.cv.experiencias.index') }}"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>
@stop
@section('js')
<script>
    const chk = document.getElementById('chkactual');
    const fin = document.getElementById('exFechaFin');
    chk.addEventListener('change',function(){
        if (chk.checked){
            fin.disabled=true;
            fin.required=false;
        }else{
            fin.disabled=false;
            fin.required=true;
        }
    });
</script>
@stop