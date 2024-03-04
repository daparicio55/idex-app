{!! Form::open(['route'=>'admisiones.postulantes.index','method'=>'GET','autocomplete'=>'off','role'=>'search']) !!}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Ingrese texto a buscar correo o nombres..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-search-plus"></i> Buscar
            </button>
            <a href="{{route('admisiones.postulantes.index')}}" class="btn btn-danger">
                <i class="fas fa-recycle"></i> Limpiar
            </a>
        </span>
    </div>
    <div class="row mt-2">
        <div class="col-sm-12 col-md-6">
            
            <select name="carrera" class="form-control">
                <option value="0">Programa de Estudios</option>
                @foreach ($programas as $programa)
                    <option value="{{ $programa->idCarrera }}" @isset($_GET['carrera']) @if($_GET['carrera'] == $programa->idCarrera) selected @endif @endisset>{{ $programa->nombreCarrera }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-3">
            @isset($_GET['modalidadTipo']) @endisset
            <select name="modalidadTipo" class="form-control">
                <option value="0">Tipo Modalidad</option>
                @foreach ($modalidadTipo as $mt)
                    <option value="{{ $mt }}" @isset($_GET['modalidadTipo']) @if($_GET['modalidadTipo'] == $mt) selected @endif @endisset>{{ $mt }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-12 col-md-3">
            <select name="periodo" class="form-control">
                <option value="0">Periodo</option>
                @foreach ($periodos as $periodo)
                    <option value="{{ $periodo->id }}" @isset($_GET['periodo']) @if($_GET['periodo'] == $periodo->id) selected @endif @endisset>{{ $periodo->nombre }}</option>
                @endforeach
            </select>
        </div>
    </div>
</div>
{!! Form::close() !!}