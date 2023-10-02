<!-- Modal -->
<div class="modal fade" id="capacidades-{{ $unidad->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Detalles de la Unidad Didactica</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @isset(capacidades($nota->matricula,$unidad->id)->capacidades)
                <p>
                    <table class="table">
                        <thead>
                            <tr>
                                @foreach (capacidades($nota->matricula,$unidad->id)->capacidades as $capacidade)
                                    <th colspan="{{ $capacidade->indicadores->count() }}" class="text-center">
                                        {{ Str::upper($capacidade->nombre) }}
                                    </th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                @foreach (capacidades($nota->matricula,$unidad->id)->capacidades as $capacidade)
                                    @foreach ($capacidade->indicadores as $indicadore)
                                        <td class="text-center">
                                            {{ Str::upper($indicadore->nombre) }}
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                            <tr>
                                @foreach (capacidades($nota->matricula,$unidad->id)->capacidades as $capacidade)
                                    @foreach ($capacidade->indicadores as $indicadore)
                                        <td class="text-center">
                                            @php
                                                $indicador= $indicadore->detalles()->where('ematricula_detalle_id','=',$nota->ematricula)->first()
                                            @endphp
                                            @isset($indicador->nota)
                                                {{ $indicador->nota }}
                                            @endisset
                                        </td>
                                    @endforeach
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </p>
            @endisset
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>