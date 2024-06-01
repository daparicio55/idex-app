@extends('adminlte::page')

@section('title', 'Registro de trámite')

@section('content_header')
    <h1>Registro de nuevo trámite</h1>
@stop

@section('content')
@include('gadministrativa.administracion.tramites.mcatalogo')
{!! Form::open(['route'=>'gadministrativa.administracion.tramites.store','method'=>'POST','id','frm']) !!}
<x-adminlte-card title="Requerimientos Tramitados" theme="info" icon="fas fa-lg fa-fan" collapsible>
    <select name="requerimiento" id="requerimiento" class="form-control selectpicker" title="Nada seleccionado" data-live-search="true" data-size="10">
        @foreach ($requerimientos as $requerimiento)
            {{-- <option value="{{ $requerimiento->id }}">{{ ceros($requerimiento->numero) }} - {{ $requerimiento->encabezado }} - {{ $requerimiento->asunto }}</option> --}}
            <option value="{{ $requerimiento['id'] }}">{{ $requerimiento['nombre'] }}</option>
        @endforeach
    </select>
    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" id="btn_aceptar" onclick="selectTramite('{{ asset('') }}')">
            <i class="fas fa-check-square"></i> Aceptar
        </button>
    </x-slot>
</x-adminlte-card>
<div class="card" data-toggle="collapse">
    <div class="card-header bg-primary">
        <h3 class="card-title">
            <i class="fas fa-list-ol"></i> Detalles del requerimiento
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-lg fa-minus"></i>     
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tbody id="requerimientos">
                    
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary">
            <i class="fas fa-save"></i> Guardar
        </button>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop

@section('js')
<script src="{{ asset('js/gacademica/administracion/requerimientos/main.js') }}"></script>
<script src="{{ asset('js/carga.js') }}"></script>
<script>
    $('#catalogos').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    // do something...
    var datosJs = <?php echo json_encode($catalogos); ?>;
    datosJs.forEach(element => {
        if(element.id == this.value){
            $('#cantidad').val(element.almacen);
        }
    });
});
</script>
@stop