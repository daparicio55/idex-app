@extends('adminlte::page')
@section('title', 'Registro de EFSRT')
@section('content_header')
    <h1><i class="fas fa-business-time"></i> Nuevo Registro de EFSRT</h1>
@stop
@section('content')

{!! Form::open(['route'=>'sacademica.practicas.store','method'=>'post','id'=>'formulario']) !!}
{{-- datos del estudiante --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos Personales.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('apellido', 'Apellidos', [null]) !!}
                    <input type="text" name="apellido" id="apellido" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->apellido}}@endif" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('nombre', 'Nombres', [null]) !!}
                    <input type="text" name="nombre" id="nombre" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->nombre}}@endif" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono', 'Telefono Llamadas', [null]) !!}
                    <input type="text" name="telefono" id="telefono" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->telefono}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono2', 'Telefono WhatsApp', [null]) !!}
                    <input type="text" name="telefono2" id="telefono2" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->telefono2}}@endif" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('fechaNacimiento', 'F. Nacimiento', [null]) !!}
                    <input type="text" disabled name="fechaNacimiento" id="fechaNacimiento" value="@if(isset($estudiante)){{date('d-m-Y',strtotime($estudiante->postulante->fechaNacimiento))}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('sexo', 'Sexo', [null]) !!}
                    <input type="text" name="sexo" id="sexo" disabled value="@if(isset($estudiante)){{$estudiante->postulante->sexo}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('discapacidad', 'Discapacidad', [null]) !!}
                    <input type="text" name="discapacidad" id="discapacidad" disabled value="@if(isset($estudiante))@if($estudiante->postulante->discapacidad == 0){{'SI'}}@else{{'NO'}}@endif  @endif" class="form-control" required>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    {!! Form::label('discapacidadNombre', '¿Que discapacidad tiene?', [null]) !!}
                    <input type="text" name="discapacidadNombre" id="discapacidadNombre" disabled value="@if(isset($estudiante)){{$estudiante->postulante->discapacidadNombre}}@endif" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('email', 'Correo', [null]) !!}
                    <input type="text" name="email" id="email" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->email}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    {!! Form::label('direccion', 'Dirección', [null]) !!}
                    <input type="text" name="direccion" id="direccion" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->direccion}}@endif" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos de el programa de estudios --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-user-graduate"></i> Datos de Programa de Estudios.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    {!! Form::label('carrera_id','Nombre' , [null]) !!}
                    <input type="text" disabled name="carrera_id" id="carrera_id" value="@if(isset($estudiante)){{$estudiante->postulante->carrera->nombreCarrera}}@endif" class="form-control" required>                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('admisione_id','A. Ingreso' , [null]) !!}
                    <input type="text" disabled name="admisione_id" id="admisione_id" value="@if(isset($estudiante)){{$estudiante->postulante->admisione->periodo}}@endif" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos de los modulos --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-book-reader"></i> Datos de EFSRT.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('empresa', 'Empresa', ['class'=>'mt-2']) !!}
                    {!! Form::select('empresa', $empresas, null, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>'8']) !!}
                    @error('empresas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror    
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('user', 'Docente Supervisor', ['class'=>'mt-2']) !!}
                    {!! Form::select('user', $users, null, ['class'=>'form-control selectpicker','data-live-search'=>'true','data-size'=>'5']) !!}
                    {!! Form::hidden('estudiante', $estudiante->id, ['class'=>'mt-2']) !!}
                    {!! Form::hidden('modulo', $modulo->id, [null]) !!}
                    @error('user')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('calificacionempresa', 'Calificacion de la Empresa', ['class'=>'mt-2']) !!}
                    {!! Form::number('calificacionempresa', null, ['class'=>'form-control','step'=>'1','min'=>'13','max'=>'20']) !!}
                    @error('calificacionempresa')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('calificaciondocente', 'Calificacion del Docente', ['class'=>'mt-2']) !!}
                    {!! Form::number('calificaciondocente', null, ['class'=>'form-control','step'=>'1','min'=>'13','max'=>'20']) !!}
                    @error('calificaciondocente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('finicio', 'Fecha de Inicio', ['class'=>'mt-2']) !!}
                    {!! Form::date('finicio', null, ['class'=>'form-control']) !!}
                    @error('finicio')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('ffin', 'Fecha de Fin', ['class'=>'mt-2']) !!}
                    {!! Form::date('ffin', null, ['class'=>'form-control']) !!}
                    @error('ffin')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('fpresentacion', 'Fecha de Presentacion del informe', ['class'=>'mt-2']) !!}
                    {!! Form::date('fpresentacion', null, ['class'=>'form-control']) !!}
                    @error('fpresentacion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('horas', 'Horas Realizadas', ['class'=>'mt-2']) !!}
                    {!! Form::number('horas', null, ['class'=>'form-control','step'=>'1','min'=>'0']) !!}
                    @error('horas')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('expediente', 'Número de expediente', ['class'=>'mt-2']) !!}
                    {!! Form::text('expediente', null, ['class'=>'form-control']) !!}
                    @error('expediente')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-sm-12 col-md-6">
                    {!! Form::label('observacion', 'Observacion', ['class'=>'mt-2']) !!}
                    {!! Form::textarea('observacion', null, ['class'=>'form-control','rows'=>'5']) !!}
                    @error('observacion')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            {{-- id        
            
            
            expediente
            observacion --}}
        </div>
        <div class="card-footer">
            <button type="submit" id="button_save" class="btn btn-info">
                Guardar
            </button>
            <a href="{{ route('sacademica.practicas.index') }}" class="btn btn-danger">
                Regresar
            </a>
        </div>
    </div>
</div>
@stop
{!! Form::close() !!}
@section('js')
    
@stop