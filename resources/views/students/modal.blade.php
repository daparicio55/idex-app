<!-- Modal -->
<div class="modal fade" id="capacidades-{{ $unidad->id }}-periodo-{{ $nota->matricula->pmatricula_id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary">
          <h5 class="modal-title" id="exampleModalLabel">Detalles de la Unidad Didactica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @php
                $capacidades = capacidades($nota->matricula->pmatricula_id,$unidad->id); 
            @endphp
            @isset(capacidades($nota->matricula->pmatricula_id,$unidad->id)->capacidades)
                <p>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    @foreach ($capacidades->capacidades as $capacidade)
                                        <th colspan="{{ $capacidade->indicadores->count() }}" class="text-center">
                                            {{ Str::upper($capacidade->nombre) }}
                                        </th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    @foreach ($capacidades->capacidades as $capacidade)
                                        @foreach ($capacidade->indicadores as $indicadore)
                                            <td class="text-center">
                                                {{ Str::upper($indicadore->nombre) }}
                                            </td>
                                        @endforeach
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ($capacidades->capacidades as $capacidade)
                                        @foreach ($capacidade->indicadores as $indicadore)
                                            @php
                                                $indicador= $indicadore->detalles()->where('ematricula_detalle_id','=',$nota->id)->first()
                                            @endphp
                                            
                                                <td @if(isset($indicador->nota)) @if($indicador->nota>12) class="text-center text-primary" @else class="text-center text-danger" @endif @endif>
                                                    @isset($indicador->nota)
                                                        {{ $indicador->nota }}
                                                    @endisset
                                                </td>
                                            
                                        @endforeach
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                </div>
                </p>
            @endisset
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>