{!! Form::open(['route'=>'sacademica.matriculas.index','method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
<x-adminlte-card title="Buscar" theme="info" icon="fas fa-search" collapsible>
    <div class="row">
        <div class="col-sm-12">
            <label>Ingrese DNI, nombres o apellidos...</label>
            <input type="text" class="form-control" name="searchText" @if(isset($_GET['searchText'])) value="{{ $_GET['searchText'] }}" @endif placeholder="Ingrese número de DNI a buscar...">
        </div>
        <div class="col-sm-12 col-md-6">
            <label class="mt-3">Programa de Estudios</label>
            <select name="programa" class="form-control">
                <option value="0" disabled selected>Todos</option>
                @foreach ($programas as $programa)
                    <option value="{{ $programa->idCarrera }}" @if(isset($_GET['programa'])) @if($_GET['programa'] == $programa->idCarrera) selected @endif @endif>{{ $programa->nombreCarrera }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-3">
            <label class="mt-3">Ciclo</label>
            <select name="ciclo" class="form-control">
                <option value="0" disabled selected>Todos</option>
                <option value="I" @if(isset($_GET['ciclo'])) @if($_GET['ciclo'] == "I") selected @endif @endif>I</option>
                <option value="II" @if(isset($_GET['ciclo'])) @if($_GET['ciclo'] == "II") selected @endif @endif>II</option>
                <option value="III" @if(isset($_GET['ciclo'])) @if($_GET['ciclo'] == "III") selected @endif @endif>III</option>
                <option value="IV" @if(isset($_GET['ciclo'])) @if($_GET['ciclo'] == "IV") selected @endif @endif>IV</option>
                <option value="V" @if(isset($_GET['ciclo'])) @if($_GET['ciclo'] == "V") selected @endif @endif>V</option>
                <option value="VI" @if(isset($_GET['ciclo'])) @if($_GET['ciclo'] == "VI") selected @endif @endif>VI</option>
            </select>
        </div>
        <div class="col-sm-12 col-md-3">
            <label class="mt-3">Periodo</label>
            <select name="periodo" class="form-control">
                <option value="0" disabled selected>Todos</option>
                @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" @if(isset($_GET['periodo'])) @if($_GET['periodo'] == $periodo->id) selected @endif @endif>{{ $periodo->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-search-plus"></i> Buscar
        </button>
        <a href="{{route('sacademica.matriculas.index')}}" class="btn btn-danger">
            <i class="fas fa-recycle"></i> Limpiar
        </a>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}