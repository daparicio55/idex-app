{!! Form::open(['route'=>['sacademica.convalidaciones.destroy',$convalidacion->id],'method'=>'delete']) !!}
<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="delete-{{ $convalidacion->id }}">
    <div class="modal-dialog modal-dialog-centered modal-lg">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirma tu acción</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              {!! Form::hidden('origen', 'convalidaciones', [null]) !!}
			<div class="modal-body">
				<p>Esta seguro que desea eliminar esta convalidación del sistema <b>DNI: {{ $convalidacion->estudiante->postulante->cliente->dniRuc }}
                {{ $convalidacion->estudiante->postulante->cliente->apellido }}, {{ $convalidacion->estudiante->postulante->cliente->nombre }}
                </p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger" data-dismiss="modal">
                    <i class="fas fa-times"></i> Cerrar
                </button>
				<button type="submit" class="btn btn-primary">
                    <i class="fas fa-check"></i> Confirmar
                </button>
			</div>
		</div>
	</div>
</div>
{!! Form::close() !!}