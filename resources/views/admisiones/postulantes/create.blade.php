@extends('adminlte::page')
@section('title', 'Postulante Crear')
@section('content_header')
    <h1>Registrar Nuevo Postulante</h1>
@stop

@section('content')
@include('admisiones.postulantes.searchdni')
@include('admisiones.postulantes.modal')
{!! Form::open(['id'=>'frm_datos','name'=>'frm_datos','route'=>'admisiones.postulantes.store','method'=>'POST','files'=>true,'enctype'=>'multipart/form-data','autocomplete'=>'off']) !!}
<input type="hidden" id="direc" value="{{ asset("") }}">
{!! Form::hidden('dniRuc', $cliente->dniRuc, [null]) !!}
{!! Form::hidden('idCliente', $cliente->idCliente, [null]) !!}
{!! Form::hidden('id', auth()->id(), [null]) !!}
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
                            {!! Form::text('apellido', $cliente->apellido, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="nombre">Nombres</label>
                            {!! Form::text('nombre', $cliente->nombre, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono">Tel. Llamadas</label>
                            {!! Form::text('telefono', $cliente->telefono, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono2">Tel. WhatsApp</label>
                            {!! Form::text('telefono2', $cliente->telefono2, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class='form-group'>
                            <label for="fechaNacimiento">F. Nacimiento</label>
                            {!! Form::date('fechaNacimiento', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            {!! Form::label('sexo', "Sexo", [null]) !!}
                            {!! Form::select('sexo', $sexos, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-group">
                            {!! Form::label('idioma', "Idioma", [null]) !!}
                            {!! Form::select('idioma', $idiomas, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila --}}
                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="email">E. Mail</label>
                            {!! Form::text('email', $cliente->email, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila de direccion--}}
                    <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="direccion">Dirección</label>
                            {!! Form::text('direccion', $cliente->direccion, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- foto --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            {!! Form::label(null, 'Foto', [null]) !!}
                            {!! Form::file('url', ['class'=>'form-control','accept="image/*"','required']) !!}
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
                <h4><i class="fas fa-briefcase"></i> Datos de Carrera.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                        {!! Form::label(null, 'Carrera', [null]) !!}
                        {!! Form::select('idCarrera', $carreras, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        {!! Form::label(null, 'Periodo', [null]) !!}
                        {!! Form::select('admisione_id', $admisiones, null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        {!! Form::label(null, 'Fecha', [null]) !!}
                        {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        {!! Form::label(null, 'Boleta', [null]) !!}
                        {!! Form::text('boleta', null, ['class'=>'form-control','required']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- modalidad de postulaciones --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-people-carry" aria-hidden="true"></i> Modalidades de Postulacion.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            {!! Form::label(null, 'Tipo de Modalidad', [null]) !!}
                            {!! Form::select('modalidadTipo', $modalidadTipo, null, ['class'=>'form-control selectpicker','id'=>'modalidadTipo']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="form-group">
                            {!! Form::label(null, 'Modalidad', [null]) !!}
                            {!! Form::select('modalidad', $modalidad, null, ['class'=>'form-control selectpicker','id'=>'modalidad']) !!}
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
                <h4><i class="fa fa-graduation-cap" aria-hidden="true"></i> Datos Academicos.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class='form-group'>
                            <label for="ieProcedencia">Codigo - Institucion secundaria de la que proviene</label>
                            <div class="input-group">
                                <input type="text" id="txt_codigo" name="txt_codigo" class="form-control">
                                <span class="input-group-btn">
                                    <a name="boton" id="boton" class="btn btn-primary" data-target="#modal-colegios" data-toggle="modal" role="button" onclick="buscarCodigo()">
                                        <i class="fas fa-search-plus"></i> Buscar
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>
                    {{-- siguiente linea --}}
                    <input type="hidden" name='colegio_id' id="colegio_id" value=0>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Nombre del Colegio', [null]) !!}                            
                            {!! Form::text('CEN_EDU', null, ['class'=>'form-control','id'=>'CEN_EDU','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Código', [null]) !!}
                            {!! Form::text('COD_MOD', null, ['class'=>'form-control','id'=>'COD_MOD','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Nivel', [null]) !!} 
                            {!! Form::text('D_NIV_MOD', null, ['class'=>'form-control','id'=>'D_NIV_MOD','disabled']) !!}
                        </div>
                    </div>
                    {{-- siguiente linea --}}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Distrito', [null]) !!}
                            {!! Form::text('D_DIST', null, ['class'=>'form-control','required','id'=>'D_DIST','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Provincia', [null]) !!}
                            {!! Form::text('D_PROV', null, ['class'=>'form-control','required','id'=>'D_PROV','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Departamento', [null]) !!}
                            {!! Form::text('D_DPTO', null, ['class'=>'form-control','required','id'=>'D_DPTO','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Dirección', [null]) !!}
                            {!! Form::text('DIR_CEN', null, ['class'=>'form-control','required','id'=>'DIR_CEN','disabled']) !!}
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Año de Termino', [null]) !!}
                            {!! Form::number('anioColegio', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- discapacidad --}}
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fas fa-crutch" aria-hidden="true"></i> Discapacidad.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    {{-- siguiente linea --}}
                    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                        <label for="">¿Es usted una persona con discapacidad?</label>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value=0 name="discapacidad" required> SI
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value=1 name="discapacidad" required> NO
                            </label>
                          </div>
                          <label for="discapacidadNombre">¿Cual?</label>
                          {!! Form::text('discapacidadNombre', '-', ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- otra fila --}}
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
    var direc = $('#direc').val();
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
    function buscarCodigo(){
        var codigo;
        codigo = $('#txt_codigo').val();
        const URL = direc+'colegios/'+codigo;
        var xhr = new XMLHttpRequest();
        xhr.addEventListener("load",onRequestHandler);
        xhr.open('GET', URL);
        xhr.send();
    }
    function coleagregar(id){
        var rows = document.getElementById(id);
        $('#CEN_EDU').val(rows.cells[2].innerHTML);
        $('#D_NIV_MOD').val(rows.cells[6].innerHTML);
        $('#COD_MOD').val(rows.cells[0].innerHTML);
        $('#D_DIST').val(rows.cells[3].innerHTML);
        $('#D_PROV').val(rows.cells[4].innerHTML);
        $('#D_DPTO').val(rows.cells[5].innerHTML);
        $('#DIR_CEN').val(rows.cells[1].innerHTML);
        $('#colegio_id').val(rows.cells[7].innerHTML);
    }
    function onRequestHandler(){
        var data = JSON.parse(this.response);
        const HTMLResponse = document.querySelector('#cuerpo');
        const tpl = data.map((colegios)=>"<tr id="+colegios.id+"><td>"+colegios.COD_MOD+"</td><td>"+colegios.DIR_CEN+"</td><td>"+colegios.CEN_EDU+"</td><td>"+colegios.D_DIST+"</td><td>"+colegios.D_PROV+"</td><td>"+colegios.D_DPTO+"</td><td>"+colegios.D_NIV_MOD+"</td><td hidden>"+colegios.id+"</td><td style='width : 50px'><button class='btn btn-success' data-dismiss='modal' onclick='coleagregar("+colegios.id+")'>Ir</button></td></tr>");
        HTMLResponse.innerHTML = tpl;
    }



</script>
@stop