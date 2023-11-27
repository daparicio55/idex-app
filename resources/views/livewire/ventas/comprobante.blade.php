<div>
    <x-adminlte-card title="Comprobante" theme="danger" icon="fas fa-clipboard-list" collapsible>
        <div class="row">
            <div class="col-sm-12 col-md-3">
                <label>Comprobante</label>
                <select name="tipo" id="tipo" class="form-control" wire:model="tipo" required>
                    <option value="Boleta" selected>Boleta</option>
                    <option value="Factura">Factura</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-3">
                <label>Numero</label>
                <input type="number" name="numero" id="numero" class="form-control" @hasrole('Caja') readonly @endrole wire:model="numero" required/>
            </div>
            <div class="col-sm-12 col-md-3">
                <label>Fecha</label>
                <input type="date" name="fecha" id="fecha" class="form-control" wire:model="fecha" required/>
            </div>
            <div class="col-sm-12 col-md-3">
                <label>T. Pago</label>
                <select name="tpago" id="tpago" class="form-control" wire:model="tpago" required>
                    <option value="Contado" selected>Contado</option>
                    <option value="Transferencia">Transferencia</option>
                    <option value="Credito">Credito</option>
                </select>
            </div>
            <div class="col-sm-12 col-md-12 mt-2">
                <label>Observacion</label>
                <input type="text" name="observacion" id="observacion" class="form-control" wire:model="observacion" required />
            </div>
        </div>
    </x-adminlte-card>
</div>
