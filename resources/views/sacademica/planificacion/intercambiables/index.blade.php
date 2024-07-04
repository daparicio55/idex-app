@extends('adminlte::page')

@section('title', 'Unidades Intercambiables')

@section('content_header')
    <h1>Lista de unidades didácticas intercambiables</h1>
    <a href="{{ route('sacademica.intercambiables.create') }}" class="btn btn-success mt-2">
        <i class="fas fa-plus"></i> Agregar Unidad Intercambiable
    </a>
@stop

@section('content')
    <p>estas unidades son equivantes sin importar el programa de estudios.</p>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($intercambiables as $intercambiable)
                    <tr>
                        <td>{{ $intercambiable->nombre }}</td>
                        <td>
                            <a href="{{ route('sacademica.intercambiables.edit',$intercambiable->id) }}" class="btn btn-primary">
                                <i class="fas fa-edit"></i>
                            </a>
                            <x-modal-delete :id="$intercambiable->id" titulo="Eliminar Unidad">
                                <p>¿<b>Está seguro de eliminar: </b>  {{ $intercambiable->nombre }}?</p>
                            </x-modal-delete>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ul>
                                @foreach ($intercambiable->unidades as $unidad)
                                    <li>
                                        <span>{{ $unidad->nombre }} - {{ $unidad->ciclo }} - {{ $unidad->modulo->carrera->nombreCarrera }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop