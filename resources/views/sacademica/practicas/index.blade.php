@extends('adminlte::page')
@section('title', 'Periodos Académicos')

@section('content_header')
    <h1>Registro de EFSRT</h1>
    <p>Experiencias formaticas en situaciones reales de trabajo...</p>
    <a href="{{route('sacademica.practicas.create')}}" class="btn btn-success">
        <i class="far fa-file"></i> Nuevo Registro
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
@include('sacademica.practicas.search')
   <div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr class="bg-secondary">
                        <th>DNI</th>
                        <th>APELLIDOS, Nombres</th>
                        <th>Programa de Estudios</th>
                        <th>A. Ingreso</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estudiantes as $estudiante)
                        <tr>
                            <td>{{ $estudiante->postulante->cliente->dniRuc }}</td>
                            <td>{{ Str::upper($estudiante->postulante->cliente->apellido) }}, {{ Str::title($estudiante->postulante->cliente->nombre) }}</td>
                            <td>{{ $estudiante->postulante->carrera->nombreCarrera }}</td>
                            <td>{{ $estudiante->postulante->admisione->periodo }}</td>
                        </tr>
                        <tr>
                            <td colspan="4" class="p-1">
                                @foreach ($estudiante->postulante->carrera->modulos as $key=>$modulo)
                                    @if($estudiante->practicas()->where('mformativo_id',$modulo->id)->get()->count() == 1)
                                        {!! Form::open(['route'=>['sacademica.practicas.edit',$modulo->practica->id],'method'=>'get','class'=>'d-inline']) !!}
                                            <button type="submit" class="btn btn-info mt-1" title="{{ $modulo->nombre }}">
                                                Módulo {{ $key+1 }} 
                                            </button>
                                            <a href="{{ route('sacademica.practicas.show',$modulo->practica->id) }}" class="btn btn-warning mt-1">
                                                <i class="fas fa-print"></i>
                                            </a>
                                        {!! Form::close() !!}
                                        {{-- verificar si tiene los modulos completos --}}                                     
                                    @else
                                        {!! Form::open(['route'=>'sacademica.practicas.create','method'=>'get','class'=>'d-inline']) !!}
                                            {!! Form::hidden('estudiante', $estudiante->id, [null]) !!}
                                            {!! Form::hidden('modulo', $modulo->id, [null]) !!}
                                            <button type="submit" class="btn btn-danger mt-1" title="{{ $modulo->nombre }}">
                                                Módulo {{ $key+1 }} 
                                            </button>
                                        {!! Form::close() !!}
                                    @endif
                                @endforeach
                                @if ($estudiante->practicas()->where('estudiante_id',$estudiante->id)->get()->count() == $estudiante->postulante->carrera->modulos()->count())
                                    <a href="{{ route('sacedemica.practicas.conjunto',$estudiante->id) }}"class="btn btn-success mt-1" title="imprimir conjunto">
                                        <i class="fas fa-layer-group"></i> Conjunto
                                    </a>
                                    <a href="{{ route('sacademica.practicas.constancia',$estudiante->id) }}" class="btn btn-primary mt-1">
                                        <i class="far fa-address-card"></i> Constancia
                                    </a>
                                @endif   
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    @if(method_exists($estudiantes,'links'))
                        <tr>
                            <td colspan="5">{{ $estudiantes->links() }} </td>
                        </tr>
                    @endif
                </tfoot>
            </table>
        </div>
    </div>
   </div>
@stop


