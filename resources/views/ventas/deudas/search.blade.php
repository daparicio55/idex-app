 {!! Form::open(['route'=>'ventas.deudas.index','method'=>'GET','role'=>'search','id'=>'frm']) !!}
	<x-adminlte-card title="Buscar..." theme="info" icon="fas fa-search" collapsible>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				{!! Form::label('text', 'Texto a buscar', [null]) !!}
				<input type="text" name="text" class="form-control" @if(isset($_GET['text'])) value="{{ $_GET['text'] }}" @endif>
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('finicio', 'F. Inicio', [null]) !!}
				<input type="date" name="finicio" class="form-control" @if(isset($_GET['finicio'])) value="{{ $_GET['finicio'] }}" @endif>
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('ffin', 'F. Fin', [null]) !!}
				<input type="date" name="ffin" class="form-control" @if(isset($_GET['ffin'])) value="{{ $_GET['ffin'] }}" @endif>
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('estados', 'Estado', [null]) !!}
				<select name="estados" class="form-control">
					@foreach ($estados as $key => $estado)
						<option value="{{ $key }}" @if(isset($_GET['estados'])) @if($_GET['estados']==$key) selected @endif @endif>{{ $estado }}</option>
					@endforeach
				</select>
			</div>
		</div>
		<x-slot name="footerSlot">
			<button type="submit" class="btn btn-info">
				<i class="fas fa-search-plus"></i> Buscar
			</button>
			{{-- <a href="" class="btn btn-success">
				<i class="far fa-file-excel"></i> Exportar <i class="fas fa-download"></i>
			</a> --}}
		</x-slot>
	</x-adminlte-card>
{!! Form::close() !!}

