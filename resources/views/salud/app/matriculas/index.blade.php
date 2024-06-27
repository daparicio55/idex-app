@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center"><i class="fas fa-sort-numeric-up-alt"></i> Matrículas</h1>
    <small class="text-center d-block">lista de matrículas por programa de estudios y periodos</small>
</div>
@endsection
@section('page-content')
<div class="row">
    <div class="col-lg-6 mb-4">
        <div id="programas">
            @foreach ($estudiantes as $key => $estudiante)
                <div class="card mt-2 @if($loop->last) mb-5 @endif">
                    <div class="card-header p-2" id="heading-{{ $estudiante->id }}">
                        <h5 class="mb-0">
                          <button type="button" class="btn btn-link p-0 text-center w-100" data-toggle="collapse" data-target="#collapse-{{ $estudiante->id }}" aria-expanded="true" aria-controls="#collapse-{{ $estudiante->id }}">
                            <i class="{{ $estudiante->postulante->carrera->icon }}"></i> {{ $estudiante->postulante->carrera->nombreCarrera }}
                          </button>
                        </h5>
                    </div>
                    <div id="collapse-{{ $estudiante->id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading-{{ $estudiante->id }}" data-parent="#programas">
                        <div class="card-body">
                            @foreach ($estudiante->matriculas as $matricula)
                                <p>
                                    <a class="btn btn-primary btn-sm @if($matricula->licencia == "SI") disabled @endif" data-toggle="collapse" href="#collapse-matricula-{{ $matricula->id }}" role="button" aria-expanded="false" aria-controls="collapse-matricula-{{ $matricula->id }}">
                                        {{ $matricula->matricula->nombre }}
                                    </a>
                                    @if($matricula->licencia == "SI")
                                        <small>Licencia - {{ $matricula->licenciaObservacion  }}</small>
                                    @endif
                                </p>
                                <div class="collapse mb-3" id="collapse-matricula-{{ $matricula->id }}">
                                    <div class="card card-body">
                                        @foreach ($matricula->detalles as $key => $detalle)
                                            <a href="{{ route('salud.app.matriculas.show',$detalle->id) }}" class="btn btn-sm btn-info m-1 w-100 d-flex justify-content-between">
                                                <small class="text-left">{{ $key +1  }}) {{ $detalle->unidad->nombre }}</small> <small @if($detalle->nota<13) class="text-danger font-weight-bold" @else class="text-primary font-weight-bold" @endif>{{ $detalle->nota }}</small>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach      
                        </div>
                    </div>
                    <div class="card-footer">
                        <span class="text-center d-block"><b>Ingreso:</b> {{ $estudiante->postulante->admisione->nombre }} </span>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection