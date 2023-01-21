@extends ('layouts.admin')
@section ('contenido')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de hojas de Vida</h3>
	</div>
</div>
<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
                <thead>
                    <th>Apellidos</th>
                    <th>Nombres</th>
                    <th>Correo</th>
                    <th>telefono</th>
                </thead>
                <tbody>
                    @foreach ($personales as $personal)
                    <tr>
                        <td>{{$personal->apellidos}}</td>
                        <td>{{$personal->nombres}}</td>
                        <td>{{$personal->correoInstitucional}}</td>
                        <td>{{$personal->telefono}}</td>
                        <td style="width: 100px">
                           <a class="btn btn-success" href="{{URL::action('cvController@show',$personal->id)}}"><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Descargar</a> 
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection