<div class="modal fade" id="modal-detalles" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Detalles de Postulantes</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="table-responsive">
                <table class="table" id="tabla">
                    <thead class="thead-dark">
                        <th style="width: 50px">Exp.</th>
                        <th>DNI</th>
                        <th>Apellidos, Nombres</th>
                        <th>Carrera</th>
                        <th>Modalidad</th>
                    </thead>
                    <tbody>
                        @foreach ($postulantesX as $xpostulante)
                            <tr>
                                <td>
                                    @php
                                    $largo = Str::length($xpostulante->expediente);
                                    if($largo == 1){
                                        $expediente = '00'.$xpostulante->expediente;
                                    }
                                    if($largo == 2){
                                        $expediente = '0'.$xpostulante->expediente;
                                    }
                                    if($largo == 3){
                                        $expediente = $xpostulante->expediente;
                                    }
                                    @endphp
                                    {{ $expediente }}
                                </td>
                                <td>{{ $xpostulante->cliente->dniRuc }}</td>
                                <td><strong class="text-uppercase">{{$xpostulante->cliente->apellido}}</strong>, <span class="text-capitalize">{{Str::lower($xpostulante->cliente->nombre)}}</span></td>
                                <td>{{ $xpostulante->carrera->nombreCarrera }}</td>
                                <td>{{ $xpostulante->modalidad }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">
                <i class="fas fa-power-off"></i> Cerrar
            </button>
        </div>
      </div>
    </div>
  </div>