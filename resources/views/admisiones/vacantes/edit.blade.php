@extends('adminlte::page')
@section('title', 'Vacantes Registrar')
@section('content_header')
    <h1>Editar cantidad de Vacantes</h1>
@stop

@section('content')
{!! Form::model($vacante, ['id'=>'frm_datos','autocomplete'=>'off','method'=>'put','route'=>['admisiones.vacantes.update',$vacante->id]]) !!}

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-user-graduate"></i> Datos de las Vacantes.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        <div class='form-group'>
                            <label for="carrera_id">Programa de Estudios</label>
                            {!! Form::select('carrera_id', $carreras,null, ['class'=>'form-control selectpicker']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="cantidad">Vacantes</label>
                            {!! Form::number('cantidad', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
        <div class="form-group">
            <button class="btn btn-primary btn-lg" type="submit" id='bt_guardar' name='bt_guardar'>
                <i class="far fa-save"></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{url(asset('admisiones/vacantes/?id='.$vacante->admisione_id))}}">
                <i class="fas fa-undo-alt"></i> Regresar
            </a>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
</script>
@stop