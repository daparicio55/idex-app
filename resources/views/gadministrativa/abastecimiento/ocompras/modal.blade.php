{!! Form::open(['route'=>['gadministrativa.abastecimiento.ocompras.destroy',$ocompra->id],'method'=>'delete','id'=>'frm']) !!}
<x-adminlte-modal id="modal-delete-{{ $ocompra->id }}" title="Confirmar accion" 
    size="md" theme="danger" icon="fas fa-exclamation-triangle" static-backdrop scrollable>
    ¿Esta seguro que desea eliminar esta orden de compra del sistema? Recuerda que esta acción es irreversible.

    <x-slot name="footerSlot">
        <x-adminlte-button class="mr-auto" type="submit" theme="danger" label="Acceptar"/>
        <x-adminlte-button theme="secondary" label="Cerrar" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>
{!! Form::close() !!}