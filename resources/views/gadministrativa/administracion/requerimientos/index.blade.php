@extends('adminlte::page')

@section('title', 'Lista de Requerimientos')

@section('content_header')
    <h1>Lista de requerimientos del sistema</h1>
@stop

@section('content')
    @include('gadministrativa.administracion.requerimientos.partes.search')
    <x-alert/>
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Encabezado</th>
                    <th>Asunto</th>
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($requerimientos as $key => $requerimiento)
                    <tr>
                        <td>{{ ceros($requerimiento->numero) }}</td>
                        <td>{{ $requerimiento->encabezado }}</td>
                        <td>{{ $requerimiento->asunto }}</td>
                        <td style="width: 120px">{{ date('d-m-Y',strtotime($requerimiento->fecha)) }}</td>
                        <td>{{ $requerimiento->user->name }}</td>
                        <td>
                            @if ($requerimiento->tramites->count()==0)
                                <a href="{{ route('gadministrativa.administracion.requerimientos.archivar',$requerimiento->id) }}" type="button" class="btn btn-warning mt-1">
                                    <i class="fas fa-archive"></i> Archivar
                                </a>
                                <a href="{{ route('gadministrativa.administracion.requerimientos.tramitar',$requerimiento->id) }}" type="button" class="btn btn-primary mt-1">
                                    <i class="fas fa-paper-plane"></i> Tramitar
                                </a>    
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop