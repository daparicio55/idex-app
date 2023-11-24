@extends('adminlte::page')

@section('title', 'Nueva Venta')

@section('content_header')
    <h1>Nueva Venta</h1>
@stop

@section('content')
{!! Form::open(['route'=>'ventas.ventas.store','method'=>'POST','id'=>'frm']) !!}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  @livewire('ventas.searchDni')
  @livewire('ventas.comprobante')
  @livewire('ventas.addServices')      
  <div class="row">
    <div class="col-sm-12 text-right" >
      <button class="btn btn-primary" type="submit">
        <i class="fas fa-save"></i> Guardar
    </button>
    </div>
  </div>
{!! Form::close() !!}
@stop


