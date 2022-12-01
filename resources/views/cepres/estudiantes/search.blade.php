{!! Form::open(['route'=>'cepres.estudiantes.index','method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Ingrese texto a buscar correo o nombres..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
{!! Form::close() !!}
            <a href="{{route('cepres.estudiantes.index')}}" class="btn btn-danger">
                <i class="fas fa-recycle"></i> Limpiar
            </a>
        </span>
    </div>
</div>