@extends('adminlte::page')
@section('title', 'Crear nueva alternativa')
@section('content')
{!! Form::model($sqalternative, ['route'=>['salud.alternativas.update',$sqalternative->id],'method'=>'put','id'=>'frm']) !!}
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="card border-info mt-2">
              <div class="card-header bg-info">
                <h4>
                    <i class="fa fa-question"></i> Editar alternativa para la pregunta.
                </h4>
                <p>{{ $sqalternative->question->name_es }}</p>
              </div>
              <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('name_es', 'Nombre - Español', [null]) !!}
                        {!! Form::text('name_es', null, ['required','class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('name_awa', 'Nombre - Awajum', [null]) !!}
                        {!! Form::text('name_awa', null, ['required','class'=>'form-control']) !!}
                    </div>
                    <div class="col-sm-12 col-md-6">
                        {!! Form::label('point', 'Puntos', [null]) !!}
                        {!! Form::number('point', null, ['class'=>'form-control','required']) !!}
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        {!! Form::checkbox('required', 1, null, [null]) !!}
                        {!! Form::label('required', 'Requerido', [null]) !!}
                    </div>
                </div>
              </div>
              <div class="card-footer">
                <a href="{{ route('salud.preguntas.show',$sqalternative->question->id) }}" class="btn btn-danger">
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