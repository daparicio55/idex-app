@extends('adminlte::page')

@section('title', 'Estudiante | Matrículas')

@section('content_header')
    <h1>Matriculas</h1>
@stop

@section('content')
@foreach ($estudiantes as $estudiante)
    <div class="card">
        <div class="card-header bg-info">
            <h5 class="h5">{{ $estudiante->postulante->carrera->nombreCarrera }}</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>#</th>
                        <th>Periodo</th>
                        <th>Fecha</th>
                        {{-- <th>Unidades Didacticas</th> --}}
                    </thead>
                    <tbody>
                        @foreach ($estudiante->matriculas()->orderBy('fecha','desc')->get() as $key => $matricula)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $matricula->matricula->nombre }}</td>
                                <td>
                                    <a href="{{ route('sacademica.matriculas.show',$matricula->id) }}" class="btn btn-warning"><i class="fas fa-eye"></i></a>
                                    {{ date('d-m-Y',strtotime($matricula->fecha)) }}
                                </td>
                            </tr>
                            <tr>
                                
                                <td colspan="3">
                                    
                                        <ol>
                                            @foreach ($matricula->detalles as $detalle)
                                                <li><a href="{{ route('estudiantes.matriculas.show',$detalle->id) }}" class="btn btn-sm btn-info m-1"><i class="fas fa-eye"></i></a>{{ $detalle->unidad->nombre }}</li>
                                            @endforeach
                                        </ol>
                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <b>Año de ingreso:</b> {{ $estudiante->postulante->admisione->nombre }}
        </div>
    </div>
@endforeach



<div id="loader-wrapper" style="display: none">
    <div id="loader">
        <div id="circle"></div>
    </div>
    <p id="loading-text">Cargando esto puede tomar varios minutos ...</p>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/carga.js') }}"></script>
    <script>

    </script>
@stop