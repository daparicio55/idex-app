{!! Form::open(['route'=>'gadministrativa.administracion.requerimientos.index','method'=>'get','id'=>'frm']) !!}
<x-adminlte-card title="Buscar requerimiento" theme="info" icon="fas fa-search" collapsible>
    <input type="hidden" name="search" id="search" value="1">
    <div class="row">
        <div class="col-sm-12 col-md-3">
            <label for="numero">Número</label>
            <input type="text" name="numero" id="numero" class="form-control" @isset($_GET['numero']) value="{{ $_GET['numero'] }}" @endisset>
        </div>
        <div class="col-sm-12 col-md-3">
            <label for="usuario">Usuario</label>
            <select name="usuario" id="usuario" class="form-control selectpicker" data-live-search="true" data-size=8>
                <option value="0">Todos</option>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" @isset($_GET['usuario']) @if ($_GET['usuario']==$usuario->id) selected @endif @endisset>{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-3">
            <label for="finicio">F Inicio</label>
            <input type="date" name="finicio" id="finicio" class="form-control">
        </div>
        <div class="col-sm-12 col-md-3">
            <label for="ffin">F Fin</label>
            <input type="date" name="ffin" id="ffin" class="form-control">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-3">
            <label for="estado">Estado</label>
            <select name="estado" id="estado" class="form-control">
                <option value="0">Todos</option>
                <option value="Espera">Espera</option>
                <option value="Archivado">Archivado</option>
                <option value="Tramitado">Tramitado</option>
            </select>
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="submit" class="btn btn-primary">Buscar</button>
        <a href="{{ route('gadministrativa.administracion.requerimientos.index') }}" class="btn btn-default">Limpiar</a>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}