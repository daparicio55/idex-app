<div class="modal fade" aria-hidden="true" role="dialog" tabindex="-1" id="modal-unidades">
    <div class="modal-dialog modal-dialog-centered modal-xl">
		<div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-exclamation-triangle text-danger"></i> Eliga las Unidades Didacticas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
			<div class="modal-body">
				<table id="tb_unidades" class="table table-striped table-bordered table-condensed table-hover">
                    <thead style="background-color:#A9D0F5">
                        <th>id</th>
                        <th>C</th>
                        <th>Módulo</th>
                        <th>Tipo</th>
                        <th>Unidad Didáctiva</th>
                        <th>Cre.</th>
                    </thead>
                    <tbody id="modal-unidades-body">
                        {{-- @foreach($unidades as $uni)
                        <tr id="fila{{$uni->id}}">
                            <td>{{$uni->id}}</td>
                            <td style="text-align: center">{{$uni->ciclo}}</td>
                            <td>{{$uni->modulo->nombre}}</td>
                            <td>{{ $uni->tipo }}</td>
                            <td>{{$uni->nombre}}</td>
                            <td>{{$uni->creditos}}</td>
                            <td><button class="btn btn-primary" type="button" onclick="modalAgregar({{$uni->id}})">+</button></td>
                        </tr>
                        @endforeach --}}
                    </tbody>
                    <tfoot>
                          
                  </tfoot>
              </table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				{{-- <button type="submit" class="btn btn-primary" data-dismiss="modal" id="UniEnviar">Confirmar</button> --}}
			</div>
		</div>
	</div>
</div>


