@extends('adminlte::page')

@section('title', 'Unidades Didácticas')
@section('content')
    @livewire('sacademica.mformativos.udidacticas.index',[
        'mformativo_id'=>$modulo->id
    ])
@endsection