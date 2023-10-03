{!! Form::open(['route'=>'sacademica.regularizaciones.index','method'=>'get','role'=>'seach']) !!}
<div class="row">
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <input @isset($search) value="{{ $search }}" @endisset type="text" class="form-control" name="search" placeholder="ingrese nombre o DNI para buscar" aria-label="Recipient's username" aria-describedby="button-addon2">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" type="button" id="button-addon2">
                    <i class="fa fa-search" aria-hidden="true"></i> Buscar
                </button>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}