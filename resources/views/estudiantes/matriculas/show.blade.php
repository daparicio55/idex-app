@extends('adminlte::page')

@section('title', 'Estudiante | Matrículas')

@section('content_header')
    <h1>Detalle de la unidad didáctica</h1>
    <a href="{{ route('estudiantes.matriculas.index') }}" class="btn btn-danger mt-1">
        <i class="fas fa-backward"></i> Regresar
    </a>
@stop

@section('content')
<div class="card">
    <div class="card-header bg-info">
        <h5 class="h5">{{ $detalle->unidad->nombre }} - {{ $detalle->tipo }}</h5>
    </div>
    <div class="card-body">
        <b class="h5">NOTA: </b> <span class="h5"> {{ cero($detalle->nota) }} </span>
        @php
            $uasignada = \App\Models\Uasignada::where('pmatricula_id','=',$detalle->matricula->pmatricula_id)
            ->where('udidactica_id','=',$detalle->udidactica_id)
            ->first();
        @endphp
        @if (isset($uasignada->capacidades))
            <ul>
                @foreach ($uasignada->capacidades as $key => $capacidade)
                    <li>
                        <i class="fas fa-lock text-danger"></i> <b>{{ date('d-m-Y',strtotime($capacidade->fecha)) }}</b> | Capacidad {{ $key + 1 }}
                        <span class="{{ caNota($capacidade->id,$detalle->id)['color'] }}">NOTA: {{ caNota($capacidade->id,$detalle->id)['nota'] }}</span>
                         {{-- | {{ $capacidade->descripcion }} --}}
                    </li>
                    <ul>
                        @foreach ($capacidade->indicadores as $k => $indicadore)
                            <li><i class="fas fa-lock text-danger"></i> <b>{{ date('d-m-Y',strtotime($indicadore->fecha)) }}</b> | IN {{ $k + 1 }} | <span class="{{ inNota($indicadore->id,$detalle->id)['color'] }}">NOTA: {{ inNota($indicadore->id,$detalle->id)['nota'] }}</span>{{-- | {{ $indicadore->descripcion }} --}}</li>
                        @endforeach
                    </ul>
                @endforeach
            </ul>
            <b class="h5">ASISTENCIAS:</b>
            <ul>
                @foreach ($fdias as $fdia)
                    @php
                        $estado = null;
                        $valor = \App\Models\Docentes\Asistencias::where('fecha','=',$fdia['fecha'])->where('emdetalle_id','=',$detalle->id)->first();
                        if(isset($valor->estado)){
                            $estado = $valor->estado;
                        }else{
                            $estado = "NR";
                        }
                    @endphp
                    <li>{{ date('d-m-Y',strtotime($fdia['fecha'])) }} | {{ Str::title($fdia['nombre_dia']) }} | {{ $estado }}</li>
                @endforeach
            </ul>
        @endif
        
    </div>
    <div class="card-footer">
        <b>Periodo: </b>{{ $detalle->matricula->matricula->nombre }}
    </div>
</div>





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