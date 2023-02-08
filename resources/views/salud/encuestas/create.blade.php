@extends('adminlte::page')
@section('title', 'Crear nueva Encuesta')
@section('content')
{!! Form::open(['route'=>'salud.encuestas.store','method'=>'post','id'=>'frm']) !!}
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-info mt-2">
              <div class="card-header bg-info">
                <h4>
                    Registrar datos de la encuesta.
                </h4>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12" style="margin-bottom: 1rem">
                        {!! Form::label('type', 'Tipo', [null]) !!}
                        {!! Form::select('type', $types, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('name_es', 'Nombre - Español', [null]) !!}
                        {!! Form::textarea('name_es', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('name_awa', 'Nombre - Awajum', [null]) !!}
                        {!! Form::textarea('name_awa', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('introduction_es', 'Introduccion - Español', [null]) !!}
                        {!! Form::textarea('introduction_es', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('introduction_awa', 'Introduccion - Awajum', [null]) !!}
                        {!! Form::textarea('introduction_awa', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="{{ route('salud.encuestas.index') }}" class="btn btn-danger">
                   <i class="fas fa-door-open"></i> Regresar
                </a>
                <button id="btn_enviar" type="submit" class="btn btn-primary">
                   <i class="fa fa-save"></i> Guardar
                </button>
              </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}

@stop
@section('js')
<script>
    const frm = document.getElementById('frm');
    frm.addEventListener('submit',function(){
        const btn = document.getElementById('btn_enviar');
        btn.disabled = true;
    });
</script>
@stop