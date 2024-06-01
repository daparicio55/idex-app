{!! Form::open(['route'=>'gadministrativa.requerimientos.index','method'=>'get','id'=>'frm']) !!}
<x-adminlte-card title="Buscar requerimiento" theme="info" icon="fas fa-search" collapsible>
    <input type="hidden" name="search" id="search" value="1">
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <label for="numero">Número</label>
            <input type="text" name="numero" id="numero" class="form-control" @isset($_GET['numero']) value="{{ $_GET['numero'] }}" @endisset>
        </div>
        <div class="col-sm-12 col-md-3">
            <label for="finicio">F Inicio</label>
            <input type="date" name="finicio" id="finicio" class="form-control" @isset($_GET['finicio']) value="{{ $_GET['finicio'] }}" @endisset>
        </div>
        <div class="col-sm-12 col-md-3">
            <label for="ffin">F Fin</label>
            <input type="date" name="ffin" id="ffin" class="form-control" @isset($_GET['ffin']) value="{{ $_GET['ffin'] }}" @endisset>
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="{{ route('gadministrativa.requerimientos.index') }}" class="btn btn-default">Limpiar</a>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}