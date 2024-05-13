@extends('adminlte::page')

@section('title', 'Catálogos')

@section('content_header')
    <h1>Catálogos</h1>
    <a href="{{ route('gadministrativa.administracion.catalogos.create') }}" class="btn btn-success mt-1">
        <i class="fas fa-plus"></i> Nuevo
    </a>
@stop

@section('content')
    <x-alert/>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Modelo</th>
                    <th>Descripcion</th>
                    <th>Unidad</th>
                    <th>Marca</th>
                    <th>Tipo</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($catalogos as $catalogo)
                    <tr>
                        <td>{{ $catalogo->codigo }}</td>
                        <td>{{ $catalogo->modelo }}</td>
                        <td>{{ $catalogo->descripcion }}</td>
                        <td>{{ $catalogo->unidade->nombre }}</td>
                        <td>{{ $catalogo->marca->nombre }}</td>
                        <td>{{ $catalogo->tipo->nombre }}</td>
                        <td style="width: 120px">
                            <a href="{{ route('gadministrativa.administracion.catalogos.edit',$catalogo->id) }}" class="btn btn-success" title="editar el catálogo">
                                <i class="fas fa-edit"></i> 
                            </a>
                            <button type="button"  class="btn btn-danger" title="eliminar el catálogo" data-toggle="modal" data-target="#modal-delete-{{ $catalogo->id }}">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </td>
                    </tr>
                    @include('gadministrativa.administracion.catalogos.modal')
                @endforeach
            </tbody>
        </table>
    </div>
    
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop