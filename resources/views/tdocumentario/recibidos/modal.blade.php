{!! Form::open(['route'=>['tdocumentario.rdocumentos.update',$recibido->id],'method'=>'put']) !!}
<div class="modal fade" id="modal-enviar-{{$recibido->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-mail-bulk"></i> Confirmar envio <i class="far fa-paper-plane"></i></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div> 
      <div class="modal-body">
          <div class="form-group">
              <div class="row">
                  <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                      {!! Form::label('folios', 'Folios', [null]) !!}
                      {!! Form::number('folios', 0, ['class'=>'form-control']) !!}
                  </div>
                  <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                      {!! Form::label('user_id', 'Usuario', [null]) !!}
                      {!! Form::select('user_id', $usuarios, null, ['class'=>'form-control selectpicker','data-live-search'=>'true', 'data-size'=>5]) !!}
                  </div>
              </div>  
          </div>
          <div class="form-group">
              {!! Form::label(null, 'Observacion', [null]) !!}
              {!! Form::textarea('observacion', null, ['class'=>'form-control','rows'=>3]) !!}
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-power-off"></i> Cerrar
          </button>
          <button type="submit" class="btn btn-primary">
              <i class="fas fa-share"></i> Enviar
          </button>
      </div>
    </div>
  </div>  
</div>
{!! Form::close() !!}

{!! Form::open(['route'=>['tdocumentario.rdocumentos.edit',$recibido->id],'method'=>'get']) !!}    
  <div class="modal fade" id="modal-finalizar-{{$recibido->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-mail-bulk"></i> Confirmar Finalizacion del Documento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <p>esta opcion es irreversible, esta seguro que desea dar final al tramite de este documento...</p>
            <div class="form-group">
              <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('folios', 'Folios', [null]) !!}
                    {!! Form::number('folios', 0, ['class'=>'form-control','required']) !!}
                </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                      {!! Form::label('observacion', 'Observacion', [null]) !!}
                      {!! Form::textarea('observacion', '-', ['class'=>'form-control','rows'=>'3','required']) !!}
                  </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cerrar
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-stamp"></i> Finalizar
            </button>
        </div>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
