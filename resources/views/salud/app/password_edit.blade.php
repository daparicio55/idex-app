@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Cambiar Contraseña</h1>
    <small class="text-center d-block">actualiza tu contraseña del sistema</small>
</div>
@endsection
@section('page-content')
<x-alert/>
{!! Form::open(['route'=>'salud.app.password.update','method'=>'PUT']) !!}
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-2 border-left-danger">
            <div class="card-body">
                <div class="form-group">
                    <label>Ingresa nueva contraseña</label>
                    <input type="password" class="form-control" name="password"  id="password">
                    @error('password')
                        <div class="alert alert-danger small p-1 mt-1">{{ $message }}</div>
                    @enderror
                    <label class="mt-2">Confirmar contraseña</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                    @error('password_confirmation')
                        <div class="alert alert-danger small p-1 mt-1">{{ $message }}</div>
                    @enderror                   
                    <div class="form-check mt-2">
                        <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                        <label class="form-check-label" for="defaultCheck1">
                          mostrar contraseña
                        </label>
                    </div>
                    <button class="btn btn-success btn-icon-split mt-2" type="submit">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Cambiar</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection
@section('scripts')
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
        document.getElementById('defaultCheck1').addEventListener('click',function(){
            let password = document.getElementById('password');
            let password_confirmation = document.getElementById('password_confirmation');
            if(password.type === 'password'){
                password.type = 'text';
                password_confirmation.type = 'text';
            }else{
                password.type = 'password';
                password_confirmation.type = 'password';
            }
        });
    </script>
@endsection