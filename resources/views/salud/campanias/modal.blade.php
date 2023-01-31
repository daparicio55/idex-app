<!-- Modal -->
{!! Form::open(['route'=>['salud.campanias.csv',$campania->id],'method'=>'post','enctype'=>'multipart/form-data']) !!}
<div class="modal fade" id="modal-csv-{{ $campania->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Seleccionar archivo CSV</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                {!! Form::label('csv', 'Seleccione archivo', [null]) !!}
                {!! Form::file('csv', ['class'=>'form-control','required']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="far fa-times-circle"></i> Cerrar
                </button>
                <button type="submint" class="btn btn-primary">
                    <i class="fas fa-upload"></i> Subir
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}