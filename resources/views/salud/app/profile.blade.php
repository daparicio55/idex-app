@extends('layouts.saludcontenido')
@section('cuerpo')

<div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
    <div class="flex flex-wrap">                    
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <img class="w-full object-cover" src="{{ Storage::url($estudiante->postulante->url) }}" alt="imagen">
                <div class="px-6 py-4">
                <h2 class="text-lg font-medium text-blue-900 mb-3">
                    <b>
                        {{ $estudiante->postulante->cliente->apellido }}, {{ $estudiante->postulante->cliente->nombre }}
                    </b>
                </h2>
                <p class="mb-3">
                    <i class="fas fa-calendar fa-2x"></i> <b>Nacimiento</b> {{ date('d-m-Y',strtotime($estudiante->postulante->fechaNacimiento)) }}
                </p>
                <p class="mb-3">
                    <i class="fas fa-id-card fa-2x"></i> <b>DNI</b> {{ $estudiante->postulante->cliente->dniRuc }}
                </p>
                <p class="mb-3">
                    <i class="fas fa-mobile-alt fa-2x text-danger"></i> <b>Teléfono</b> {{ $estudiante->postulante->cliente->telefono }}
                </p>
                <p class="mb-3">
                    <i class="far fa-envelope fa-2x text-success mb-3"></i> <b>Correo</b> {{ $estudiante->postulante->cliente->email }}
                </p>
                @if($estudiante->acampanias->count()>0)
                    <h2 class="text-lg font-medium text-blue-900 mb-3">
                        <b> PERFIL MÉDICO</b>
                    </h2>
                    <p class="mb-3">
                        <i class="fas fa-balance-scale fa-2x"></i> <b>Peso</b> {{ $estudiante->acampanias[0]->nutri_peso }} Kg.
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-ruler-vertical fa-2x"></i> <b>Talla</b> {{ $estudiante->pmedico->nutri_talla }} cm.
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-circle-notch fa-2x"></i> <b>Perímetro Abdominal</b> {{ $estudiante->acampanias[0]->nutri_perimetro }} cm.
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-syringe fa-2x"></i> <b>Grupo Sanguineo</b> {{ $estudiante->pmedico->lab_gs }}
                    </p>
                    <p class="mb-3">
                        <i class="fas fa-prescription fa-2x"></i> <b>Factor Sanguineo</b> {{ $estudiante->pmedico->lab_fs }}
                    </p> 
                @endif
                
                </div>
                <div class="px-6 py-4 flex justify-center align-center">
                    <a href="{{ route('salud.app.index') }}" class="mx-auto bg-red-500 text-white py-2 px-4 rounded-full hover:bg-red-600">
                        <i class="fa fa-door-open"></i> Cerrar sesión
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@stop