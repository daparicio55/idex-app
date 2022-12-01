{!! Form::open(array('url'=>'ventas/ventas/create','method'=>'GET','autocomplete'=>'off','role'=>'search')) !!}
<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
    <div class='form-group'>
        <label>DNI</label>
        <input type="text" class="form-control" name="dni" required placeholder="Buscar..." value="{{$dni}}">
    </div>
</div>
<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <div class='form-group'>
        <button type="submit" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Buscar</button>
    </div>
</div>
{{Form::close()}}