{!! Form::open(['route'=>'sacademica.estudiantes.index','method'=>'GET','role'=>'search']) !!}
<div class="row">
    <div class="col-sm-12">
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
    </div>
</div>
{!! Form::close() !!}