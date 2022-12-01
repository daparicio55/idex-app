{{-- modal para subir el archivo CSV --}}

<div class="modal fade" id="modal-csv-{{$admision->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['admisiones.ordinarios.subircsv',$admision->id],'method'=>'POST','files' => true,'enctype'=>'multipart/form-data','id'=>'frm_modal']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-file-csv"></i> Subir archivo CSV</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Subir el archivo en formato CSV UTF-8 separado por ; con los datos de las fichas de postulantes</p>
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

  {{-- modal para subir las bonificaciones --}}
  {{-- modal para subir el archivo CSV --}}

<div class="modal fade" id="modal-bonificaciones-{{$admision->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  {!! Form::open(['route'=>['admisiones.ordinarios.bonificaciones',$admision->id],'method'=>'POST','files' => true,'enctype'=>'multipart/form-data','id'=>'frm_modal']) !!}
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-file-csv"></i> Subir archivo CSV de Bonificiaciones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Subir el archivo en formato CSV UTF-8 separado por ; con los puntos de bonificación</p>
          {!! Form::file('csv', ['class'=>'form-control','required','accept'=>'.csv']) !!}
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-power-off"></i> Cerrar
          </button>
          <button type="submit" id="btn_subir" class="btn btn-warning">
              <i class="fas fa-check"></i> Subir
          </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>

{{-- editar bonificacion manual --}}

<div class="modal fade" id="modal-bono-{{$postulante->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  {!! Form::open(['route'=>['admisiones.ordinarios.bono',$postulante->id],'method'=>'GET','id'=>'frm_modal']) !!}
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-file-csv"></i> Editar Bonificación</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>ingresa el valor de la bonificación</p>
          {!! Form::number('bonificacion', $postulante->bonificacion, ['class'=>'form-control','required','step'=>0.01]) !!}
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
              <i class="fas fa-power-off"></i> Cerrar
          </button>
          <button type="submit" id="btn_subir" class="btn btn-warning">
              <i class="fas fa-check"></i> Subir
          </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>