<div>
    <x-adminlte-card title="Servicios" theme="warning" icon="fas fa-shopping-cart" collapsible>
        <div class="row">
            <div class="col-sm-12 col-md-8" wire:ignore>    
                <label>Servicio o Producto</label>
                <select class="form-control selectpicker" id="dt" data-live-search=true data-size=8>
                    <option value="" disabled selected>Seleccione un servicio o producto</option>
                    @foreach ($services as $service)
                        <option value="{{ $service->idServicio }}">{{ $service->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2">
                <label>Precio</label>
                <input type="number" min=1 step="1" class="form-control" wire:model="precio">
            </div>
            <div class="col-sm-2">
                <label>Cant.</label>
                <input type="number" min=1 step="1" class="form-control" wire:model="cantidad">
            </div>
            <div class="col-sm-12 mt-3 text-right">
                <button type="button" class="btn btn-warning" wire:click="addservicio">
                    <i class="far fa-plus-square"></i> Agregar
                </button>
            </div>
            <div class="col-sm-12 mt-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="bg-secondary">
                                <th class="pb-1">Cant.</th>
                                <th class="pb-1">Descripcion</th>
                                <th class="pb-1">Precio</th>
                                <th class="pb-1">Importe</th>
                                <th class="pb-1">
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $total = 0.00;
                            @endphp
                            @foreach ($items as $key=>$item)
                                <tr>
                                    <td class="pb-1">
                                        {{ $item['cantidad'] }}
                                        <input type="hidden" name="cantidades[]" value="{{ $item['cantidad'] }}">
                                    </td>
                                    <td class="pb-1">
                                        {{ $item['descripcion'] }}
                                        <input type="hidden" name="ids[]" value="{{ $item['idServicio'] }}">
                                    </td>
                                    <td class="pb-1">
                                        {{ $item['precio'] }}
                                        <input type="hidden" name="precios[]" value="{{ $item['precio'] }}">
                                    </td>
                                    <td class="pb-1">{{ number_format($item['cantidad'] * $item['precio'],2) }}</td>
                                    <td class="pb-1">
                                        <button class="btn btn-danger btn-sm" type="button" wire:click="delete({{ $key }})">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </td>
                                </tr>
                                @php
                                    $total = $total + ($item['cantidad'] * $item['precio']);
                                @endphp
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="pb-0 text-right">
                                    <h4><b>TOTAL:</b></h4>
                                </td>
                                <td colspan="2" class="pb-0 text-left">
                                    <b>S/. {{ number_format($total,2) }}</b>
                                    <input type="hidden" name="total" value="{{ $total }}">
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </x-adminlte-card>
    
</div>
<script>
    document.addEventListener('DOMContentLoaded',function(){
        $('#dt').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            @this.set('idServicio',this.value);
        });
    });
</script>