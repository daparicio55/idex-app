@extends('adminlte::page')
@section('title', 'Registro Asistencias')
@section('content_header')
<h4 class="h4">
    Unidad Didáctica: {{ $asignacione->unidad->nombre }} - {{ $asignacione->unidad->modulo->carrera->nombreCarrera }} {{ $asignacione->unidad->ciclo }}
</h4>
<p>
   Del {{ date('d-m-Y',strtotime($asignacione->periodo->finicio)) }} al {{ date('d-m-Y',strtotime($asignacione->periodo->ffin)) }}
</p>
<p>
    <a class="btn btn-danger mt-1" href="{{ route('docentes.cursos.index') }}" title="Regresar">
        <i class="fas fa-backward"></i>
    </a>
    <button class="btn btn-info mt-1" onclick="showall()">
        <i class="fas fa-eye"></i> Mostrar todas las fechas
    </button>
    <button class="btn btn-success mt-1" onclick="thisweek()">
        <i class="fas fa-calendar-week"></i> Esta semana
    </button>
</p>
@stop
@section('content')
<div class="table-responsive">
    @csrf
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th></th>
                @foreach ($fdias as $g => $dia)
                    <th name="column{{ $g }}">
                        C{{ $g + 1 }}
                    </th>
                @endforeach
                
            </tr>
            <tr>
                <th></th>
                <th style="min-width: 200px">APELLIDOS, Nombres</th>
                @foreach ($fdias as $a => $dia)
                    <th name="column{{ $a }}">
                        <span class="vertical-text">
                            <input type="hidden" id="text{{ $a }}" value="{{ $dia['fecha'] }}">
                            {{ date('d-m-Y',strtotime($dia['fecha'])) }} {{ Str::title($dia['nombre_dia']) }}
                        </span>
                        
                        <button class="btn btn-danger btn-sm" onclick="ocultar({{ $a }})">
                            <i class="fas fa-eye-slash"></i>
                        </button>
                    </th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($ematricula as $key => $detalle)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ Str::upper($detalle['apellido']) }}, {{ Str::title($detalle['nombre']) }}</td>
                @foreach ($fdias as $y => $dia)
                    <td style="min-width: 70px" name="column{{ $y }}">
                        @php
                            $valor = \App\Models\Docentes\Asistencias::where('fecha','=',$dia['fecha'])->where('emdetalle_id','=',$detalle['id'])->first();
                            if(isset($valor->estado)){
                                $estado = $valor->estado;
                            }else{
                                $estado = "NR";
                            }
                        @endphp
                        <select name='select{{ $y }}[]' style="display: inline" @if($estado <> "NR") @if($estado == "P") class="text-primary" @else @if($estado == "F") class="text-danger" @else class="text-warning" @endif @endif @endif>
                            <option value="{{ $detalle['id'] }}:P" @if($estado == "P") selected @endif>P</option>
                            <option value="{{ $detalle['id'] }}:F" @if($estado == "F") selected @endif>F</option>
                        </select>
                        @if ($estado == "NR")
                            <span class="text-danger"><i class="fas fa-exclamation"></i></span>
                        @endif
                    </td>
                @endforeach
            </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                @foreach ($fdias as $z => $dia)
                    <td name="column{{ $z }}">
                        <button type="button" class="btn btn-success btn-sm" @if (!$dia['estado']) disabled @endif title="guardar asistencia" onclick="dia({{ $z }})">
                            <i class="fas fa-save"></i>
                        </button>    
                    </td>
                @endforeach
            </tr>
        </tbody>
    </table>
</div>
<div id="loader-wrapper" style="display: none">
    <div id="loader">
        <div id="circle"></div>
    </div>
    <p id="loading-text">Cargando esto puede tomar varios minutos ...</p>
</div>
@stop
@push('css')
<style type="text/css">
    .vertical-text {
        writing-mode: vertical-rl; /* Esto coloca el texto en posición vertical de derecha a izquierda */
        text-orientation:sideways-right; /* Esto hace que el texto se lea de arriba hacia abajo */
        white-space: nowrap; /* Esto evita que el texto se desborde en múltiples líneas */
    }
</style>
<link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@endpush
@section('js')
    <script src="{{ asset('js/carga.js') }}"></script>
    <script src="{{ asset('js/issameweek.js') }}"></script>
    <script>
        function thisweek(){
            var fdias = @json($fdias);
            var thisDay = '{{ \Carbon\Carbon::now()->toDateString() }}';
            fdias.forEach((dia, index)=>{
                console.log(isSameWeek(dia.fecha,thisDay));
                if(isSameWeek(dia.fecha,thisDay) == false){
                    ocultar(index);
                }
            });
        }
        function dia(id){
            let day = document.getElementById('text'+id);
            let select = document.getElementsByName('select'+id+'[]');
            let token = document.getElementsByName('_token');
            let uasignada_id = '{{ $asignacione->id }}';
            let ruta = "{{ route('docentes.asistencias.store') }}";
            let d = [];
            select.forEach(element => {
                d.push(element.value);
            });
            const datos = {
                _token: token[0].value,
                dia: day.value,
                datos: d,
                uasignada: uasignada_id
            }
            const opciones = {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json' // Asegúrate de ajustar esto según sea necesario
            },
            body: JSON.stringify(datos)
            };
            mostrarPantallaDeCarga();
            fetch(ruta, opciones)
            .then(response => {
                if (!response.ok) {
                throw new Error('La solicitud ha fallado');
                }
                return response.json();
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);
                // Maneja la respuesta del servidor aquí
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            }).finally(()=>{
                ocultarPantallaDeCarga();
                window.location.reload();
            });
        }
        function ocultar(id){
            let columns = document.getElementsByName('column'+id);
            columns.forEach(element => {
                element.style.display = 'none';
            });
        }
        function showall(){
            window.location.reload();
        }
    </script>
@stop