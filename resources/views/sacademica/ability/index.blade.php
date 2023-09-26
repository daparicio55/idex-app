@extends('adminlte::page')
@section('title', 'Capacidades')

@section('content_header')
    <h1>Registro de Capacidades</h1>
    <p><b>{{ $modulo->nombre }} - <span class="text-danger">{{ $modulo->carrera->nombreCarrera }}</span></b></p>
    {!! Form::open(['route'=>'sacademica.ability.create','method'=>'get']) !!}
        <input type="hidden" name="mformativo_id" value="{{ $modulo->id }}">
        <button type="submit" class="btn btn-success">
            <i class="far fa-file"></i> Nueva Capacidad
        </button>
        <a href="{{ route('sacademica.mformativos.index') }}" class="btn btn-danger">
            <i class="fas fa-undo-alt"></i> Regresar
        </a>
    {!! Form::close() !!}
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
    <div class="col-sm-12">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th style="width: 150px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modulo->abilitys as $key=>$ability)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $ability->nombre }}</td>
                            <td>
                                <a href="{{ route('sacademica.ability.edit',$ability->id) }}" class="btn btn-success mt-1" title="editar">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-danger mt-1" title="eliminar" data-target="#modal-delete-{{$ability->id}}" data-toggle="modal">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('sacademica.ability.modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
   </div>
@stop


