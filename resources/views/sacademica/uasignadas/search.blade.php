{{-- {!! Form::open(['route'=>'sacademica.uasignadas.index','method'=>'get','role'=>'search','id'=>'frm']) !!}
<div class="row">
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchText" @isset($text) value="{{ $text }}" @endisset name="searchText" placeholder="ingrese un criterio para realizar una busqueda" aria-label="ingrese un criterio para realizar una busqueda" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
            <div class="input-group-append">
                <a href="{{ route('sacademica.uasignadas.index') }}" class="btn btn-outline-success" type="submit" id="button-addon3">
                    <i class="fas fa-broom"></i> Limpiar
                </a>
            </div>
          </div>
    </div>
</div>
{!! Form::close() !!} --}}

{!! Form::open(['route'=>'sacademica.uasignadas.index','method'=>'get','role'=>'search','id'=>'frm']) !!}
    <x-adminlte-card title="Buscar" theme="info" icon="fa fa-search" collapsible>
        <div class="row">
            <div class="col-sm-8">
                <x-adminlte-select2 name="udidactica" label="Unidad didáctica" label-class="text-black"
                    igroup-size="md" data-placeholder="Seleccione ...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-book-reader"></i>
                        </div>
                    </x-slot>
                    <option/>
                    @foreach ($udidacticas as $udidactica)
                        <option value="{{ $udidactica->id }}" @isset($_GET['udidactica'])
                            @if ($udidactica->id == $_GET['udidactica'])
                                selected
                            @endif
                        @endisset >
                            {{ $udidactica->nombre }} - {{ $udidactica->modulo->carrera->nombreCarrera }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="col-sm-2">
                <x-adminlte-select2 name="ciclo" label="Ciclo" label-class="text-black"
                    igroup-size="md" data-placeholder="Seleccione ...">
                    <option/>
                    @foreach (ciclos() as $ciclo)
                        <option value="{{ $ciclo }}" @isset($_GET['ciclo'])
                            @if ($ciclo == $_GET['ciclo'])
                                selected
                            @endif
                        @endisset>
                            {{ $ciclo }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="col-sm-2">
                <x-adminlte-select2 name="periodo" label="Periodo" label-class="text-black"
                    igroup-size="md" data-placeholder="Seleccione ...">
                    <option/>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}" @isset($_GET['periodo'])
                            @if ($periodo == $_GET['periodo'])
                                selected
                            @endif
                        @endisset>
                            {{ $periodo->nombre }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="col-sm-12 col-md-6">
                <x-adminlte-select2 name="docente" label="Docente" label-class="text-black"
                    igroup-size="md" data-placeholder="Seleccione ...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-user-tie"></i>
                        </div>
                    </x-slot>
                    <option/>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" @isset($_GET['docente'])
                            @if ($user->id == $_GET['docente'])
                                selected
                            @endif
                        @endisset>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
            <div class="col-sm-12 col-md-6">
                <x-adminlte-select2 name="carrera" label="Carrera" label-class="text-black"
                    igroup-size="md" data-placeholder="Seleccione ...">
                    <x-slot name="prependSlot">
                        <div class="input-group-text bg-gradient-info">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                    </x-slot>
                    <option/>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->idCarrera }}" @isset($_GET['carrera'])
                            @if ($carrera->idCarrera == $_GET['carrera'])
                                selected
                            @endif
                        @endisset>
                            {{ $carrera->nombreCarrera }}
                        </option>
                    @endforeach
                </x-adminlte-select2>
            </div>
        </div>
        <input type="hidden" name="buscar" value="si">
        <x-slot name="footerSlot">
            <button type="submit" class="btn btn-info">
                <i class="fas fa-share-square"></i> Buscar
            </button>
            <a href="{{ route('sacademica.uasignadas.index') }}" class="btn btn-danger">
                <i class="fas fa-broom"></i> Limpiar
            </a>
        </x-slot>
    </x-adminlte-card>
{!! Form::close() !!}