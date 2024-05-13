{!! Form::open(['route'=>['gadministrativa.administracion.catalogos.destroy',$catalogo->id],'method'=>'delete','id'=>'frm']) !!}
<x-adminlte-modal id="modal-delete-{{ $catalogo->id }}" title="Confirmar acción" size="md" theme="danger"
    icon="fas fa-exclamation-triangle" v-centered static-backdrop scrollable>
    ¿Esta seguro de eliminar este catálogo del sistema? Recuerde que este proceso es irreversible.
    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" theme="danger" type="submit" label="Eliminar" icon="fas fa-trash-alt" />
        <x-adminlte-button theme="secondary" label="Cerrar" icon="fas fa-window-close" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>
{!! Form::close() !!}
