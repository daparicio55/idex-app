@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    {{-- @livewire('create-post',[
        'user'=>1
    ]) --}}
    @livewire('contador')
    @livewire('paises')
@stop


@section('js')
    <script> console.log('Hi!'); </script>
@stop