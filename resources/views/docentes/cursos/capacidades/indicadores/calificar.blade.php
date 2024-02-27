@extends('adminlte::page')
@section('title', 'Calificar Indicadores')
@section('content_header')
<h4 class="h4">Lista de Alumnos</h4>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-info">
                <i class="fas fa-upload"></i> Subir Masivo
            </div>
            <div class="card-body">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        {!! Form::open(['route'=>'imports.calificaciones.plantilla','method'=>'get']) !!}
                        <input type="hidden" name="periodo_id" id="periodo_id" value="{{ $indicadore->capacidade->uasignada->pmatricula_id }}">
                        <input type="hidden" name="udidactica_id" id="udidactica_id" value="{{ $indicadore->capacidade->uasignada->udidactica_id }}">
                        <input type="hidden" name="carrera" id="carrera" value="{{ $indicadore->capacidade->uasignada->unidad->modulo->carrera_id }}">
                        <input type="hidden" name="ciclo" id="ciclo" value="{{ $indicadore->capacidade->uasignada->unidad->ciclo }}">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-download"></i> Descargar Plantilla 
                        </button>
                        {!! Form::close() !!}
                    </div>
                    <input type="file" id="file" name="file" class="form-control">                    
                    <div class="input-group-append">
                        <button class="btn btn-success" id="btn_excel">
                            <i class="fas fa-file-excel"></i> Subir 
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('content')
{!! Form::open(['route'=>['docentes.cursos.capacidades.indicadores.calificarstore',$indicadore->id],'method'=>'post']) !!}
<div class="row">
    <div class="col-sm-12">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>DNI</th>
                    <th>APELLIDOS, Nombres</th>
                    <th>Tipo</th>
                    <th>Observacion</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $key=>$estudiante)
                    @php
                        $detalle = \App\Models\EmatriculaDetalle::findOrFail($estudiante->id);
                    @endphp
                    <tr @if($detalle->matricula->licencia == "SI") class="bg-info" style="text-decoration-line:line-through" @endif >
                        <td>
                            <input type="hidden" name="ematricula_detalle_id[]" value="{{ $estudiante->id }}">
                            {{ $key+1 }}
                        </td>
                        <td>
                            {{ $estudiante->dniRuc }}
                        </td>
                        <td>                            
                            <span class="text-uppercase">{{ $estudiante->apellido }}, </span><span class="text-capitalize">{{ strtolower($estudiante->nombre) }}</span>
                        </td>
                        <td>
                            <input type="hidden" name="tipo[]" value="{{ $estudiante->tipo }}">
                            @if($detalle->matricula->licencia == "SI")
                                <span>Licencia</span>
                            @else    
                                {{ $estudiante->tipo }}
                            @endif
                        </td>
                        @if($detalle->matricula->licencia == "SI")
                            <td>{{ $detalle->matricula->licenciaObservacion }}</td>
                        @else
                            <td>
                                {{ $detalle->observacion }}
                            </td>
                        @endif
                        <td>
                            <input type="number" id="text{{ $estudiante->dniRuc }}" @if($estudiante->tipo == "Convalidacion" || $detalle->matricula->licencia == "SI") readonly @endif value="{{ notacriterio($indicadore->id,$estudiante->id) }}" max=20 min=0 step=1 name="notas[]" class="form-control">
                        </td>
                    </tr>
                @endforeach
                @isset($equivalencias)
                    @foreach ($equivalencias as $key=>$equivalencia)
                        <tr>
                            <td>
                                <input type="hidden" name="ematricula_detalle_id[]" value="{{ $equivalencia->id }}">
                                {{ $key+1 }}
                            </td>
                            <td>{{ $equivalencia->dniRuc }}</td>
                            <td>                            
                                <span class="text-uppercase">{{ $equivalencia->apellido }}, </span><span class="text-capitalize">{{ strtolower($equivalencia->nombre) }}</span>
                            </td>
                            <td>
                                <input type="hidden" name="tipo[]" value="Equivalencia">
                                Equivalencia
                            </td>
                            <td>{{ $equivalencia->observacion }}</td>
                            <td>
                                
                                <input type="number" id="text{{ $equivalencia->dniRuc }}" @if($equivalencia->tipo == "Convalidacion") readonly @endif value="{{ notacriterio($indicadore->id,$equivalencia->id) }}" max=20 min=0 step=1 name="notas[]" class="form-control">
                            </td>
                        </tr>
                    @endforeach
                @endisset

                
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <button type="submit" class="btn btn-success mb-3"> 
            <i class="far fa-save"></i> Guardar
        </button>
{!! Form::close() !!}
        <a href="{{ route('docentes.cursos.index') }}" class="btn btn-danger mb-3">
            <i class="fas fa-ban"></i> Cancelar
        </a>
    </div>
</div>

@stop
@section('js')
<script>
    $(document).ready(function(){
        setTimeout(() => {
        $("#info").hide();
      }, 12000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
      }, 12000);
    })

    let btn = document.getElementById('btn_excel');
    btn.addEventListener('click',function(){
        var inputFile = document.getElementById('file').files[0];
        var token = document.querySelector('meta[name="csrf-token"]').content; // Obtén el token CSRF de la etiqueta meta
        var formData = new FormData();
        formData.append('file', inputFile, 'nombre_personalizado.xlsx');
        formData.append('_token',token);
        fetch("{{ route('imports.calificaciones.store') }}", {
        method: 'POST',
        body: formData
        })
        .then(response => {
            if (!response.ok) {
            throw new Error('Error en la solicitud');
            }
            return response.json(); // Puedes cambiar esto según la respuesta esperada
        })
        .then(data => {
            //console.log('Éxito:', data);
            rows = data;
            rows.forEach(row => {
                let text = document.getElementById('text'+row['dni']);
                if(text){
                    console.log(text);
                    if(text.getAttribute('readonly') === null){
                        text.value = row['nota'];
                    };
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
</script>
@stop