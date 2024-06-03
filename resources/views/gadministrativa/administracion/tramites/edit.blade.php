@extends('adminlte::page')

@section('title', 'Registro de trámite')

@section('content_header')
    <h1>Registro de nuevo trámite</h1>
@stop

@section('content')
@include('gadministrativa.administracion.tramites.mcatalogo')
{!! Form::open(['route'=>['gadministrativa.administracion.tramites.update',$tramite->id],'method'=>'PUT','id'=>'frm']) !!}
<x-adminlte-card title="Requerimientos Tramitados" theme="info" icon="fas fa-lg fa-fan" collapsible>
    <input type="hidden" name="requerimiento" id="requerimiento">
    <input type="text" class="form-control" value="{{ $tramite->requerimiento->encabezado }}" readonly>

    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" id="btn_aceptar" disabled>
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
                    {{-- <tr>
                        <td>{{ $tramite->requerimiento->re_detalles }}</td>
                    </tr> --}}
                    @foreach ($tramite->requerimiento->re_detalles as $detalle)
                        <tr id="fila{{ $detalle->id }}">
                            <td>{{ $detalle->producto->nombre }}</td>
                            <td>{{ $detalle->observacion }}</td>
                            <td id="cantidad{{ $detalle->id }}">{{ $detalle->cantidad }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" title="Agregar un catálogo al requerimiento" onclick="add_catalogo({{ $detalle->id }})">
                                    <i class="fas fa-plus-square"></i>
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="4">
                                <table class="table">
                                    <thead>
                                        <th>Catálogo</th>
                                        <th>Destino</th>
                                        <th>Cantidad</th>
                                        <th></th>
                                    </thead>
                                    <tbody id="catalogo{{ $detalle->id }}">
                                        @foreach ($detalle->tdetalles as $item)
                                            @php
                                                $idCatalogo[] = $item->catalogo->id
                                            @endphp
                                            <tr id="cat{{ $item->catalogo->id }}">
                                                <td>
                                                    {{ $item->catalogo->codigo }} - {{ $item->catalogo->marca->nombre }} - {{ $item->catalogo->modelo }} - x {{ $item->catalogo->unidade->nombre }}
                                                    <input type="hidden" name="elementos[]" value="{{ $item->rdetalle_id }}:{{ $item->catalogo->id }}">
                                                </td>
                                                <td>
                                                    <select name="destinos[]" class="form-control">
                                                        <option value="Almacen" @if($item->destino == "Almacen") selected @endif>Almacen</option>
                                                        <option value="Abastecimiento" @if($item->destino == "Abastecimiento") selected @endif>Abastecimiento</option>
                                                        <option value="Caja Chica" @if($item->destino == "Caja Chica") selected @endif>Caja Chica</option>
                                                    </select>
                                                </td>
                                                <td style="width: 150px">
                                                    <input type="number" name="cantidades[]" min="1" class="form-control" value="{{ $item->cantidad }}">
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-danger" onclick="cat_remove({{ $item->catalogo->id }})"><i class="fas fa-trash-alt"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    @endforeach
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
    let ids = {{ json_encode($idCatalogo) }};
    ids.forEach(element => {
        $('#catalogos option[value="'+element+'"]').attr('disabled','disabled');
    });
</script>
@stop