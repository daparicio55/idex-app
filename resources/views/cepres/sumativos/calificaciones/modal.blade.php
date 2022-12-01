<div class="modal fade" id="modal-sumatorio-{{$estudiante->idCepreEstudiante}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['cepres.sumativos.calificaciones.destroy',$estudiante->idCepreEstudiante],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea cambiar estado del estudiante en el sumativo?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-check"></i> Confirmar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>

{{-- modal para subir el archivo CSV --}}

  <div class="modal fade" id="modal-csv-{{$sumativo->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['cepres.sumativos.calificaciones.subircsv',$sumativo->id],'method'=>'POST','files' => true,'enctype'=>'multipart/form-data','id'=>'frm_modal']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-file-csv"></i> Subir archivo CSV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Subir el archivo en formato CSV UTF-8 separado por ;</p>
            {!! Form::file('csv', ['class'=>'form-control','required','accept'=>'.csv']) !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cerrar
            </button>
            <button type="submit" id="btn_subir" class="btn btn-primary">
                <i class="fas fa-check"></i> Subir
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>