@extends('layouts.saludapp')
@section('contenido')
<div class="container pt-2">
    {!! Form::open(['route'=>'salud.app.surveys.store','method'=>'post']) !!}
    {!! Form::hidden('estudiante_id', $estudiante->id, [null]) !!}
    {!! Form::hidden('survey_id', $survey->id, [null]) !!}
    <div class="card text-left">
      {{-- <img class="card-img-top" src="holder.js/100px180/" alt=""> --}}
        <div class="card-header bg-dark text-white">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" onclick="idioma('es')" checked id="inlineRadio1" value="Español">
                <label class="form-check-label" for="inlineRadio1">Español</label>
            </div>
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" onclick="idioma('awa')" id="inlineRadio2" value="Awajum">
                <label class="form-check-label" for="inlineRadio2">Awajun</label>
            </div>
        </div>
        <div class="card-header">
            <h6 class="card-title">
                <span id="txtes">
                    {{ $survey->name_es }}
                </span>
                <span id="txtawa" style="display: none">
                    {{ $survey->name_awa }}
                </span>
            </h6>
        </div>
      <div class="card-body">
        
        @foreach ($survey->questions as $key => $question)
            <div class="card-text">
                <span id="txtes">
                    {{ $key+1 }} - {{ $question->name_es }}
                </span>
                <span id="txtawa" style="display: none">
                    {{ $key+1 }} - {{ $question->name_awa }}
                </span>
                
            </div>
            @foreach ($question->alternatives as $alternative )
                <div class="form-check">
                    <input class="form-check-input" type="radio" required name="rd-{{ $question->id }}" id="rd-al-{{ $alternative->id }}" value="{{ $alternative->id }}">
                    <label class="form-check-label" for="exampleRadios1">
                        <span id="txtes">
                            {{ $alternative->name_es }}
                        </span>
                        <span id="txtawa" style="display: none">
                            {{ $alternative->name_awa }}
                        </span>
                    </label>
                    @if($alternative->required == 1)
                        <input type="text" class="form-control" name="txt-{{ $alternative->id }}">    
                    @endif
                </div>
            @endforeach
        @endforeach
        {{-- <h4 class="card-title" id="title_awa">{{ $survey->name_awa }}</h4> --}}
      </div>
      <div class="card-footer">
        <a name="" id="" class="btn btn-dark" href="{{ route('salud.app.psicologia',$estudiante->id) }}" role="button">
            <i class="fas fa-backward"></i> Salir
        </a>
        <button class="btn btn-primary" type="submit">
            Guardar <i class="fas fa-forward"></i>
        </button>
      </div>
    </div>
    {!! Form::close() !!}
</div>
@stop
@section('js')
<script>
    function idioma(id){
        const es = document.querySelectorAll('[id^="txt'+'es'+'"');
        const awa = document.querySelectorAll('[id^="txt'+'awa'+'"');
        if (id == "awa"){
            for(let i=0 ; i<es.length; i++){
                es[i].style.display = 'none';
                awa[i].style.display = 'block';
            }
        }
        if (id == "es"){
            for(let i=0 ; i<es.length; i++){
                es[i].style.display = 'block';
                awa[i].style.display = 'none';
            }
        }
        console.log(es);
        console.log(awa);
    }
</script>
@stop