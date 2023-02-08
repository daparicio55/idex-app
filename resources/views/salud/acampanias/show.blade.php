@extends('adminlte::page')
@section('title', 'Gestion de Encuestas')
@section('content_header')
<h2 class="bg-info py-2 px-2 rounded">    
    Resultados de la encuesta / Test 
</h2>
<h5>{{ $sdo->survey->name_es }}</h5>
<p><b class="text-uppercase">{{ $sdo->estudiante->postulante->cliente->apellido }},</b> <span class="text-capitalize">{{ strtolower($sdo->estudiante->postulante->cliente->nombre) }}</span></p>
<p>
    <a href="{{ route('salud.acampanias.index') }}" class="btn btn-danger">
        <i class="fa fa-door-open"></i> Salir
    </a>
</p>
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <table class="table">
                <thead>
                    <th>#</th>
                    <th>Pregunta</th>
                    <th>Respuesta</th>
                    <th>Puntos</th>
                </thead>
                <tbody>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($sdo->sddo as $key=>$sddo )
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $sddo->alternative->question->name_es }}</td>
                            <td>{{ $sddo->alternative->name_es }}</td>
                            <td>{{ $sddo->alternative->point }}</td>
                        </tr>
                    @php
                        $total = $total + $sddo->alternative->point ;
                    @endphp
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="bg-success">
                        <td colspan="4" class="text-right h4 border rounded"> <span class="pr-2">Total {{ $total }} puntos</span> </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@stop