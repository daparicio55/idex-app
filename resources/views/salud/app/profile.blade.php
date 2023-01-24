@extends('layouts.saludcontenido')
@section('cuerpo')

<div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
    <div class="flex flex-wrap">                    
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <div class="bg-white rounded-lg overflow-hidden shadow-lg">
                <img class="w-full object-cover" src="{{ Storage::url($estudiante->postulante->url) }}" alt="imagen">
                <div class="px-6 py-4">
                <h2 class="text-lg font-medium text-gray-900 mb-3">
                    {{ $estudiante->postulante->cliente->apellido }}, {{ $estudiante->postulante->cliente->nombre }}
                </h2>
                <p class="mb-2">
                    <i class="fas fa-calendar fa-2x"></i> <b>Nacimiento</b> {{ date('d-m-Y',strtotime($estudiante->postulante->fechaNacimiento)) }}
                </p>
                <p class="mb-2">
                    <i class="fas fa-id-card fa-2x"></i> <b>DNI</b> {{ $estudiante->postulante->cliente->dniRuc }}
                </p>
                <p class="mb-2">
                    <i class="fas fa-mobile-alt fa-2x text-danger"></i> <b>Teléfono</b> {{ $estudiante->postulante->cliente->telefono }}
                </p>
                <p class="mb-2">
                    <i class="far fa-envelope fa-2x text-success mb-3"></i> <b>Correo</b> {{ $estudiante->postulante->cliente->email }}
                </p>
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
{{-- @extends('layouts.saludcontenido')
@section('cuerpo')
<div class="card">
    <div class="card-header text-center">
        <h5>{{ $estudiante->postulante->cliente->apellido }}, {{ $estudiante->postulante->cliente->nombre }}</h5>
        
    </div>
    <div class="card-body">
        <img class="mx-auto  d-block rounded-pill" src="{{ Storage::url($estudiante->postulante->url) }}" width="50%" alt="">
        <h5 class="card-title mt-4 text-primary">
            <i class="fas fa-list-ul"></i> Datos Personales
        </h5>
        <p class="card-text mt-4">
            <i class="fas fa-id-card fa-2x text-primary"></i> <b>DNI</b> {{ $estudiante->postulante->cliente->dniRuc }}
        </p>
        <p class="card-text mt-4">
            <i class="fas fa-mobile-alt fa-2x text-danger"></i> <b>Teléfono</b> {{ $estudiante->postulante->cliente->telefono }}
        </p>
        <p class="card-text mt-4">
            <i class="far fa-envelope fa-2x text-success mb-3"></i> <b>Correo</b> {{ $estudiante->postulante->cliente->email }}
        </p>
    </div>
    <div class="card-footer text-muted">
        <div class="row text-center">
            <div class="col-sm-12">
                <a href="{{ route('salud.app.index') }}" class="btn btn-lg btn-primary px-5 py-2">
                    <i class="fas fa-door-closed"></i> CERRAR SESIÓN
                </a>
            </div>
        </div>
    </div>
</div>
@stop --}}