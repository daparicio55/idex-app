@extends('adminlte::page')
@section('title', 'Experiencias laborales')
@section('content_header')
<h1>List de unidades didacticas asignadas
    <a href="{{route('sacademica.uasignadas.create')}}" class="btn btn-success">
        <i class="far fa-file"></i> Nueva Asignacion
    </a>
</h1>
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
@include('sacademica.uasignadas.search')
<table class="table table-striped">
    <thead>
        <tr>
            <th>Periodo</th>
            <th>Ciclo</th>
            <th>Unidad</th>
            <th>Programa Estudios</th>
            <th>Docente</th>
            <th>Horario</th>
            <th>Estructura</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($uasignadas as $uasignada)
            <tr>
                <td>{{ $uasignada->periodo->nombre }}</td>
                <td>{{ $uasignada->unidad->ciclo }}</td>
                <td>{{ $uasignada->unidad->nombre }}</td>
                <td>{{ $uasignada->unidad->modulo->carrera->nombreCarrera }}</td>
                <td>{{ $uasignada->user->name }}</td>
                <td style="width: 280px">
                    <ul>
                        @foreach ($uasignada->horarios as $horario)
                            <li>{{ $horario->day }} - {{ $horario->hinicio }} - {{ $horario->hfin }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <table class="table border p-0 m-0">
                        <tbody class="text-center border p-0 m-0">
                            <tr class="border p-0 m-0 bg-secondary">
                                @foreach ($uasignada->capacidades as $key => $capacidade)
                                    <td class="border p-0 m-0" colspan="{{ $capacidade->indicadores()->count() }}">
                                        CA{{ $key+1 }}
                                    </td>
                                @endforeach
                            </tr>
                            <tr class="border p-0 m-0">
                                @foreach ($uasignada->capacidades as $key => $capacidade)
                                    @foreach ($capacidade->indicadores as $llave=>$indicadore)
                                        <td class="border p-0 m-0">
                                            I{{ $llave+1 }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td style="width: 130px">
                    <a data-toggle="modal" data-target="#modal-update-{{ $uasignada->id }}" class="btn btn-warning mt-1" title="cambiar docente">
                        <i class="fas fa-users"></i>
                    </a>
                    <a data-toggle="modal" data-target="#modal-delete-{{ $uasignada->id }}" class="btn btn-danger mt-1" title="eliminar">
                        <i class="fa fa-trash"></i>
                    </a>
                    <a href="{{ route('sacademica.uasignadas.horarios.show',$uasignada->id) }}" class="btn btn-info mt-1" title="agregar horarios">
                        <i class="fas fa-calendar-alt"></i>
                    </a>
                </td>
            </tr>
            @include('sacademica.uasignadas.modal')
        @endforeach
    </tbody>
</table>

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
    const frm = document.getElementById('frm');
    frm.addEventListener('submit',function(event){
        const txt = document.getElementById('searchText');
        if(txt.value.trim() == ""){
            event.preventDefault();
            alert('debe ingresar un criterio a buscar')
        }
    });
</script>
@stop