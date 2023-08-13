@extends('adminlte::page')
@section('title', 'Experiencias laborales')
@section('content_header')
<h1>
    <i class="fas fa-book"></i> Asignacion de Unidades Didacticas
    <a href="{{ route('sacademica.uasignadas.index') }}" class="btn btn-danger">
        <i class="fas fa-window-close"></i> Salir
    </a>
</h1>
@stop
@section('content')
{!! Form::open(['route'=>'sacademica.uasignadas.store','method'=>'POST','id'=>'frm']) !!}
<div class="card">
    <div class="card-body">
        <h4 class="card-title"><i class="fas fa-user-tie"></i> Docente Formador</h4>
        <p class="card-text">seleccione el docente y el periodo formativo para asignar las unidades didacticas </p>
        <div class="row">
            <div class="col-sm-12 col-md-10">
                {!! Form::label('user_id', 'Docente', [null]) !!}
                <select name="user_id" id="user_id" class="form-control selectpicker" data-live-search="true" data-size=10>
                    <option value="0">Seleccione un usuario</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} - {{ $user->email }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('pmatricula_id','Periodo', [null]) !!}
                <select name="pmatricula_id" id="pmatricula_id" class="form-control selectpicker" data-live-search="true" data-size=10>
                    <option value="0">Seleccione</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}">
                            {{ $periodo->nombre  }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
</div>
<div id="unidades" style="display: none">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <i class="fas fa-list"></i> Seleccion de Unidades Didácticas
            </h4>
            <p class="card-text"></p>
            <div class="row">
                <div class="col-sm-12">
                    <div class="input-group mb-3">
                        {{-- <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="button-addon2"> --}}
                        <select name="udidactica_id" id="udidactica_id" class="form-control selectpicker" data-live-search="true" data-size=10>
                            {{-- <option value="0">Seleccione</option> --}}
                            @foreach ($unidades as $unidad)
                                <option value="{{ $unidad->id }}">
                                    {{ $unidad->nombre  }} - {{ $unidad->modulo->carrera->nombreCarrera }} - {{ $unidad->ciclo }} - {{ $unidad->horas }} - {{ $unidad->creditos }}
                                </option>
                            @endforeach
                        </select>
                        <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="button" id="btn_agregar">
                            <i class="fas fa-plus-square"></i> Agregar
                        </button>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <table class="table">
                        <thead>
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Unidad Didáctica</th>
                            <th scope="col">Hor.</th>
                            <th scope="col">Cre.</th>
                          </tr>
                        </thead>
                        <tbody id="tb_cuerpo">
                        </tbody>
                      </table>
                </div>
            </div>
            <div class="card-footer" id="footer">
                <button type="submit" id="btn_guardar" class="btn btn-primary">
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
    const user = document.getElementById('user_id');
    const periodo = document.getElementById('pmatricula_id');
    const agregar = document.getElementById('btn_agregar');
    function eliminar(id){
        let row = document.getElementById(id);
        row.remove();
    }
    function unidades(){
        //verificar si los 2 son diferentes de 0;
        const unidades = document.getElementById('unidades');
        if (user.value != 0 && periodo.value != 0){
            unidades.style.display = "block";
        }else{
            unidades.style.display = "none";
        }
    }
    agregar.addEventListener('click',function(){
        const ls_unidades = document.getElementById('udidactica_id');
        let datos = ls_unidades.options[ls_unidades.selectedIndex].innerHTML.split("-");
        let id = ls_unidades.value;
        let existe = document.getElementById(id);
        if (existe){
            console.log("existe");
            alert("esta unidad didactica ya se agrego");
        }else{
            const tb_cuerpo = document.getElementById('tb_cuerpo');
            let row = document.createElement("tr");
            row.id = id;
            let td_orden = document.createElement("td");
            let txt = document.createElement("input");
            txt.name = "udidactica[]";
            txt.value = id;
            txt.hidden = true;
            td_orden.innerHTML="*";
            td_orden.appendChild(txt);
            let td_unidad = document.createElement("td");
            td_unidad.innerHTML=datos[0].trim() + " - "+datos[1];
            let td_hora = document.createElement("td");
            td_hora.innerHTML=datos[3].trim();
            let td_credito = document.createElement("td");
            td_credito.innerHTML=datos[4].trim();
            let td_button = document.createElement("td");
            let a = document.createElement("a");
            a.setAttribute("onClick","eliminar("+id+")");
            a.classList.add("btn","btn-danger");
            let i = document.createElement("i");
            i.classList.add("fas","fa-trash-alt");
            a.appendChild(i);
            td_button.appendChild(a);
            row.appendChild(td_orden);
            row.appendChild(td_unidad);
            row.appendChild(td_hora);
            row.appendChild(td_credito);
            row.appendChild(td_button);
            tb_cuerpo.appendChild(row);
        }
    });
    user.addEventListener('change',function(){
        unidades();
    });
    periodo.addEventListener('change',function(){
        unidades();
    });
    let form = document.getElementById("frm");
        form.addEventListener("submit", function(event){
            let tb_cuerpo = document.getElementById("tb_cuerpo");
            let cantidad = tb_cuerpo.children.length;
            if (user.value == 0 || periodo.value == 0 ){
                event.preventDefault();
                alert('Seleccione un Docente y un Periodo de Estudio');
            }
            if(cantidad == 0){
                event.preventDefault();
                alert('debe agregar almenos una unidad didactica');
            }
    });
</script>
@stop