@extends('adminlte::page')

@section('title', 'Registro de Recuperación')

@section('content_header')
    <x-alert/>
    <h2>Registro de exámen de recuperación</h2>
    <p>{{ $uasignada->unidad->nombre }} - {{ $uasignada->unidad->modulo->carrera->nombreCarrera }}</p>
    <a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger">
        <i class="fas fa-backward"></i> Regresar
    </a>
    <a href="{{ route('docentes.cursos.recuperaciones.create',$uasignada->id) }}">
        <button class="btn btn-primary">Nuevo registro</button>
    </a>
@stop

@section('content')
    <div class="table-responsive">
        <table class="table">
            <thead>
                <th>#</th>
                <th>APELLIDOS, Nombres</th>
                <th>Nota</th>
                <th>Recuperación</th>
                <th>Observación</th>
            </thead>
            <tbody>
                @foreach ($recuperaciones as $key => $recuperacione)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ Str::upper($recuperacione->ematriculaDetalle->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($recuperacione->ematriculaDetalle->matricula->estudiante->postulante->cliente->nombre) }}</td>
                        <td>{{ $recuperacione->ematriculaDetalle->nota }}</td>
                        <td>{{ $recuperacione->nota }}</td>
                        <td>{{ $recuperacione->observacion }}</td>
                        <td>
                            <x-modal-delete :id="$recuperacione->id" route="docentes.cursos.recuperaciones.delete" titulo="Eliminar Registro de Recuperación" >
                                ¿Esta seguro que desea eliminar el registro de recuperación?
                            </x-modal-delete>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop