@extends('adminlte::page')
@section('title', 'Crear nueva pregunta')
@section('content')
{!! Form::open(['route'=>'salud.preguntas.store','method'=>'post','id'=>'frm']) !!}
{!! Form::hidden('survey_id', $survey->id, [null]) !!}
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-info mt-2">
              <div class="card-header bg-info">
                <h4>
                    <i class="fa fa-question"></i> Registrar pregunta para la encuesta.
                </h4>
                <p>{{ $survey->name_es }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('name_es', 'Nombre - Español', [null]) !!}
                        {!! Form::text('name_es', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('name_awa', 'Nombre - Awajun', [null]) !!}
                        {!! Form::text('name_awa', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('group_es', 'Grupo - Español', [null]) !!}
                        {!! Form::text('group_es', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('group_awa', 'Grupo - Awajun', [null]) !!}
                        {!! Form::text('group_awa', null, ['required','class'=>'form-control','rows'=>5]) !!}
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="{{ route('salud.encuestas.show',$survey->id) }}" class="btn btn-danger">
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