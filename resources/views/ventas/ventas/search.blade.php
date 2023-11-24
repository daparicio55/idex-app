{!! Form::open(['route'=>'ventas.ventas.index','method'=>'GET','role'=>'search']) !!}
	<x-adminlte-card title="Buscar / Filtrar" theme="info" icon="fas fa-search" collapsible>
		<div class="row">
			<div class="col-sm-12 col-md-4">
				{!! Form::label('dni', 'DNI/RUC', [null]) !!}
				<input type="text" name="dni" id="dni" @if(isset($_GET['dni'])) value="{{ $_GET['dni'] }}" @endif class="form-control">
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('tpago', 'T. Pago', [null]) !!}
				<select name="tpago" id="tpago" class="form-control">
					@foreach (tpagos() as $pago)
						<option value="{{ $pago }}" @if(isset($_GET['tpago'])) @if($pago == $_GET['tpago']) selected @endif @endisset>{{ $pago }}</option>
					@endforeach
				</select>
				
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('estado', 'Estado', [null]) !!}
				<select name="estado" id="estado" class="form-control">
					<option value="Todos">Todos</option>
					@foreach (ventaestados() as $ventaestado)
						<option value="{{ $ventaestado }}" @if(isset($_GET['estado'])) @if($ventaestado == $_GET['estado']) selected @endif @endif >{{ $ventaestado }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('finicio', 'F. Inicio', [null]) !!}
				<input type="date" name="finicio" id="finicio" @if(isset($_GET['finicio'])) value="{{ $_GET['finicio'] }}" @endif class="form-control" required>
			</div>
			<div class="col-sm-12 col-md-2">
				{!! Form::label('ffin', 'F. Fin', [null]) !!}
				<input type="date" name="ffin" id="ffin" @if(isset($_GET['ffin'])) value="{{ $_GET['ffin'] }}" @endif class="form-control" required>
			</div>
			<div class="col-sm-12 col-md-12 mt-2">
				@php
					$config = [
						"placeholder" => "Seleccione servicio o servicios...",
						"allowClear" => true,
					];
				@endphp
				<x-adminlte-select2 id="servicios" name="servicios[]" label="Servicio o Producto"
					label-class="text-black" :config="$config" multiple>
					<x-slot name="prependSlot">
						<div class="input-group-text bg-gradient-info">
							<i class="fas fa-tag"></i>
						</div>
					</x-slot>
					@php
						$seleccionado = false;
					@endphp
					@foreach ($servicios as $servicio)
						@if(isset($_GET['servicios']))
							@if (in_array($servicio->idServicio,$_GET['servicios']))
								@php
									$seleccionado = true;	
								@endphp
							@else
								@php
									$seleccionado = false;	
								@endphp
							@endif
						@endif
						<option value="{{ $servicio->idServicio }}" @if($seleccionado == true) selected @endif >{{ $servicio->nombre }}</option>
					@endforeach
				</x-adminlte-select2>
			</div>
		</div>
		<x-slot name="footerSlot">
			<input type="hidden" name="buscar" id="buscar" value="SI">
			<button type="submit" class="btn btn-info">
				<i class="fa fa-search"></i> Buscar
			</button>
			@if (isset($_GET['buscar']))
				<button type="button" id="btn_enviar" class="btn btn-secondary">
					<i class="fas fa-eye"></i> Reporte
				</button>
			@endif
			@if (isset($_GET['buscar']))
				<button type="button" id="btn_excel" class="btn btn-success">
					<i class="fas fa-file-excel"></i> Excel
				</button>
			@endif
			<a href="{{ route('ventas.ventas.index') }}" class="btn btn-danger">
				<i class="fas fa-broom"></i> Limpiar
			</a>
		</x-slot>
	</x-adminlte-card>
{!! Form::close() !!}
