@extends('adminlte::page')
@section('title', 'Cepre')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Reportes</h1>
@stop
@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif
{!! Form::open(['route'=>'cepres.reportes.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('idCepre', 'Periodo de Cepre', [null]) !!}
    {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
@if(isset($cepre))
    <div class="card border-success">
        <div class="card-header text-center bg-primary">
            <h3><strong> Cepre IDEX Perú Japón - {{$cepre->periodoCepre}} </strong></h1>
        </div>
        <div class="card-body">
        <p class="text-right text-primary"><strong>Total alumnos:</strong> {{count($estudiantes)}}</p>
        <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">Programa de Estudios</th>
                <th scope="col"  class="text-center">Alumnos</th>
                <th scope="col"  class="text-center">%</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($programas as $programa)
                    <tr>
                        <td>{{$programa->programa}}</td>
                        <td class="text-center">{{$programa->cantidad}}</td>
                        <td class="text-center">{{round(($programa->cantidad / count($estudiantes)*100),0)}}%</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        
        </div>
        <div class="card-footer text-muted">
            Reporte Sistema SISGE-PJ
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-info text-center">
            <h3 class="m-0"><strong> Cepre IDEX Perú Japón - {{$cepre->periodoCepre}} </strong></h1>
            <small>Aulas de Estudio</small>
        </div>
        <div class="card-body">
            @php
                $salto = 0;
                $cantidad = $estudiantes->count();
                $division = 1;
                $orden = 1;
                $aula = 1;
            @endphp
            @if ($cantidad <= 30)
                @php
                    $division = 1;
                @endphp
            @else
                @if ($cantidad <= 90)
                    @php
                        
                    @endphp
                @endif
            @endif
            


            <table class="table">
                <thead>
                    <tr>
                        <th>Orden</th>
                        <th>Aula</th>
                        <th>DNI</th>
                        <th>APELLIDOS, Nombres</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $aula = 1;
                    @endphp
                {{-- @foreach ($alumnos as $key => $alumno)
                    <tr>
                        <td>{{ $alumno['orden'] }}</td>
                        <td>{{ $alumno['aula'] }}</td>
                        <td>{{ $alumno['dni'] }}</td>
                        <td>{{ Str::upper($alumno['apellido']) }}, {{ Str::title($alumno['nombre']) }}</td>
                    </tr>
                @endforeach --}}
                @foreach ($estudiantes as $key => $estudiante)
                    <tr>
                        <td>{{ $key +1 }}</td>
                        <td>{{ $estudiante->aula }}</td>
                        <td>{{ $estudiante->cliente->dniRuc }}</td>
                        <td>{{ Str::upper($estudiante->cliente->apellido) }}, {{ Str::title($estudiante->cliente->nombre) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table class="table">
        </div>
        <div class="card-footer">
            Reporte Sistema SISGE-PJ
        </div>
    </div>
@endif



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
    });
	</script>
@stop