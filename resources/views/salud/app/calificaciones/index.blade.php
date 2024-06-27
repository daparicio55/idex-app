@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center"><i class="fas fa-sort-numeric-up-alt"></i> Calificaciones</h1>
    <small class="text-center d-block">verificacion de calificaciones</small>
</div>
@endsection
@php
    $ciclos = [
        'I',
        'II',
        'III',
        'IV',
        'V',
        'VI'
    ];
@endphp
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
                    <a href="{{ route('salud.app.calificaciones.pdf',$estudiante->id) }}" class="btn btn-warning w-50 btn-sm mt-2 mb-2 mx-auto">
                        <i class="fas fa-download"></i> <i class="far fa-file-pdf"></i> PDF
                    </a>
                    <div id="collapse-{{ $estudiante->id }}" class="collapse @if($loop->first) show @endif" aria-labelledby="heading-{{ $estudiante->id }}" data-parent="#programas">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table style="font-size: 0.8rem" class="table table-bordered">
                                    <tbody>
                                        {{-- primer semestre --}}
                                        @foreach ($ciclos as $ciclo)
                                            <tr class="bg-secondary text-center">
                                                <th colspan="6" class="m-0 p-2">
                                                    <h6 class="m-0 text-white">SEMESTRE {{ $ciclo }}</h6>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="m-0 p-1">Unidad Didactica</th>
                                                <th class="m-0 p-1">Cre.</th>
                                                <th class="m-0 p-1">Hor.</th>
                                                <th class="m-0 p-1 text-center">Not.</th>
                                                <th class="m-0 p-1 text-center">Not.</th>
                                                <th class="m-0 p-1 text-center">Not.</th>
                                            </tr>    
                                            @foreach ($estudiante->postulante->carrera->modulos as $modulo)
                                                @foreach ($modulo->unidades as $unidad)
                                                    @if ($unidad->ciclo == $ciclo)
                                                        <tr>
                                                            <td class="pl-1 pr-0 m-0"> {{ $unidad->tipo }} : {{ $unidad->nombre }}</td>
                                                            <td class="pl-0 pr-0 m-0 text-center">{{ $unidad->creditos }}</td>
                                                            <td class="pl-0 pr-0 m-0 text-center">{{ $unidad->horas }}</td>
                                                            {{-- aca van las notas correspondientes --}}
                                                            @php
                                                                $reg = $unidad->horas * 30 + $unidad->creditos * 50 + 15;
                                                                $ext =  $unidad->horas * 20 + $unidad->creditos * 30 + 15;
                                                                $cont = 3;
                                                                $desaprobado = FALSE;
                                                            @endphp
                                                            @foreach (notas($unidad->id,$estudiante->id) as $nota)
                                                                <td @if($nota->nota<13) class="text-danger text-center pl-0 pr-0 m-0" @else class="text-primary text-center pl-0 pr-0 m-0" @endif>@if(Str::length($nota->nota)==1) 0{{ $nota->nota }} @else {{ $nota->nota }} @endif</td>
                                                                @if($nota->nota<13)
                                                                    @isset($nota->nota)
                                                                        @php
                                                                            $desaprobado = TRUE;
                                                                        @endphp
                                                                    @endisset
                                                                @else
                                                                    @php
                                                                        $desaprobado = FALSE;
                                                                    @endphp
                                                                @endif
                                                                @php
                                                                    $cont++;
                                                                @endphp
                                                            @endforeach
                                                            @for ($i = $cont; $i < 6; $i++)
                                                                <td></td>
                                                            @endfor
                                                            @php
                                                                $desaprobado = FALSE;
                                                            @endphp
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <tr class="bg-dark">
                                                @php
                                                    $cont = 0;
                                                @endphp
                                                <td colspan="3" class="text-white text-right pt-1 pb-1">Ponderado:</td>
                                                @foreach (primeros($estudiante->id,$ciclo) as $item)
                                                    <td class="text-white pt-1 pb-1">{{ $item['nota'] }}</td>
                                                    @php
                                                        $cont ++;
                                                    @endphp
                                                @endforeach
                                                @for ($i = $cont; $i < 3; $i++)
                                                    <td></td>
                                                @endfor
                                            </tr>
                                            <tr class="bg-dark">
                                                @php
                                                    $cont = 0;
                                                @endphp
                                                <td colspan="3" class="text-white text-right pt-1 pb-1">Puesto:</td>
                                                @foreach (primeros($estudiante->id,$ciclo) as $item)
                                                    <td class="text-white pt-1 pb-1">{{ $item['puesto'] }}</td>
                                                    @php
                                                        $cont ++;
                                                    @endphp
                                                @endforeach
                                                @for ($i = $cont; $i < 3; $i++)
                                                    <td></td>
                                                @endfor
                                            </tr>
                                            <tr class="p-1">
                                                <td colspan="6"></td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection