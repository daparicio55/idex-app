<div>
    @if($udidacticacreate->modal)
        @include('livewire.sacademica.mformativos.udidacticas.create')
    @endif
    @if ($udidacticaedit->modal)
        @include('livewire.sacademica.mformativos.udidacticas.edit')
    @endif
    @if ($udidacticadelete->modal)
        @include('livewire.sacademica.mformativos.udidacticas.delete')
    @endif
    @if ($capacidadecreate->modal)
        @include('livewire.sacademica.mformativos.udidacticas.capacidades.create')
    @endif
    @if ($capacidadeedit->modal)
        @include('livewire.sacademica.mformativos.udidacticas.capacidades.edit')
    @endif
    @if ($capacidadedelete->modal)
        @include('livewire.sacademica.mformativos.udidacticas.capacidades.delete')
    @endif
    @if ($indicatorcreate->modal)
        @include('livewire.sacademica.mformativos.udidacticas.indicadores.create')
    @endif
    @if ($indicatoredit->modal)
        @include('livewire.sacademica.mformativos.udidacticas.indicadores.edit')
    @endif
    @if ($indicatordelete->modal)
        @include('livewire.sacademica.mformativos.udidacticas.indicadores.delete')
    @endif
        <div class="row">
            <div class="col-sm-12 mb-3">
                <h1>Unidades Didacticas</h1>
                <h5>{{ $mformativo->nombre }}</h5>
                <a href="{{ url('sacademica/mformativos') }}" title="regresar" class="btn btn-primary">
                    <i class="far fa-arrow-alt-circle-left"></i> Regresar
                </a>
                <button type="button" class="btn btn-success" wire:click="create_udidactica()">
                    <i class="far fa-file"></i> Nuevo
                </button>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                            <th>Ord.</th>
                            <th>Tipo</th>
                            <th>Unidad Didactica</th>
                            <th>Horas</th>
                            <th>Creditos</th>
                            <th>Ciclo</th>
                            <th>Moodle</th>
                            <th></th>
                        </thead>
                        <tbody>
                            @foreach ($unidades as $unidad)
                                <tr wire:key="udrow{{ $unidad->id }}">
                                    <td class="text-center">
                                        {{ $unidad->orden }}
                                    </td>
                                    <td>{{ $unidad->tipo }}</td>
                                    <td>{{ $unidad->nombre }}</td>
                                    <td>{{ $unidad->horas }}</td>
                                    <td>{{ $unidad->creditos }}</td>
                                    <td>{{ $unidad->ciclo }}</td>
                                    <td>{{ $unidad->moodle }}</td>
                                    <td style="width: 180px; text-align: center">
                                        <button type="button" class="btn btn-info" wire:click="edit_udidactica({{ $unidad->id }})" title="editar unidad didactica">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-secondary" wire:click="create_capacidade({{ $unidad->id }})" title="Agregar nueva Capacidad">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" wire:click="delete_udidactica({{ $unidad->id }})") title="Eliminar Unidad Didáctica">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                        
                                    </td>
                                </tr>
                                @if ($unidad->capabilities()->count())
                                <tr>
                                    <td colspan="8">
                                        <div class="accordion" id="accordionExample-{{ $unidad->id }}" wire:key="accordion-{{ $unidad->id }}">
                                            <div class="card">
                                                @foreach ($unidad->capabilities as $capabilitie)
                                                    <div wire:key="h-{{ $capabilitie->id }}" class="card-header d-flex justify-content-between bd-highlight mb-3" 
                                                    id="heading-{{ $capabilitie->id }}">
                                                        <div>
                                                            <button class="btn btn-outline-success"
                                                            type="button" data-toggle="collapse" data-target="#collapse-{{ $capabilitie->id }}" 
                                                            aria-expanded="true" aria-controls="collapse-{{ $capabilitie->id }}">
                                                                <i class="fas fa-eye"></i>
                                                            </button>
                                                            <button title="Editar Capacidad" wire:click="edit_capacidade({{ $capabilitie->id }})" class="btn btn-outline-info">
                                                                <i class="fas fa-edit"></i>
                                                            </button>
                                                            <button title="Agregar Indicador" wire:click="create_indicator({{ $capabilitie->id }})"
                                                            class="btn btn-outline-warning">
                                                                <i class="fas fa-plus-circle"></i>
                                                            </button>
                                                            <button title="Eliminar Capacidad" wire:click="delete_capacidade({{ $capabilitie->id }})" class="btn btn-outline-danger">
                                                                <i class="fas fa-trash-alt"></i>
                                                            </button>
                                                        </div>
                                                        <div>
                                                            {{ Str::upper($capabilitie->nombre) }}
                                                        </div>
                                                    </div>
                                                    <div wire:key="c-{{ $capabilitie->id }}" id="collapse-{{ $capabilitie->id }}" 
                                                        class="collapse show" data-parent="#accordionExample-{{ $unidad->id }}">
                                                        <div class="card-body pt-1 pb-1">
                                                            <p>
                                                                <b>Descripción: </b>{{ $capabilitie->descripcion }}
                                                            </p>
                                                            @if ($capabilitie->indicators()->count())
                                                            <ul>
                                                                @foreach ($capabilitie->indicators as $indicator)
                                                                    <li wire:key="indicator-li-{{ $indicator->id }}">
                                                                        <button wire:click="edit_indicator({{ $indicator->id }})" class="btn btn-outline-info btn-sm">
                                                                            <i class="fas fa-edit"></i>
                                                                        </button>
                                                                        <button wire:click="delete_indicator({{ $indicator->id }})" class="btn btn-outline-danger btn-sm">
                                                                            <i class="fas fa-trash-alt"></i>
                                                                        </button>
                                                                        <span class="ml-3">
                                                                            <b>Nombre:</b> {{ $indicator->nombre }}
                                                                        </span>
                                                                        <span class="d-block mt-1 mb-1">
                                                                            <b>Descripción: </b> {{ $indicator->descripcion }}
                                                                        </span>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
</div>
