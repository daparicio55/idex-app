@extends('adminlte::page')
@section('title', 'Estudiante Crear')
@section('content_header')
    <h1> Registro de Verificaciones Avanzados</h1>
@stop
@section('content') 
{!! Form::open(['id'=>'frm_datos','name'=>'frm_datos','route'=>'sacademica.verificacionesas.store','method'=>'POST','autocomplete'=>'off']) !!}
<input type="hidden" value="{{ $estudiante->id }}" name="estudiante_id">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fa fa-user" aria-hidden="true"></i> Datos Personales.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="apellido">Apellidos</label>
                            {!! Form::text('apellido', $estudiante->postulante->cliente->apellido, ['class'=>'form-control','required','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="nombre">Nombres</label>
                            {!! Form::text('nombre', $estudiante->postulante->cliente->nombre, ['class'=>'form-control','required','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono">Tel. Llamadas</label>
                            {!! Form::text('telefono', $estudiante->postulante->cliente->telefono, ['class'=>'form-control','required','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono2">Tel. WhatsApp</label>
                            {!! Form::text('telefono2', $estudiante->postulante->cliente->telefono2, ['class'=>'form-control','required','disabled']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila --}}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="email">E. Mail</label>
                            {!! Form::text('email', $estudiante->postulante->cliente->email, ['class'=>'form-control','required','disabled']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila de direccion--}}
                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class='form-group'>
                            <label for="direccion">Dirección</label>
                            {!! Form::text('direccion', $estudiante->postulante->cliente->direccion, ['class'=>'form-control','required','disabled']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-graduation-cap"></i> Programa de Estudios.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class='form-group'>
                            <h5>{{ $estudiante->postulante->carrera->nombreCarrera }}</h5>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class='form-group'>
                            <h5>Ingreso: {{ $estudiante->postulante->admisione->periodo }}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-book"></i> Unidades Didacticas.</h4>
                <div class="row">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label for="">Periodo</label>
                        {!! Form::select('pmatricula_id', $periodos, null, ['class'=>'form-control','id'=>'periodos']) !!}
                        
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <label for="">Fecha</label>
                        {!! Form::date('fecha', null, ['class'=>'form-control','required','id'=>'ff']) !!}
                    </div>
                </div>
                </div>
            <div class="card-body">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th>Tipo</th>
                                <th>{{ $ciclo }} SEMESTRE</th>
                                <th>Cre.</th>
                                <th>Hor.</th>
                                <th style="width: 110px">Nota</th>
                                <th>NM</th>
                            </thead>
                           <tbody>
                                @foreach ($itineario->modulos as $modulo )
                                    @if($modulo->carrera_id == $estudiante->postulante->idCarrera)
                                        @foreach ($modulo->unidades as $unidad)
                                            @if ($unidad->ciclo == $ciclo)
                                            <tr>
                                                <td>{{ $unidad->tipo }}</td>
                                                <td>{{ $unidad->nombre }}</td>
                                                <td>{{ $unidad->creditos }}</td>
                                                <td>{{ $unidad->horas }}</td>
                                                {{-- <td>{!! Form::number('nota[]', null, ['class'=>'form-control']) !!}</td> --}}
                                                <td>
                                                    <input type="hidden" name="id[]" value="{{ $unidad->id }}">
                                                    <input type="number" name="notas[]" id="nota{{ $unidad->id }}" required class="form-control" max="20" min="0">
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" value="" onclick="alerta({{ $unidad->id }})">
                                                    </div>
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
        <div class="form-group">
            <button class="btn btn-primary btn-lg" type="submit" id='bt_guardar' name='bt_guardar'>
                <i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar
            </button>
{!! Form::close() !!}            
            <a class="btn btn-danger btn-lg" href="{{route('admisiones.postulantes.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Salir</a>
        </div>
    </div>
</div>
@stop
@section('js')
<script>
    $('#periodos').change(function(event){
        var selection = document.getElementById('periodos');
        var separar = selection.options[selection.selectedIndex].text;
        var dato = separar.split('-');
        var fecha = null;
        if (dato[1]=='1'){
            fecha = dato[0]+'-08-04';
        }
        if (dato[1]=='2'){
            fecha = dato[0]+'-12-30';
        }
        $('#ff').val(fecha);
    });
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
    function alerta(id){
        if (document.getElementById('nota'+id).readOnly == false){
            document.getElementById('nota'+id).type = 'text';
            document.getElementById('nota'+id).value = 'NM';
            document.getElementById('nota'+id).readOnly = true;
        }
        else
        {
            document.getElementById('nota'+id).type = 'number';
            document.getElementById('nota'+id).removeAttribute('readOnly');
        }        
    }
</script>
@stop