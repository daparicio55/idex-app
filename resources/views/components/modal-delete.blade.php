<div class="d-inline">
    {!! Form::open(['route'=>[$route,$id],'method'=>'delete','class'=>'d-inline']) !!}
    <div class="modal fade" id="deleteModal{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title"><i class="fas fa-trash-alt"></i> {{ $titulo }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{ $slot }}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        <i class="far fa-window-close"></i> Cancelar
                    </button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-exclamation-triangle"></i> Eliminar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="btn btn-danger btn-{{ $size }}" data-toggle="modal" data-target="#deleteModal{{ $id }}">
        <i class="far fa-trash-alt"></i>
    </button>
    {!! Form::close() !!}
</div>