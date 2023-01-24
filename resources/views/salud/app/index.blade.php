@extends('layouts.saludapp')
@section('titulo','Salud APP')
@section('css')
<style>
    .abs-center {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    }
</style>
@stop
@section('contenido')
<div class="container abs-center">
    <div class="d-flex mx-2 justify-content-center align-items-center">
        <div class="row">
            <div class="col-sm-11 p-2 shadow-sm border rounded-5 border-primary">
                <img src="{{ asset('img/logoapp.png') }}" style="width: 90%" class="mx-auto d-block" alt="">
                {{-- <h2 class="text-center mb-4 text-primary">IESTP Perú Japón</h2> --}}
                {!! Form::open(['route'=>'salud.app.store','method'=>'post']) !!}
                    @if (session('error'))
                        <div class="alert alert-danger mt-3 text-center" id='error'>
                            <strong><i class="fas fa-sad-tear"></i> {{session('error')}}</strong>
                        </div>
                    @endif
                    <div class="mb-3 mt-3">
                        <label for="dni" class="form-label fw-bold">N° DNI</label>
                        <input type="text" class="form-control bg-info bg-opacity-10 border border-primary" id="dni" name="dni" aria-describedby="emailHelp">
                        @error('dni')
                            <small class="text-danger" id="error_dni">
                                <i class="fas fa-exclamation-triangle"></i> DNI requerido
                            </small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="fecha" class="form-label fw-bold">Fecha Nacimiento</label>
                        <input type="date" class="form-control bg-info bg-opacity-10 border border-primary" id="fecha" name="fecha" >
                        @error('fecha')
                            <small class="text-danger" id="error_fecha">
                                <i class="fas fa-exclamation-triangle"></i> Fecha requerida
                            </small>
                        @enderror
                    </div>
                    <p class="small"><a class="text-primary" href="#">necesitas ayuda?</a></p>
                    <div class="d-grid">
                        <button class="btn btn-primary fw-bold" id="btnIngresar" type="submit">
                            <i class="fas fa-sign-in-alt"></i> Ingresar
                        </button>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@stop





