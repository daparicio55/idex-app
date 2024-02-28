@extends('adminlte::page')
@section('title', 'Experiencias laborales')
@section('content_header')
    <h1>
        List de unidades didacticas asignadas
    </h1>
    <a href="{{route('sacademica.uasignadas.create')}}" class="btn btn-success">
        <i class="far fa-file"></i> Nueva Asignacion
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
@include('sacademica.uasignadas.search')
<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Periodo</th>
                        <th>Ciclo</th>
                        <th>Unidad</th>
                        <th>Programa Estudios</th>
                        <th>Docente</th>
                        <th>Horario</th>
                        <th>Opciones</th>
                        {{-- <th>Estructura</th> --}}
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
                            <td style="width: 170px" class="text-center">
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
                        <tr>
                            <td colspan="7">
                                <table class="table border">
                                    <thead class="border">
                                        <tr>
                                            @foreach ($uasignada->capacidades as $key => $capacidade)
                                                <th class="text-center pt-0 pb-0 border" colspan="{{ $capacidade->indicadores()->count() }}">
                                                    {{ $capacidade->nombre }} - cierre: @if(isset($capacidade->fecha)) {{ date('d-m-Y',strtotime($capacidade->fecha)) }} @else <span class="text-danger"> NP </span> @endif
                                                </th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            @foreach ($uasignada->capacidades as $key => $capacidade)
                                                @foreach ($capacidade->indicadores as $llave=>$indicadore)
                                                    <th class="text-center pt-0 pb-0 border">
                                                        <span>
                                                            {{ $indicadore->nombre }} - cierre: @if(isset($capacidade->fecha)) {{ date('d-m-Y',strtotime($indicadore->fecha)) }} @else <span class="text-danger"> NP </span> @endif
                                                        </span>
                                                        <p class="pt-0 pb-0 mb-0">
                                                            <span>T: {{ $indicadore->detalles()->count() }}</span>|
                                                            <span class="text-primary">A: {{ $indicadore->detalles()->where('nota','>',12)->count() }}</span>|
                                                            <span class="text-danger">D: {{ $indicadore->detalles()->where('nota','<',13)->count() }}</span>
                                                        </p>
                                                    </th>
                                                @endforeach
                                            @endforeach
                                        </tr>
                                    </thead>
                                </table>
                            </td>
                        </tr>
                        @include('sacademica.uasignadas.modal')
                    @endforeach
                </tbody>
                @if (!isset($_GET['buscar']))
                    <tfoot>
                        <tr>
                            <td colspan="7">
                                {{ $uasignadas->links() }}
                            </td>
                        </tr>
                    </tfoot>    
                @endif
            </table>
        </div>
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