@extends('adminlte::page')
@section('title', 'Registrar')
@section('content_header')
{{-- {!! Form::open(['route'=>'docentes.cursos.capacidades.store','method'=>'post','id'=>'frm_datos']) !!} --}}
<div class="card">
    <div class="card-header bg-info">
        <h5>
            <i class="fas fa-lock-open"></i> Apertura de Planes o Indicadores.
        </h5>
        {{-- <h5>
            <a class="btn btn-danger" href="{{ route('docentes.cursos.show',$uasignada->id) }}">
                <i class="fas fa-long-arrow-alt-left"></i>
            </a> {{ $uasignada->unidad->nombre }}
        </h5>
        <h6 class="p-0 mb-0">{{ $uasignada->unidad->modulo->carrera->nombreCarrera }}</h6>
        <small class="p-0">{{ $uasignada->periodo->nombre }}</small> --}}
    </div>
    <div class="card-body">
        {!! Form::open(['route'=>'ventas.aperturas.create','method'=>'get']) !!}
        <div class="row">
            <div class="col-sm-12 col-md-7">
                {!! Form::label('docentes', 'Docente', [null]) !!}
                <select name="docente" id="docente" class="form-control selectpicker" data-live-search="true" data-size=10>
                    <option value="0">Seleccione</option>
                    @foreach ($docentes as $docente)
                        <option value="{{ $docente->id }}">
                            {{ $docente->name }} - {{ $docente->email }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('pmatricula_id','Periodo', [null]) !!}
                <select name="pmatricula" id="pmatricula" class="form-control selectpicker" data-live-search="true" data-size=10>
                    <option value="0">Seleccione</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">
                            {{ $periodo->nombre  }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('tipo', 'Tipo', [null]) !!}
                <select name="tipo" id="tipo" class="form-control selectpicker" data-live-search="true" data-size="10">
                    <option value="0">Seleccione</option>
                    <option value="1">Abrir Plan</option>
                    <option value="2">Abrir Indicador</option>
                </select>
            </div>
            <div class="col-sm-12 mt-2">
                <button type="submit" class="btn btn-info" disabled id="btn-buscar">
                    Buscar
                </button>
            </div>
        </div>
        {!! Form::close() !!}
        @isset($uasignadas)
            <div class="row mt-2">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Unidad Didáctica</th>
                            <th>Ciclo</th>
                            <th>P. Estudios</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($uasignadas as $key => $uasignada )
                        {!! Form::open(['route'=>'ventas.aperturas.store','method'=>'post','id'=>'frm']) !!}
                        {!! Form::hidden('tipo', $tipo, [null]) !!}
                        {!! Form::hidden('uasignada', $uasignada->id, [null]) !!}
                            <tr>
                                @php
                                    $id = $uasignada->id;
                                @endphp
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $uasignada->unidad->nombre }}</td>
                                <td>{{ $uasignada->unidad->ciclo }}</td>
                                <td>{{ $uasignada->unidad->modulo->carrera->nombreCarrera }}</td>
                                <td>
                                    <a data-toggle="modal" data-target="#open-{{ $id }}" class="btn btn-warning" title="abrir planeación">
                                        <i class="fas fa-lock-open"></i>
                                    </a>
                                </td>
                            </tr>
                            @include('ventas.aperturas.modal')
                            {!! Form::close() !!}
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endisset
        @isset($indicadores)
        <div class="row mt-2">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>P. Estudios</th>
                        <th>Unidad Didáctica</th>
                        <th>Ciclo</th>
                        <th>Indicador</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($indicadores as $key => $indicadore )
                    {!! Form::open(['route'=>'ventas.aperturas.store','method'=>'post','id'=>'frm']) !!}
                    {!! Form::hidden('tipo', $tipo, [null]) !!}
                    {!! Form::hidden('uasignada', $indicadore->id, [null]) !!}
                        <tr>
                            @php
                                $id = $indicadore->id;
                            @endphp
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $indicadore->capacidade->uasignada->unidad->modulo->carrera->nombreCarrera }}</td>
                            <td>{{ $indicadore->capacidade->uasignada->unidad->nombre }}</td>
                            <td>{{ $indicadore->capacidade->uasignada->unidad->ciclo }}</td>
                            <td>{{ $indicadore->nombre }}</td>
                            <td>
                                <a data-toggle="modal" data-target="#open-{{ $id }}" class="btn btn-warning" title="abrir planeación">
                                    <i class="fas fa-lock-open"></i>
                                </a>
                            </td>
                        </tr>
                        @include('ventas.aperturas.modal')
                        {!! Form::close() !!}
                    @endforeach
                </tbody>
            </table>
        </div>
        @endisset
        {{-- {!! Form::hidden('uasignada_id', $uasignada->id, [null]) !!}
        <div class="row">
            <div class="col-sm-2">
                {!! Form::label('nombre', 'Nombre', [null]) !!}
                {!! Form::text('nombre', null, ['class'=>'form-control','required']) !!}
            </div>
            <div class="col-sm-8">
                <label for="descripcion">Descripcion de la capacidad</label>
                {!! Form::text('descripcion', null, ['class'=>'form-control','required']) !!}
            </div>
            <div class="col-sm-2">
                <label for="fecha">Fecha Cierre</label>
                {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
            </div>
            @error('fecha')
                <div class="col-sm-12 mt-2">
                    <div class="alert alert-danger">
                        {{ $message }}
                    </div>
                </div>
            @enderror
        </div> --}}
    </div>
    <div class="card-footer">
        <div class="row">
            <div class="col-sm-12">
                <button type="submit" id="bt_guardar" disabled class="btn btn-primary">
                    <i class="far fa-save"></i>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        
                </button>
            </div>
        </div>
    </div>
</div>
{{-- {!! Form::close() !!} --}}
@stop
@section('js')
<script>
    function activarBuscar(){
        let d = document.getElementById('docente');
        let p = document.getElementById('pmatricula');
        let t = document.getElementById('tipo');
        let btn = document.getElementById('btn-buscar');
        console.log(d.value);
        console.log(p.value);
        console.log(t.value);
        if(d.value != 0 && p.value != 0 && t.value != 0){
            btn.removeAttribute('disabled');

        }else{
            btn.setAttribute('disabled');
        }
    }
    document.getElementById('docente').addEventListener('change',function(){
        activarBuscar();
    });
    document.getElementById('pmatricula').addEventListener('change',function(){
        activarBuscar();
    });
    document.getElementById('tipo').addEventListener('change',function(){
        activarBuscar();
    });

    document.getElementById('frm').addEventListener('submit',function(event){
        let btn = document.querySelectorAll('.btn-abrir');
        for (let i = 0; i < btn.length; i++){
            btn[i].setAttribute('disabled','false');
            console.log(btn[i]);
        }
    });
</script>
@stop