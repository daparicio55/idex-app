@extends('adminlte::page')
@section('title', 'Servicios Crear')
@section('content_header')
    <h1>Editar Registro de Estudiante</h1>
@stop

@section('content')
{!! Form::model($cepreEstudiante, ['route'=>['cepres.estudiantes.update',$cepreEstudiante->idCepreEstudiante],'method'=>'put','autocomplete'=>'off','id'=>'frm_datos','name'=>'frm_datos']) !!}
{!! Form::hidden('idCliente', $cepreEstudiante->cliente->idCliente, [null]) !!}
{!! Form::hidden('ceEsFecha', date('Y-m-d H:i:s'), [null]) !!}
{!! Form::hidden('id', auth()->id(), [null]) !!}
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
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class='form-group'>
                            <label for="direccion">Dirección</label>
                            {!! Form::text('direccion', $cepreEstudiante->cliente->direccion, ['class'=>'form-control','required']) !!}
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
                        {!! Form::select('idCepre', $cepres, null, ['class'=>'form-control']) !!}
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
                            <label for="ieProcedencia">Institucion secundaria de la que proviene</label>
                            {!! Form::text('ieProcedencia', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente linea --}}
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="ieDistrito">Distrito</label>
                            {!! Form::text('ieDistrito', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="ieProvincia">Provincia</label>
                            {!! Form::text('ieProvincia', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                        <div class='form-group'>
                            <label for="ieDepartamento">Departamento</label>
                            {!! Form::text('ieDepartamento', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class='form-group'>
                            <label for="ieDireccion">Dirección</label>
                            {!! Form::text('ieDireccion', null, ['class'=>'form-control','required']) !!}
                        </div>
                    </div>
                    {{-- siguiente linea --}}
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
    $('#frm_datos').submit(function(event){
        $("#bt_guardar").attr("disabled",true);
    });
</script>
@stop