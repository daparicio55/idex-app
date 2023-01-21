@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<h3>Lista de Capacitacion o Actualizaciones Realizados
            <a class="btn btn-primary" href="{{asset('cv/capacitaciones/create')}}">
                <i class="fa fa-file-text" aria-hidden="true"></i>
                Registrar Nuevo
            </a>
            <a class="btn btn-danger" href="{{asset('cv')}}">
                <i class="fa fa-chevron-circle-left" aria-hidden="true"></i>
                Regresar
            </a>
        </h3>
        <p>registre la formacion iniciando de la mas reciente a la mas antigua</p>
	</div>
</div>
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif

{{-- tabla --}}
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Titulo</th>
                    <th>Institucion</th>
                    <th>Inicio</th>
                    <th>Fin</th>
                </thead>
                <tbody>
                    @foreach ($capacitaciones as $capacitacion)
                    <tr>
                        <td>{{$capacitacion->caNombre}}</td>
                        <td>{{$capacitacion->caInstitucion}}</td>
                        <td>{{date('d-m-Y',strtotime($capacitacion->caFechaInicio))}}</td>
                        <td>{{date('d-m-Y',strtotime($capacitacion->caFechaFin))}}</td>
                        <td style="text-align: center; width: 140px">
                            <a class="btn btn-info" href="{{URL::action('cvCapacitacionController@show',$capacitacion->idCapacitacion)}}">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-success" href="{{URL::action('cvCapacitacionController@edit',$capacitacion->idCapacitacion)}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                            </a>
                            <a class="btn btn-danger" data-target="#modal-delete-{{$capacitacion->idCapacitacion}}" data-toggle="modal" href="">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @include('cv.capacitaciones.modal')
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
{{-- fin tabla --}}

@push ('scripts')
<script>
    $(document).ready(function(){
        setTimeout(() => {
        $("#info").hide();
      }, 12000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
      }, 12000);
    })
</script>
@endpush
@endsection