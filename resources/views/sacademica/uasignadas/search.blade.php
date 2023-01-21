{!! Form::open(['route'=>'sacademica.uasignadas.index','method'=>'get','role'=>'search','id'=>'frm']) !!}
<div class="row">
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <input type="text" class="form-control" id="searchText" @isset($text) value="{{ $text }}" @endisset name="searchText" placeholder="ingrese un criterio para realizar una busqueda" aria-label="ingrese un criterio para realizar una busqueda" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" id="button-addon2">
                    <i class="fas fa-search"></i> Buscar
                </button>
            </div>
            <div class="input-group-append">
                <a href="{{ route('sacademica.uasignadas.index') }}" class="btn btn-outline-success" type="submit" id="button-addon3">
                    <i class="fas fa-broom"></i> Limpiar
                </a>
            </div>
          </div>
    </div>
</div>
{!! Form::close() !!}