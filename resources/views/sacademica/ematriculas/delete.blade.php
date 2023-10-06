<div class="modal fade" id="modal-delete-{{$matricula->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['sacademica.matriculas.destroy',$matricula->id],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar esta matricula del sistema?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-trash-alt"></i>Eliminar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
</div>



  <div class="modal fade" id="modal-licencia-{{$matricula->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['sacademica.licencias.show',$matricula->id],'method'=>'get']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea poner en licencia esta matricula?
            <div class="form-group">
              {!! Form::label('licenciaObservacion', 'Observacion', [null]) !!}
              {!! Form::textarea('licenciaObservacion', $matricula->licenciaObservacion, ['class'=>'form-control','rows'=>'4']) !!}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
              <i class="fas fa-sign-out-alt"></i> Licencia
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>

  <div class="modal fade" id="modal-dlicencia-{{$matricula->id}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {!! Form::open(['route'=>['sacademica.licencias.destroy',$matricula->id],'method'=>'delete']) !!}
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Confirmar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            ¿Esta seguro que desea eliminar esta licencia del sistema?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cancelar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-trash-alt"></i>Eliminar
            </button>
        </div>
      </div>
    </div>
    {!! Form::close() !!}
  </div>


  
  <div class="modal fade" id="modal-unidades-{{ $matricula->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    {{-- {!! Form::open(['route'=>['sacademica.matriculas.destroy',$matricula->id],'method'=>'delete']) !!} --}}
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-info"><i class="fas fa-list-ol"></i> Unidades Didacticas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <ul>
            @foreach ($matricula->detalles as $detalle)
              {!! Form::open(['route'=>['sacademica.matriculasdetalles.destroy',$detalle->id],'method'=>'delete']) !!}
                <input type="hidden" name="origen" value="matriculas">
                <li class="mb-1"><button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i></button>  {{ $detalle->unidad->nombre }}</li>
              {!! Form::close() !!}
            @endforeach
          </ul>
           
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cerrar
            </button>
        </div>
      </div>
    </div>
    {{-- {!! Form::close() !!} --}}
</div>