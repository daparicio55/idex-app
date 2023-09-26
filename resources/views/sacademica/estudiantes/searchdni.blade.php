{!! Form::open(['route'=>'sacademica.estudiantes.create','method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Ingrese DNI a buscar ..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
        </span>

    </div>
</div>
{!! Form::close() !!}