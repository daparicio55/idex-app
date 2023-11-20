<x-Modal>
    <form wire:submit="store_capacidade">
        <div class="card">
            <div class="card-header bg-info">
                <h5>
                    <i class="fas fa-cubes"></i> Crear nueva Capacidad
                </h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nombre:</label>
                    <input required type="text" class="form-control" wire:model="capacidadecreate.nombre">
                    <label>Descripcion:</label>
                    <textarea required class="form-control" wire:model="capacidadecreate.descripcion" rows=3></textarea>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" wire:click="$set('capacidadecreate.modal',false)" class="btn btn-danger"> 
                    <i class="far fa-times-circle"></i> Cerrar
                </button>
                <Button type="submit" class="btn btn-info">
                    <i class="far fa-save"></i> Guardar
                </Button>
            </div>
        </div>
    </form>
</x-Modal>