<x-Modal>
    <form wire:submit="store_udidactica">
        <div class="card">
            <div class="card-header bg-success">
            Registra nueva Unidad Didáctica
            </div>
            <div class="card-body">                          
            <div class="form-group">
                <label for="nombre">Nombre:</label>
                <textarea rows="2" type="nombre" class="form-control" required wire:model="udidacticacreate.nombre"></textarea>
                <label for="tipo">Tipo:</label>
                <select class="form-control" required wire:model="udidacticacreate.tipo">
                    <option value="" disabled selected>Seleccione un tipo</option>
                    @foreach (tUnidades() as $item)
                        <option wire:key="tipo-{{ $item }}" value="{{ $item }}">{{ $item }}</option>
                    @endforeach
                </select>
                <label for="ciclo">Ciclo:</label>
                <select class="form-control" required wire:model="udidacticacreate.ciclo">
                    <option value="" disabled selected>Seleccione un ciclo</option>
                    @foreach (ciclos() as $ciclo)
                        <option wire:key="ciclo-{{ $ciclo }}" value="{{ $ciclo }}">{{ $ciclo }}</option>
                    @endforeach
                </select>
                <label for="">Horas:</label>
                <input type="number" min="1" step="1" class="form-control" required wire:model="udidacticacreate.horas">
                <label for="">Créditos</label>
                <input type="number" min="1" step="0.5" class="form-control" required wire:model="udidacticacreate.creditos">
                <label for="">Moodel CODE</label>
                <input type="text" class="form-control" required wire:model="udidacticacreate.moodle">
                <label for="">Orden</label>
                <input type="number" min="0" class="form-control" required wire:model="udidacticacreate.orden">
            </div>
            </div>
            <div class="card-footer text-right">
                <button type="button" wire:click="$set('udidacticacreate.modal',false)" class="btn btn-danger"> 
                    <i class="far fa-times-circle"></i> Cerrar
                </button>
                <Button type="submit" class="btn btn-success">
                    <i class="far fa-save"></i> Guardar
                </Button>
            </div>
        </div>
    </form>
</x-Modal>