{!! Form::open(['route'=>'sacademica.practicas.index','role'=>'search','method'=>'get']) !!}
<div class="row">
    <div class="col-sm-12">
        <div class='form-group'>
            <div class="input-group">
                <input type="text" class="form-control" @isset($_GET["searchdni"]) value="{{ $_GET["searchdni"] }}" @endisset name="searchdni" placeholder="Ingrese dni, apellidos o nombres ...">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-search-plus"></i> Buscar
                    </button>
                    <a href="{{ route('sacademica.practicas.index') }}" class="btn btn-danger">
                        <i class="fas fa-broom"></i> Limpiar
                    </a>
                </span>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
