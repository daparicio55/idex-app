@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de Datos Personales:</h3>
	</div>
</div>
{!! Form::open(array('url'=>'cv/capacitaciones/','method'=>'POST','autocomplete'=>'off')) !!}
{!! Form::token() !!}

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="caNombre">Nombre de la Capacitacion.</label>
            <input type="text" name="caNombre" required class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="caInstitucion">Institucion formadora.</label>
            <input type="text" name="caInstitucion" required class="form-control">
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caFechaInicio">Fecha Inicio</label>
            <input type="date" name="caFechaInicio" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caFechaFin">Fecha Fin</label>
            <input type="date" name="caFechaFin" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caCiudad">Ciudad</label>
            <input type="text" name="caCiudad" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caDepartamento">Departamento</label>
            <input type="text" name="caDepartamento" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caPais">Pais</label>
            <input type="text" name="caPais" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="caDescripcion">Describa su formacion brevemente</label>
            <textarea name="caDescripcion" cols="30" rows="5" class="form-control"></textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <input name="_token" value="{{ csrf_token() }}" type="hidden">
        <button class="btn btn-primary btn-lg" type="submit" id="bt_guardar"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>
{!! Form::close() !!}
<a class="btn btn-danger btn-lg" href="{{asset('cv/capacitaciones')}}"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>
@endsection