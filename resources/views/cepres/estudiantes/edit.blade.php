@extends('adminlte::page')
@section('title', 'Servicios Crear')
@section('content_header')
    <h1>Editar Registro de Estudiante</h1>
@stop

@section('content')
@include('cepres.estudiantes.colegio')
{!! Form::model($cepreEstudiante, ['route'=>['cepres.estudiantes.update',$cepreEstudiante->idCepreEstudiante],'method'=>'put','autocomplete'=>'off','id'=>'frm_datos','name'=>'frm_datos','enctype'=>'multipart/form-data']) !!}
{!! Form::hidden('idCliente', $cepreEstudiante->cliente->idCliente, [null]) !!}
{!! Form::hidden('ceEsFecha', date('Y-m-d H:i:s'), [null]) !!}
{!! Form::hidden('id', auth()->id(), [null]) !!}
<input type="hidden" id="direc" value="{{ asset("") }}">
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fa fa-user" aria-hidden="true"></i> Datos Personales.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class='form-group'>
                            <label for="apellido">DNI</label>
                            {!! Form::text('dniRuc', $cepreEstudiante->cliente->dniRuc, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="apellido">Apellidos</label>
                            {!! Form::text('apellido', $cepreEstudiante->cliente->apellido, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="nombre">Nombres</label>
                            {!! Form::text('nombre', $cepreEstudiante->cliente->nombre, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono">Tel. Llamadas</label>
                            {!! Form::text('telefono', $cepreEstudiante->cliente->telefono, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="telefono2">Tel. WhatsApp</label>
                            {!! Form::text('telefono2', $cepreEstudiante->cliente->telefono2, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila --}}
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="email">E. Mail</label>
                            {!! Form::text('email', $cepreEstudiante->cliente->email, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="fechaNacimiento">F. Nacimiento</label>
                            {!! Form::date('fechaNacimiento', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="ceEsDistrito">Distrito</label>
                            {!! Form::text('ceEsDistrito', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="ceEsProvincia">Provincia</label>
                            {!! Form::text('ceEsProvincia', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="ceEsDepartamento">Departamento</label>
                            {!! Form::text('ceEsDepartamento', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente fila de direccion--}}
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class='form-group'>
                            <label for="direccion">Dirección</label>
                            {!! Form::text('direccion', $cepreEstudiante->cliente->direccion, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <label for="url">Foto</label>
                        {!! Form::file('url', ['class'=>'form-control']) !!}
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
                        {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control']) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- nuevo colegio --}}
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
                            <label>Codigo - Institucion secundaria de la que proviene</label>
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
                            {!! Form::text('ieProcedencia', null, ['class'=>'form-control','id'=>'CEN_EDU','readonly']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Código', [null]) !!}
                            {!! Form::text('COD_MOD', null, ['class'=>'form-control','id'=>'COD_MOD','readonly']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Nivel', [null]) !!} 
                            {!! Form::text('D_NIV_MOD', null, ['class'=>'form-control','id'=>'D_NIV_MOD','readonly']) !!}
                        </div>
                    </div>
                    {{-- siguiente linea --}}
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Distrito', [null]) !!}
                            {!! Form::text('ieDistrito', null, ['class'=>'form-control','required','id'=>'D_DIST','readonly']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Provincia', [null]) !!}
                            {!! Form::text('ieProvincia', null, ['class'=>'form-control','required','id'=>'D_PROV','readonly']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Departamento', [null]) !!}
                            {!! Form::text('ieDepartamento', null, ['class'=>'form-control','required','id'=>'D_DPTO','readonly']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class='form-group'>
                            {!! Form::label(null, 'Dirección', [null]) !!}
                            {!! Form::text('ieDireccion', null, ['class'=>'form-control','required','id'=>'DIR_CEN','readonly']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- fin nuevo colegio --}}



<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card sm-12">
            <div class="card-header">
                <h4><i class="fa fa-graduation-cap" aria-hidden="true"></i> Otros Datos.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <label for="">¿Es usted una persona con discapacidad?</label>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" @if($cepreEstudiante->ceEsDiscapacidad == 'SI') checked @endif value="SI" name="ceEsDiscapacidad"  required> SI
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" @if($cepreEstudiante->ceEsDiscapacidad == 'NO') checked @endif value="NO" name="ceEsDiscapacidad" required> NO
                            </label>
                          </div>
                          <label for="ceEsObservacion">¿Cual?</label>
                          {!! Form::text('ceEsObservacion', null, ['class'=>'form-control']) !!}
                    </div>
                    <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                        <label for="">¿Cuenta usted con certificado de discapacidad?</label>
                        <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="SI" @if($cepreEstudiante->ceEsDisCertificado == 'SI') checked @endif  name="ceEsDisCertificado" required> SI
                            </label>
                          </div>
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" value="NO" @if($cepreEstudiante->ceEsDisCertificado == 'NO') checked @endif name="ceEsDisCertificado" required> NO
                            </label>
                          </div>
                          <label for="">¿Otro Documento?</label>
                          {!! Form::text('ceEsDisCerObservacion', null, ['class'=>'form-control']) !!}
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
                <h4><i class="fas fa-hospital-user"></i> Contacto en caso de Emergencia.</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="conApellido">Apellidos</label>
                            {!! Form::text('conApellido', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <div class='form-group'>
                            <label for="conNombre">Nombres</label>
                            {!! Form::text('conNombre', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="conTelefono">Telefono</label>
                            {!! Form::text('conTelefono', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="conParentesco">Parentesco</label>
                            {!! Form::text('conParentesco', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente linea --}}
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class='form-group'>
                            <label for="conDireccion">Dirección</label>
                            {!! Form::text('conDireccion', null, ['class'=>'form-control','required']) !!}
                        </div>
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
            <a class="btn btn-danger btn-lg" href="{{route('cepres.estudiantes.index')}}"><i class="fa fa-ban" aria-hidden="true"></i> Salir</a>
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