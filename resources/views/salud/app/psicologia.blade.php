@extends('layouts.saludcontenido')
@section('cuerpo')
<div class="main-content flex-1 bg-gray-800 mt-10 md:mt-2 pb-24 md:pb-5">
    <div class="bg-gray-800 pt-1">
        <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h5 class="font-bold pl-2">Test de Psicologicos.</h5>
        </div>
        <div class="W3-animado-izquierda flex flex-wrap"> 
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">
                @foreach ($surveys as $survey)
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <p style="padding-bottom: 1rem">
                            <i class="fas fa-map-marker"></i>
                            {{ $survey->name_es }}                            
                        </p>
                        {{-- aca ponemos el grafico si se hizo la encuesta --}}
                        @php
                            $sdo = $survey->sdo()->where('estudiante_id','=',$estudiante->id)->first();
                            $points = 0;
                        @endphp
                        @foreach ($sdo->sddo as $sddo )
                            @php
                                $points = number_format($points,2,'.','') + number_format($sddo->alternative->point,2,'.','');    
                            @endphp
                        @endforeach
                        @php
                            $plotBands = [
                                    ["from"=>"0","to"=>"28","color"=>"green","thickness"=>"20"],
                                    ["from"=>"28","to"=>"56","color"=>"red","thickness"=>"20"]
                                ];
                            $data = [
                                    'points'=>$points,
                                    'min'=>0,
                                    'max'=>56,
                                    'name'=>'estres',
                                    'title_text'=>'Resultados de Estres',
                                    'serie_name'=>'puntos',
                                    'sufix'=>'puntos',
                                ];
                        @endphp
                        @isset($sdo->id)
                            <x-gauge>
                                <x-slot name="datos">
                                    @php
                                        echo json_encode($data);
                                    @endphp
                                </x-slot>
                                <x-slot name="plotBands">
                                    @php
                                        echo json_encode($plotBands);
                                    @endphp
                                </x-slot>
                            </x-gauge>
                        @endisset
                        <a href="{{ route('salud.app.surveys',$survey->id.":".$estudiante->id) }}" style="text-decoration: underline;color: blue">
                            <i class="fas fa-share"></i> ir a la encuesta
                        </a>
                        
                    </div>
                @endforeach
            </div>
        </div>
        {{-- ****************************************************************** --}}
    </div>
</div>
@stop