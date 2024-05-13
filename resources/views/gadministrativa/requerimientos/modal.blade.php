{!! Form::open(['route'=>['gadministrativa.requerimientos.destroy',$requerimiento->id],'method'=>'delete','id'=>'frm']) !!}
<x-adminlte-modal id="modal-delete-{{ $requerimiento->id }}" title="Confirmar accion" 
    size="md" theme="danger" icon="fas fa-exclamation-triangle" static-backdrop scrollable>
    ¿Esta seguro que desea eliminar este requerimiento del sistema? Recuerda que esta acción es irreversible.

    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" type="submit" theme="danger" label="Acceptar"/>
        <x-adminlte-button theme="secondary" label="Cerrar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>
{!! Form::close() !!}