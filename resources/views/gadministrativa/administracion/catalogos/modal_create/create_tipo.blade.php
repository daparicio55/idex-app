<x-adminlte-modal id="modal-tipo" title="Nuevo tipo" size="md" theme="info"
    icon="fas fa-tag" v-centered static-backdrop scrollable>
    <div class="row">
        <div class="col-sm-12">
            {!! Form::label('newTipo', "Nombre", [null]) !!}
            {!! Form::text('newTipo', null, ['class'=>'form-control']) !!}
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="button" class="btn btn-info" onclick="createTipo('{{ route('gadministrativa.administracion.tipos.store') }}')">
            <i class="fas fa-save"></i> Guardar
        </button>
        <x-adminlte-button theme="danger" label="Cancelar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>