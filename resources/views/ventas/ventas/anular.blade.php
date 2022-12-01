<div class="modal fade" id="modal-anular-1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['ventas.ventas.anular',1],'method'=>'GET','id'=>'frm_modal']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-book-dead text-danger"></i> Anular Boleta Venta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>ingrese la fecha y el numero de la botela que desea ingresar como anulada</p>
            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                <div class="form-group">
                    {!! Form::label('fecha', 'Fecha', [null]) !!}
                    {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                    {!! Form::label('numero', 'Numero', [null]) !!}
                    {!! Form::text('numero', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cerrar
            </button>
            <button type="submit" id="btn_subir" class="btn btn-danger">
                <i class="fas fa-check"></i> Anular
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>