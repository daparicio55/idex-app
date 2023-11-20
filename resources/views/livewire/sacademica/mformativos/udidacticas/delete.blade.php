<x-Modal>
    <form wire:submit="destroy_udidactica">
        <div class="card">
            <div class="card-header bg-danger">
                <i class="fas fa-exclamation-triangle"></i> Confirmar Acction
            </div>
            <div class="card-body">                          
            <p>¿Esta seguro que desea eliminar esta unidad didáctica?</p>
            </div>
            <div class="card-footer text-right">
                <button type="button" wire:click="$set('udidacticadelete.modal',false)" class="btn btn-secondary"> 
                    <i class="far fa-times-circle"></i> Cerrar
                </button>
                <Button type="submit" class="btn btn-danger">
                    <i class="far fa-trash-alt"></i> Eliminar
                </Button>
            </div>
        </div>
    </form>
</x-Modal>