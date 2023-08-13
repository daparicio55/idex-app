@extends('adminlte::page')
@section('title', 'Horario')
@section('content_header')
<a href="{{ route('sacademica.uasignadas.index') }}" class="btn btn-danger mb-2">
    <i class="fas fa-window-close"></i> Salir
</a>
<h1>
    <i class="fas fa-book"></i> Crear Horarios de Clases
</h1>
<h5 class="mt-2">{{ $uasignada->unidad->nombre }} - {{ $uasignada->unidad->modulo->carrera->nombreCarrera }} {{ $uasignada->unidad->ciclo }} Ciclo</h5>
<h5 class="mt-2">{{ $uasignada->user->name }}</h5>
@stop
@section('content')
{!! Form::open(['route'=>['sacademica.uasignadas.horarios.update',$uasignada->id],'method'=>'PUT']) !!}
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header bg-info">
                <h5 class="mt-2">Horario Clases</h5>
                <a id="btn_add" class="btn btn-primary" title="agregar un nuevo horario">
                    <i class="fas fa-calendar-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <td>Día</td>
                                <td>Hora Inicio</td>
                                <td>Hora Fin</td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody id="table_horarios">
                            @foreach ($uasignada->horarios as $horario)
                                <tr id="fila{{ $uasignada->id }}">
                                    <td>
                                        <select name="dias[]" class="form-control">
                                            @foreach ($days as $day)
                                                <option value="{{ $day }}" @if($day == $horario->day) selected @endif>
                                                    {{ $day }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="time" name="finicio[]" value="{{ $horario->hinicio }}" class="form-control">
                                    </td>
                                    <td>
                                        <input type="time" name="ffin[]" value="{{ $horario->hfin }}" class="form-control">
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" onClick="row_delete({{ $uasignada->id }})">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Guardar
                </button> 
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@stop
@section('js')
<script>
    var dias = ['Lunes','Martes','Miercoles','Jueves','Viernes'];
    var contador = 1;
    //cuando se da click en add
    //crear lista
    function lista(){
        let lista = document.createElement('select');
        lista.classList.add('form-control')
        lista.setAttribute('name','dias[]');
        dias.forEach(dia => {
            let opt = document.createElement('option')
            opt.innerHTML = dia;
            opt.setAttribute('value',dia);
            lista.appendChild(opt);
        });
        return lista;
    }
    function row_delete(id){
        // Obtén una referencia al tr mediante su ID
        const row = document.getElementById("fila"+id);
        // Verifica si se encontró el tr
        if (row) {
            // Obtén una referencia a la tabla que contiene el tr
            const tabla = row.parentNode;

            // Elimina el tr de la tabla
            tabla.removeChild(row);
        }
        console.log(id);
    }
    document.getElementById('btn_add').addEventListener('click',function(){
        //creamos un fila
        let row = document.createElement('tr');
        row.setAttribute('id','fila'+contador);
        //creamos las columnoas
        let coldia = document.createElement('td');
        let colinicio = document.createElement('td');
        let colfin = document.createElement('td');
        let colbtn = document.createElement('td');
        coldia.appendChild(lista());
        //creamos los texto para las columnas.
        let txt_inicio = document.createElement('input');
        txt_inicio.classList.add('form-control');
        txt_inicio.setAttribute('required',true);
        txt_inicio.setAttribute('type','time');
        txt_inicio.setAttribute('name','finicio[]');
        colinicio.appendChild(txt_inicio);

        let txt_fin = document.createElement('input');
        txt_fin.classList.add('form-control');
        txt_fin.setAttribute('required',true);
        txt_fin.setAttribute('type','time');
        txt_fin.setAttribute('name','ffin[]');
        colfin.appendChild(txt_fin);
        //creamos el boton de eliminar;
        let btndelete = document.createElement('button');
        btndelete.classList.add('btn');
        btndelete.classList.add('btn-danger');
        btndelete.innerHTML="Eliminar";
        btndelete.setAttribute("onClick","row_delete("+contador+")");

        colbtn.appendChild(btndelete);

        row.appendChild(coldia);
        row.appendChild(colinicio);
        row.appendChild(colfin);
        row.appendChild(colbtn);
        
        document.getElementById('table_horarios').appendChild(row);
        contador ++;
    });
</script>
@stop