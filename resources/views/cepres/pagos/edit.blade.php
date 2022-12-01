@extends('adminlte::page')
@section('title', 'Pagos Editar')
@section('content_header')
    <h1>Editar Pago Cepre</h1>
@stop

@section('content')
{!! Form::model($ceprepago, ['route'=>['cepres.pagos.update',$ceprepago],'method'=>'put','autocomplete'=>'off','id'=>'frm_datos','name'=>'frm_datos']) !!}
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <div class="form-group">
                    <label>Registrar pago a:</label>
                    <select disabled name="idCepreEstudiante" class="form-control selectpicker" id="idCepreEstudiante" data-live-search="true" data-size="5">
                            <option value="0">Seleccione una matricula de la cepre</option>
                            @foreach($cepreEstudiantes as $estudiante)
                            <option value="{{$estudiante->idCepreEstudiante}}" @if($estudiante->idCepreEstudiante == $ceprepago->idCepreEstudiante) selected @endif>
                                {{$estudiante->nombre}}
                            </option>
                            @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- mostramos los datos para completar --}}
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <label for="">Tipo de Comprobante</label>
                <select class="form-control" name="tipoComprobante" id="tipoComprobante"  aria-label="Default select example">
                    <option value="Boleta" @if($ceprepago->tipoComprobante == 'Boleta') selected @endif>Boleta</option>
                    <option value="Recibo" @if($ceprepago->tipoComprobante == 'Recibo') selected @endif>Recibo</option>
                </select>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class='form-group'>
                    <label for="numeroComprobante">N° Comprobante</label>
                    {!! Form::text('numeroComprobante', null, ['class'=>'form-control','id'=>'numeroComprobante']) !!}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class='form-group'>
                    <label for="montoPago">Monto</label>
                    {!! Form::number('montoPago', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                <div class='form-group'>
                    <label for="montoPago">Fecha</label>
                    {!! Form::date('fechaPago', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " id="botones">
    <div class="form-group">
        <button class="btn btn-primary" type="submit" id="bt_guardar">
            <i class="far fa-save"></i> Guardar
        </button>
        <a class="btn btn-danger" href="{{url('cepres/pagos/')}}"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>

{!! Form::close() !!}
@stop
@section('js')
<script>
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
    $('#tipoComprobante').change(function(){
        valor = $('#tipoComprobante').val();
        if (valor == 'Recibo'){
            $('#numeroComprobante').attr("disabled",true)
        }else{
            $('#numeroComprobante').attr("disabled",false)
        }
    });
</script>
@stop