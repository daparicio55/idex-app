{{-- modal para enviar el documento --}}
<div class="modal fade" id="modal-enviar-{{$documento->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['tdocumentario.mesapartes.update',$documento->id],'method'=>'put','id'=>'frm_enviar'.$documento->id]) !!}    
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-info">
          <h5 class="modal-title"><i class="fas fa-mail-bulk"></i> Confirmar envio <i class="far fa-paper-plane"></i></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('folios', 'Folios', [null]) !!}
                    {!! Form::number('folios', 0, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    {!! Form::label('user_id', 'Enviar a:', [null]) !!}
                    {!! Form::select('user_id', $usuarios, null, ['class'=>"form-control selectpicker","data-live-search"=>"true","data-size"=>"5"]) !!}
                    </select>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {!! Form::label(null, 'Observacion', [null]) !!}
                {!! Form::textarea('observacion', '-', ['class'=>'form-control','rows'=>'3','required']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cerrar
            </button>
            <button type="submit" class="btn btn-primary" onclick="desactivar({{ $documento->id }},'btn_enviar')"  id="btn_enviar-{{ $documento->id }}">
                <i class="fas fa-share"></i> Enviar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>
  
{{-- modal para enviar cambiar el numero --}}
<div class="modal fade" id="modal-numero-{{$documento->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  {!! Form::open(['route'=>['tdocumentario.mesapartes.edit',$documento->id],'method'=>'get','id'=>'frm_cambiar']) !!}    
  <div class="modal-dialog modal-dialog-centered modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><i class="fas fa-sort-numeric-up-alt"></i> Número</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  {!! Form::label('numero', 'Numero', [null]) !!}
                  {!! Form::number('numero',null , ['class'=>'form-control','required']) !!}
              </div>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-power-off"></i> Cerrar
          </button>
          <button type="submit" class="btn btn-primary" id="btn_cambiar">
              <i class="fas fa-share"></i> Cambiar
          </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>


{{-- modal para eliminar un documento --}}
<div class="modal fade" id="modal-delete-{{$documento->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  {!! Form::open(['route'=>['tdocumentario.mesapartes.destroy',$documento->id],'method'=>'delete','id'=>'frm_eliminar']) !!}    
  <div class="modal-dialog modal-dialog-centered modal-dm">
    <div class="modal-content">
      <div class="modal-header bg-danger">
        <h5 class="modal-title"><i class="fas fa-sort-numeric-up-alt"></i> Eliminar Documento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <div class="row">
              <p>este proceso es irreversible, ¿esta seguro que desea eliminar este documento?</p>
          </div>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">
              <i class="fas fa-power-off"></i> Cancelar
          </button>
          <button type="submit" class="btn btn-primary" id="btn_eliminar">
            <i class="fas fa-trash-alt"></i> Eliminar
          </button>
      </div>
    </div>
  </div>
  {!! Form::close() !!}
</div>