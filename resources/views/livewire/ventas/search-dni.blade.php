<div>
    {{-- Nothing in the world is as soft and yielding as water. --}}
    
        <x-adminlte-card title="Buscar" theme="info" icon="fas fa-search-plus" collapsible>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text text-info">
                        <i class="fas fa-id-card"></i>
                    </label>
                </div>
                <input type="text" class="form-control" name="dni"  placeholder="ingrese texto dni ruc" wire:model="txtbuscar" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-info" type="button" wire:click="buscardni">
                        Buscar
                    </button>
                </div>
              </div>
        </x-adminlte-card>
    
    <x-adminlte-card title="Datos Personales" theme="success" icon="fas fa-users" collapsible>
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <label>Apellidos</label>
                <input type="text" name="apellido" id="apellido" wire:model="apellido" class="form-control" required>
            </div>
            <div class="col-sm-12 col-md-6">
                <label>Nombres</label>
                <input type="text" name="nombre" id="nombre" wire:model="nombre" class="form-control" required>
            </div>
            <div class="col-sm-12 col-md-4">
                <label class="mt-2">Telefono</label>
                <input type="text" name="telefono" id="telefono" wire:model="telefono" class="form-control" required>
            </div>
            <div class="col-sm-12 col-md-4">
                <label class="mt-2">Telefono 2</label>
                <input type="text" name="telefono2" id="telefono2" wire:model="telefono2" class="form-control" required>
            </div>
            <div class="col-sm-12 col-md-4">
                <label class="mt-2">Correo</label>
                <input type="email" name="email" id="email" wire:model="email" class="form-control" required>
            </div>
            <div class="col-sm-12 col-md-12">
                <label class="mt-2">Dirección</label>
                <input type="text" name="direccion" id="direccion" wire:model="direccion" class="form-control" required>
            </div>
        </div>
    </x-adminlte-card>
</div>
