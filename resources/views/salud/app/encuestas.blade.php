@extends('layouts.saludcontenido')
@section('cuerpo')
<div class="main-content flex-1 bg-gray-800 mt-10 md:mt-2 pb-24 md:pb-5">
    <div class="bg-gray-800 pt-1">
        <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h5 class="font-bold pl-2">Encuestas.</h5>
        </div>
        <div class="W3-animado-izquierda flex flex-wrap"> 
            <div class="w-full md:w-1/2 xl:w-1/3 p-6">

                @foreach ($surveys as $survey)
                    <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                        <p style="padding-bottom: 1rem">
                            <i class="fas fa-map-marker"></i>
                            {{ $survey->name_es }}                            
                        </p>
                        <a href="{{ route('salud.app.surveys',$survey->id.":".$estudiante->id) }}" style="text-decoration: underline;color: blue">
                            <i class="fas fa-share"></i> ir a la encuesta
                        </a>
                    </div>
                @endforeach
                <!--Metric Card-->                        
                {{-- <div class="bg-gradient-to-b from-green-200 to-green-100 border-b-4 border-green-600 rounded-lg shadow-xl p-5">
                    <p style="padding-bottom: 1rem">
                        <i class="fas fa-map-marker"></i>
                        CUESTIONARIO SOBRE USO DE LA HERRAMIENTA INFORMÁTICA CON ENFOQUE INTERCULTURAL PARA 
                        SEGUIMIENTO DEL ESTUDIANTE DURANTE SU DESARROLLO DE SU CARRERA EN EL ISTP PERÚ JAPÓN 2022 .                            
                    </p>
                    <a href="#" style="text-decoration: underline;color: blue">
                        <i class="fas fa-share"></i> ir a la encuesta
                    </a>
                </div> --}}
                <!--/Metric Card-->
            </div>
        </div>
        {{-- ****************************************************************** --}}
    </div>
</div>
@stop