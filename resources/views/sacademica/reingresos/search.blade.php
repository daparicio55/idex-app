<div class="card">
    <div class="card-header bg-info">
        <h5 class="h5"><i class="fas fa-search"></i> Buscar</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12">
                <input type="text" class="form-control" placeholder="ingrese un texto para buscar">
            </div>
            <div class="col-sm-12 col-md-9 mt-2">
                <select name="programa" id="programa" class="form-control selectpicker" data-live-search="true">
                    <option value="0" disabled selected>Programa de estudios</option>
                    @foreach ($programas as $programa)
                        <option value="{{ $programa->idCarrera }}">{{ $programa->nombreCarrera }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-3 mt-2">
                <select name="periodo" id="periodo" class="form-control selectpicker" data-live-search="true" data-size="5">
                    <option value="0" disabled selected>Periodo</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">{{ $periodo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-info">
            <i class="fas fa-share-square"></i> Enviar
        </button>
    </div>
</div>