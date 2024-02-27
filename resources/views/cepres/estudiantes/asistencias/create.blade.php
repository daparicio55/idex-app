@extends('adminlte::page')

@section('title', 'Cepre Asistencias')

@section('content_header')
    <h1>Registro de Asistencias</h1>
    <p>{{ date('l, j F Y',strtotime($fecha)) }}</p>
@stop

@section('content')
{!! Form::open(['route'=>'cepres.estudiantes.asistencias.store','method'=>'POST']) !!}
    <input type="hidden" name="fecha" value="{{ $fecha }}">
    <ol>
        @foreach ($estudiantes as $estudiante)
            @php
                $cestudiante = \App\Models\CepreEstudiante::whereHas('cliente',function($query) use($estudiante,$cepre){
                    $query->where('idCepre','=',$cepre)
                    ->where('idCliente','=',$estudiante->idCliente);
                })->first();
                
                $asistencia = \App\Models\CepreEstudianteAsistencia::where('fecha','=',$fecha)
                ->where('cestudiante_id','=',$cestudiante->idCepreEstudiante)
                ->first();
                
            @endphp
            <li>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <select name="asistencias[]" id="select{{ $estudiante->idCliente }}" onchange="cambio({{ $estudiante->idCliente }})" @if(isset($asistencia->estado)) @if($asistencia->estado == "Asistio") class="form-control text-primary" @else @if($asistencia->estado == "Tardanza") class="form-control text-warning" @else class="form-control text-danger" @endif @endif @else class="form-control text-primary" @endif>
                        <option value="Asistio" class="text-primary" @isset($asistencia->estado) @if($asistencia->estado == "Asistio") selected @endif @endisset>Asistio</option>
                        <option value="Tardanza" class="text-warning" @isset($asistencia->estado) @if($asistencia->estado == "Tardanza") selected @endif @endisset>Tardanza</option>
                        <option value="Falto" class="text-danger" @isset($asistencia->estado) @if($asistencia->estado == "Falto") selected @endif @endisset>Falto</option>
                      </select>
                    </div>
                    
                    <input type="hidden" name="estudiantes[]" value="{{ $cestudiante->idCepreEstudiante }}">
                    <span class="form-control">{{ Str::upper($estudiante->apellido) }}, {{ Str::title($estudiante->nombre) }}</span>
                  </div>
            </li>
        @endforeach
    </ol>
    <a href="{{ route('cepres.estudiantes.asistencias.index') }}" class="btn btn-danger">
        <i class="fas fa-backward"></i> Regresar
    </a>
    <button type="submit" class="btn btn-primary">
        <i class="far fa-save"></i> Guardar
    </button>
{!! Form::close() !!}
@stop
@section('js')
    <script>
        function cambio(id){
            console.log(id);
            let select = document.getElementById('select'+id);
            let valor = select.value;
            if (valor == "Asistio"){
                select.className="";
                select.classList.add("form-control","text-primary")
            }
            if (valor == "Tardanza"){
                select.className="";
                select.classList.add("form-control","text-warning")
            }
            if (valor == "Falto"){
                select.className="";
                select.classList.add("form-control","text-danger")
            }
            
        }
    </script>
@stop