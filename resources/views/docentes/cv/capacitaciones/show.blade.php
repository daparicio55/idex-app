@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Registro de Datos de la Capacitacion:</h3>
	</div>
</div>
{!! Form::model($capacitacion,['method'=>'PATCH','route'=>['cv.capacitaciones.update',$capacitacion->idCapacitacion]]) !!}
{!! Form::token() !!}

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="caNombre">Nombre de la Capacitacion.</label>
            <input type="text" name="caNombre" disabled value="{{$capacitacion->caNombre}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class='form-group'>
            <label for="caInstitucion">Institucion formadora.</label>
            <input type="text" name="caInstitucion" disabled value="{{$capacitacion->caInstitucion}}" required class="form-control">
        </div>
    </div>
    
</div>
<div class="row">
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caFechaInicio">Fecha Inicio</label>
            <input type="date" name="caFechaInicio" disabled value="{{$capacitacion->caFechaInicio}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caFechaFin">Fecha Fin</label>
            <input type="date" name="caFechaFin" disabled value="{{$capacitacion->caFechaFin}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caCiudad">Ciudad</label>
            <input type="text" name="caCiudad" disabled value="{{$capacitacion->caCiudad}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caDepartamento">Departamento</label>
            <input type="text" name="caDepartamento" disabled value="{{$capacitacion->caDepartamento}}" required class="form-control">
        </div>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
        <div class='form-group'>
            <label for="caPais">Pais</label>
            <input type="text" name="caPais" disabled value="{{$capacitacion->caPais}}" required class="form-control">
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="form-group">
            <label for="caDescripcion">Describa su formacion brevemente</label>
            <textarea name="caDescripcion" cols="30" disabled rows="5" class="form-control">{{$capacitacion->caDescripcion}}</textarea>
        </div>
    </div>
</div>
{{-- botones para guardar y cancelar --}}
<div class="col-lg-12 col-sm-12 col-md-12 col-xs-12 " style="text-align: center">
    <div class="form-group">
        <a class="btn btn-danger btn-lg" href="{{asset('cv/capacitaciones')}}"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
    </div>
</div>
@endsection