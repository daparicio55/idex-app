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

{!! Form::open(['route'=>['salud.campanias.excel',$campania->id],'method'=>'post','enctype'=>'multipart/form-data']) !!}
<div class="modal fade" id="modal-excel-{{ $campania->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header bg-warning">
                <h5 class="modal-title">Seleccionar archivo Excel</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
            </div>
            <div class="modal-body">
                <p>Seleccione el archivo de excel con los datos de la atencion de la campaña, solo para docentes.</p>
                {!! Form::label('excel', 'Seleccione archivo', [null]) !!}
                {!! Form::file('excel', ['class'=>'form-control','required']) !!}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="far fa-times-circle"></i> Cerrar
                </button>
                <button type="submint" class="btn btn-warning">
                    <i class="fas fa-upload"></i> Subir
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}