@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Encuesta</h1>
    <small class="text-center d-block">
        <span id="txtes">
            {{ $survey->name_es }}
        </span>
        <span id="txtawa" style="display: none">
            {{ $survey->name_awa }}
        </span>
    </small>    
</div>
@endsection
@section('page-content')
{!! Form::open(['route'=>'salud.app.surveys.store','method'=>'post']) !!}
{!! Form::hidden('survey_id', $survey->id, [null]) !!}
<div class="row">
    <div class="col-lg-6 mb-5">
        <div class="card shadow mb-5">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" onclick="idioma('es')" checked id="inlineRadio1" value="Español">
                        <label class="form-check-label" for="inlineRadio1">Español</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="inlineRadioOptions" onclick="idioma('awa')" id="inlineRadio2" value="Awajum">
                        <label class="form-check-label" for="inlineRadio2">Awajun</label>
                    </div>
                </h6>
            </div>
            <div class="card-body">               
                @foreach ($survey->questions as $key => $question)
                    <div class="card-text mt-2">
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
            </div>
            <div class="card-footer">
                <a class="btn btn-dark" href="{{ route('salud.app.encuestas') }}" role="button">
                    <i class="fas fa-backward"></i> Salir
                </a>
                <button class="btn btn-primary" type="submit">
                    Guardar <i class="fas fa-forward"></i>
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@section('scripts')
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
@endsection
{{-- @extends('layouts.saludapp')
@section('contenido')
<div class="container pt-2">
    
    {!! Form::hidden('estudiante_id', $estudiante->id, [null]) !!}
   
    <div class="card text-left">
      <div class="card-body">
        
        
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
@stop --}}