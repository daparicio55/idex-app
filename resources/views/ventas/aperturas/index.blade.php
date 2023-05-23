@extends('adminlte::page')
@section('title', 'Apertura de Cursos')
@section('content_header')
<h1>Apertura de Cursos</h1>
<a href="{{ route('ventas.aperturas.create') }}" class="btn btn-success">
    <i class="fas fa-cash-register"></i> Registrar
</a>
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
<div class="row">
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Docente</th>
                    <th>Programa de Estudios</th>
                    <th>U. Didáctica / Indicador</th>
                    <th>Ciclo</th>
                    <th>Periodo</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($aperturas as $key => $apertura)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        @if ($apertura->aperturable_type == "App\Models\Uasignada")
                            <td>{{ $apertura->aperturable->user->name }}</td>
                            <td>{{ $apertura->aperturable->unidad->modulo->carrera->nombreCarrera }}</td>
                            <td>{{ $apertura->aperturable->unidad->nombre }}</td>
                            <td>{{ $apertura->aperturable->unidad->ciclo }}</td>
                            <td>{{ $apertura->aperturable->periodo->nombre }}</td>
                        @endif
                        @if ($apertura->aperturable_type == "App\Models\Indicadore")
                            <td>{{ $apertura->aperturable->capacidade->uasignada->user->name}}</td>
                            <td>{{ $apertura->aperturable->capacidade->uasignada->unidad->modulo->carrera->nombreCarrera }}</td>
                            <td>{{ $apertura->aperturable->capacidade->uasignada->unidad->nombre }} / {{ $apertura->aperturable->nombre }}</td>
                            <td>{{ $apertura->aperturable->capacidade->uasignada->unidad->ciclo }}</td>
                            <td>{{ $apertura->aperturable->capacidade->uasignada->periodo->nombre }}</td>
                        @endif
                        <td>
                            <a class="btn btn-danger" data-toggle="modal" data-target="#apertura-{{ $apertura->id }}" title="eliminar apertura">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                        @include('ventas.aperturas.modal-apertura')
                    </tr>
                @endforeach
            </tbody>
        </table>
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
    });
	</script>
@stop