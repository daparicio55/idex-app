@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Encuestas</h1>
    <small class="text-center d-block">ayudanos a mejorar respondiendo algunas preguntas</small>    
</div>
@endsection
@section('page-content')
<div class="row">
    @foreach ($surveys as $key => $survey)
        <div class="col-lg-6 mb-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        Encuesta {{ $key + 1 }}
                    </h6>
                </div>
                <div class="card-body">               
                    <p>{{ $survey->name_es }} </p>
                    <a href="{{ route('salud.app.surveys',$survey->id) }}" class="btn btn-secondary btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-arrow-right"></i>
                        </span>
                        <span class="text">Responder ahora</span>
                    </a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection