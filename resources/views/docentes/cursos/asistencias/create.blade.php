@extends('adminlte::page')
@section('title', 'Registro Asistencias')
@section('content_header')
<h4 class="h4">
    Unidad Didáctica {{ $asignacione->unidad->nombre }} - {{ $asignacione->unidad->modulo->carrera->nombreCarrera }} {{ $asignacione->unidad->ciclo }}
</h4>
<a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger">
    <i class="fas fa-backward"></i> Regresar
</a>
{!! Form::open(['route'=>'docentes.asistencias.store','method'=>'POST','id'=>'frm']) !!}
<input type="hidden" name="asignacione" value="{{ $asignacione->id }}">
<div class="row">
    <div class="col-sm-12 col-md-6 col-lg-3">
        <label for="fecha" class="mt-2">Seleccione Fecha</label>
        <input type="date" name="fecha" class="form-control" required>
    </div>
</div>
    
@stop
@section('content')
<div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <th>#</th>
            <th>DNI</th>
            <th>APELLIDOS, Nombres</th>
            <th>Asistencia</th>
        </thead>
        <tbody>
            @foreach ($asignacione->unidad->ematricula_detalles as $key => $detalle)
                <tr>
                    <td>
                        <input type="hidden" name="r_emdetalle[]" value="{{ $detalle->id }}">
                        {{ $key + 1 }}
                    </td>
                    <td>{{ $detalle->matricula->estudiante->postulante->cliente->dniRuc }}</td>
                    <td>{{ Str::upper($detalle->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($detalle->matricula->estudiante->postulante->cliente->nombre) }}</td>
                    <td>
                        <select name="rselect[]" class="form-control">
                            <option value="P" class="text-primary">Presente</option>
                            <option value="F" class="text-danger">Falta</option>
                            <option value="J" class="text-warning">Justificado</option>
                        </select>
                    </td>
                </tr>
            @endforeach
            @foreach ($equivalencias as $k => $equivalencia)
                <tr>
                    <td>
                        <input type="hidden" name="e_emdetalle[]" value="{{ $equivalencia->id }}">
                        {{ $k + 1 }}
                    </td>
                    <td>{{ $equivalencia->matricula->estudiante->postulante->cliente->dniRuc }}</td>
                    <td>{{ Str::upper($equivalencia->matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($equivalencia->matricula->estudiante->postulante->cliente->nombre) }}</td>
                    <td>
                        <select name="eselect[]" class="form-control">
                            <option value="P" class="text-primary">Presente</option>
                            <option value="F" class="text-danger">Falta</option>
                            <option value="J" class="text-warning">Justificado</option>
                        </select>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar
                    </button>
                    <a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger">
                        <i class="fas fa-backward"></i> Regresar
                    </a>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
{!! Form::close() !!}
{{-- <p>
    {{ $asignacione->unidad->old->ematricula_detalles_eq }}
</p> --}}
@stop
@section('js')
    <script>
        console.log('Hi!');
    </script>
@stop