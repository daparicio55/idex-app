<x-adminlte-modal id="modal-unidad" title="Nueva unidad" size="md" theme="info"
    icon="fas fa-tag" v-centered static-backdrop scrollable>
    <div class="row">
        <div class="col-sm-12">
            {!! Form::label('newUnidad', "Nombre", [null]) !!}
            {!! Form::text('newUnidad', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" onclick="createUnidade('{{ route('gadministrativa.administracion.unidades.store') }}')">
            <i class="fas fa-save"></i> Guardar
        </button>
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>