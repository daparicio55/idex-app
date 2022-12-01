@extends('adminlte::page')
@section('title', 'Deudas Pagar')
@section('content_header')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <h3>Pago de Deudas: <b> {{$deudas->dniRuc}} {{$deudas->apellido}} {{$deudas->nombre}} </b></h3>
    </div>
</div>
@stop

@section('content')
<div class="row">
	
    <div class="col-lg-8 col-md-8 col-sm-8 col- xs-12">
        <label for="">Deuda Número: {{$deudas->numero}}</label>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <label for="">Fecha: {{date('d-m-Y',strtotime($deudas->fDeuda))}}</label>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <label for="">Servicio: {{$deudas->nombreServicio}}</label>
    </div>
    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
        <label for="">Observacion: {{$deudas->observacion}}</label>
    </div>
</div>
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
                      <thead style="background-color:#A9D0F5">
                            <th style="width: 5%">Num.</th>
                            <th>Fecha</th>
                            <th>Estado</th>
                            <th>Pago</th>
                            <th>Boleta N°</th>
                      </thead>
                      <tbody>
                        @foreach ($deudasDetalles as $DeDe)
                            <tr>
                                <td>{{$DeDe->orden}}</td>
                                <td>{{date('d-m-Y',strtotime($DeDe->fechaPrograma))}}</td>
                                <td>{{$DeDe->estado}}</td>
                                <td>{{$DeDe->monto}}</td>
                                <td style="width: 15%">@if ($DeDe->boletaNumero == NULL) sin pago registrado @else {{$DeDe->boletaNumero}} @endif</td>
                                <td style="text-align: center; width: 15%">
                                    <a href="" data-target="#modal-pagar-{{$DeDe->idDeDe}}" data-toggle="modal" @if ($DeDe->boletaNumero != NULL) hidden @endif>
                                        <button class="btn btn-info" title="pagar"><i class="fas fa-dollar-sign"></i>
                                        </button>
                                    </a>
                                    <a href="" data-target="#modal-eliminar-{{$DeDe->idDeDe}}" data-toggle="modal" @if ($DeDe->boletaNumero == NULL) hidden @endif>
                                        <button class="btn btn-danger" title="eliminar"><i class="fa fa-trash" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                    <a href="{{URL('ventas/deudas/impriAmortizacion/'.$DeDe->idDeDe)}}" @if ($DeDe->boletaNumero == NULL) hidden @endif>
                                        <button class="btn btn-warning" title="eliminar"><i class="fa fa-print" aria-hidden="true"></i>
                                        </button>
                                    </a>
                                </td>
                                @include('ventas.deudas.modal')
                            </tr>
                        @endforeach
                      </tbody>
                </table>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group" style="text-align: center">
            <button name="bt_cancelar" id="bt_cancelar" class="btn btn-danger btn-lg" type="reset">Atras</button>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $(document).ready(function()
    {
        $('#bt_cancelar').click(function(){
            window.location.href="/ventas/deudas/";
        });
    });
</script>
@stop
