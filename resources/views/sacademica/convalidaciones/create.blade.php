@extends('adminlte::page')

@section('title', 'Convalidacion Registro')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Nuevo Registro de Convalidacion</h1>
@stop
@section('content')
{{-- buscamos por numero de dni --}}
{{-- {!! Form::open(['method'=>'get','role'=>'search','route'=>'sacademica.convalidaciones.create']) !!} --}}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" id="dni-search" name="searchText" placeholder="Ingrese DNI a buscar ..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button id="btn-search" class="btn btn-primary">
                <i class="fas fa-binoculars"></i> Buscar
            </button>
        </span>
    </div>
    @include('sacademica.convalidaciones.modalchoise')
</div>
{{-- {!! Form::close() !!} --}}

{!! Form::open(['id'=>'frm','method'=>'post','route'=>'sacademica.convalidaciones.store','autocomplete'=>'off']) !!}
<input type="hidden" name="estudiante_id" id="estudiante_id">
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos Personales.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('apellido', 'Apellidos', [null]) !!}
                    <input type="text" name="apellido" id="apellido" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->apellido}}@endif" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('nombre', 'Nombres', [null]) !!}
                    <input type="text" name="nombre" id="nombre" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->nombre}}@endif" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono', 'Telefono Llamadas', [null]) !!}
                    <input type="text" name="telefono" id="telefono" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->telefono}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono2', 'Telefono WhatsApp', [null]) !!}
                    <input type="text" name="telefono2" id="telefono2" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->telefono2}}@endif" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('fechaNacimiento', 'F. Nacimiento', [null]) !!}
                    <input type="text" disabled name="fechaNacimiento" id="fechaNacimiento" value="@if(isset($estudiante)){{date('d-m-Y',strtotime($estudiante->postulante->fechaNacimiento))}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('sexo', 'Sexo', [null]) !!}
                    <input type="text" name="sexo" id="sexo" disabled value="@if(isset($estudiante)){{$estudiante->postulante->sexo}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('discapacidad', 'Discapacidad', [null]) !!}
                    <input type="text" name="discapacidad" id="discapacidad" disabled value="@if(isset($estudiante))@if($estudiante->postulante->discapacidad == 0){{'SI'}}@else{{'NO'}}@endif  @endif" class="form-control" required>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    {!! Form::label('discapacidadNombre', '¿Que discapacidad tiene?', [null]) !!}
                    <input type="text" name="discapacidadNombre" id="discapacidadNombre" disabled value="@if(isset($estudiante)){{$estudiante->postulante->discapacidadNombre}}@endif" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('email', 'Correo', [null]) !!}
                    <input type="text" name="email" id="email" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->email}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    {!! Form::label('direccion', 'Dirección', [null]) !!}
                    <input type="text" name="direccion" id="direccion" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->direccion}}@endif" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos de el programa de estudios --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-user-graduate"></i> Datos de Programa de Estudios.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    {!! Form::label('carrera_id','Nombre' , [null]) !!}
                    <input type="text" disabled name="carrera_id" id="carrera_id" value="@if(isset($estudiante)){{$estudiante->postulante->carrera->nombreCarrera}}@endif" class="form-control" required>                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('admisione_id','A. Ingreso' , [null]) !!}
                    <input type="text" disabled name="admisione_id" id="admisione_id" value="@if(isset($estudiante)){{$estudiante->postulante->admisione->periodo}}@endif" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos de la fecha del periodo academico --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="far fa-calendar-alt"></i> Periodo Académico.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('pmatricula_id', 'Periodo', [null]) !!}
                    {!! Form::select('pmatricula_id', $periodos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('tipo', 'Tipo', [null]) !!}
                    {!! Form::select('tipo', $tipo, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('fecha', 'Fecha', [null]) !!}
                    {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    {!! Form::label('resolucion', 'Resolucion', [null]) !!}
                    {!! Form::text('resolucion', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-book-reader"></i> Unidades Didacticas.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    {!! Form::label(null, 'Ciclo', [null]) !!}
                    {!! Form::select('ciclo', ciclos(), null, ['id'=>'ciclo','class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label(null, 'Tipo', [null]) !!}
                    {!! Form::select('tipoMatricula', $tipo, null, ['id'=>'tipoMatricula','class'=>'form-control']) !!}
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    {!! Form::label('creditos', 'Creditos', [null]) !!}
                    {!! Form::text('creditos', 0, ['class'=>'form-control','id'=>'creditos','disabled']) !!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a href="" data-target="#modal-unidades" data-toggle="modal">
                        <button class="btn btn-success" id="btn_unidades">Unidades Didacticas</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
{{-- lista de unidades --}}

<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color:#A9D0F5">
                <th style="width: 5%">Ciclo</th>
                <th style="width: 10%">Tipo</th>
                <th>Unidad Didáctiva</th>
                <th style="width: 5%">Creditos</th>
                <th style="width: 10%">Nota</th>
                <th style="width: 1%">ID</th>
            </thead>
            <tbody>
                
            </tbody>
            <tfoot>
                    
            </tfoot>
        </table>
    </div> 
</div>


<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
{!! Form::close() !!}
@include('sacademica.convalidaciones.modal')    
        <a class="btn btn-danger" href="{{route('sacademica.matriculas.index')}}">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>
@stop
@section('js')
    <script>
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    $('#btn_unidades').click(function(){
        modalUnidades();
    });
    function modalAgregar(index){
        console.log('click');
        //vamos a recuperar los valores de la fila que se le dio click
        id = $("#fila"+index).find("td:eq(0)").html();
        ciclo = $("#fila"+index).find("td:eq(1)").html();
        modulo = $("#fila"+index).find("td:eq(2)").html();
        tipo = $("#fila"+index).find("td:eq(3)").html();
        unidad = $("#fila"+index).find("td:eq(4)").html();
        creditos = $("#fila"+index).find("td:eq(5)").html();
        tcreditos = $("#creditos").val();
        tmatricula = $("#tipoMatricula").val();
        if((Number(tcreditos) + Number(creditos))>100){
            alert('no se pueden exceder los 100 creditos');
        }else{
            //sumamos los creditos
            tcreditos = Number(tcreditos) + Number(creditos);
            $("#creditos").val(tcreditos);
            var fila='<tr class="selected" id="filaa'+id+'"><td><input type="hidden" name="idUniDidactica[]" value="'+id+'">'+ciclo+'</td><td>'+tipo+'</td><td>'+unidad+'</td><td>'+creditos+'</td><td>'+'<input name="notas[]" type="number" class="form-control">'+'</td><td>'+id+'</td><td><button type="button" class="btn btn-warning" onClick="eliminar('+id+')">X</button></td></tr>';
            //ocultar la fila actual.
            $("#fila"+index).each(function(){
                $(this).find("td").hide();
            });
            //agregar la fila.
            $('#detalles').append(fila);
        }
    }
    function modalUnidades(){
        //primero tengo q poner visibles todas
        $('#tb_unidades').find("tbody tr").each(function(){
            $(this).find("td").show();
        });
        //ocultamos los que son de diferente ciclo
        $('#tb_unidades').find("tbody tr").each(function(){
            ci = $(this).find("td:eq(1)").html();
            id = $(this).find("td:eq(0)").html();
            existe = 0;
            if (ci != $('#ciclo').val()){
                $(this).find("td").hide();
            }
        });
        //oculatamos los que ta estan en la lista
        $('#tb_unidades').find("tbody tr").each(function(){
            existe = 0;
            id = $(this).find("td:eq(0)").html();
            $('#detalles').find("tbody tr").each(function(){
                idd = $(this).find("td:eq(5)").html();
                if(id==idd){
                    existe = 1;
                }
            });
            if(existe == 1){
                $(this).find("td").hide();
            }
        });
    }
    function eliminar(index)
        {
            cre = $("#filaa"+index).find("td:eq(3)").html();
            creditos = $("#creditos").val();
            creditos = Number(creditos) - Number(cre);
            $("#creditos").val(creditos);
            $("#filaa"+index).remove();
        }
    //modal de busqueda
    document.getElementById('btn-search').addEventListener('click',function(){
        let dni = document.getElementById('dni-search').value;
        let table = document.getElementById('modal-table-body');
        let asset = '{{ asset('') }}';
        //borramos los datos de la tabla
        let filas = document.getElementById('modal-table-body');    
        while (filas.firstChild) {
            filas.removeChild(filas.firstChild);
        }
        //creamos la URL
        let url = asset+"estudiantepestudio/dni/"+dni;
        //usamos la api fetch para consultar la informacion;
        fetch(url).then((response)=>response.json()).then((programas)=>{
            programas.forEach(programa => {
                //creamos la fila
                let row = document.createElement('tr');
                //creamos los td
                let td_dni = document.createElement('td');
                let td_nombres = document.createElement('td');
                let td_programa = document.createElement('td');
                let td_opcion = document.createElement('td');
                //creamos el boton
                let btn_choise = document.createElement('button');
                btn_choise.classList.add('btn');
                btn_choise.classList.add('btn-primary');
                btn_choise.innerHTML="+";
                btn_choise.setAttribute('onclick','choise('+ programa.estudiante_id +')')
                //agregamos el boton
                td_opcion.appendChild(btn_choise);
                td_dni.innerHTML = programa.dniRuc;
                td_nombres.innerHTML = programa.Apellido + ", " + programa.Nombre;
                td_programa.innerHTML = programa.programa;
                
                row.appendChild(td_dni);
                row.appendChild(td_nombres);
                row.appendChild(td_programa);
                row.appendChild(td_opcion);
                document.getElementById('modal-table-body').appendChild(row);
            });
        });
        $('#modal-carrera').modal('show');
    });
    function choise(id){
        $('#modal-carrera').modal('hide');
        //ahora tenemos que traer los datos del estudiante
        let asset = '{{ asset('') }}';
        let url = asset+"estudiantepestudio/datos/"+id;
        fetch(url).then((response)=>response.json()).then((estudiantes)=>{
            estudiantes.forEach(estudiante =>{
                document.getElementById('apellido').value= estudiante.Apellido;
                document.getElementById('nombre').value= estudiante.Nombre;
                document.getElementById('telefono').value= estudiante.telefono;
                document.getElementById('telefono2').value= estudiante.telefono2;
                document.getElementById('fechaNacimiento').value= estudiante.fechaNacimiento;
                document.getElementById('sexo').value= estudiante.sexo;
                document.getElementById('direccion').value= estudiante.direccion;
                document.getElementById('email').value= estudiante.email;
                document.getElementById('carrera_id').value= estudiante.nombreCarrera;
                document.getElementById('admisione_id').value= estudiante.ingreso;
                document.getElementById('estudiante_id').value = id;

            });
        });

        //llenamos el modal primero
        let table = document.getElementById('modal-unidades-body');        
        url = asset+"estudiantepestudio/unidades/"+id;
        console.log(url);
        fetch(url).then((response)=>response.json()).then((unidades)=>{
            unidades.forEach(unidade=>{
                //ahora llenamos el modal
                //creamos el tr
                let row = document.createElement('tr');
                row.setAttribute('id','fila'+unidade.id);
                let td_id = document.createElement('td');
                let td_ciclo = document.createElement('td');
                let td_modulo = document.createElement('td');
                let td_tipo = document.createElement('td');
                let td_nombre = document.createElement('td');
                let td_creditos = document.createElement('td');
                let td_opciones = document.createElement('td');
                //creamos el boton de las opciones
                let btn_add = document.createElement('button');
                btn_add.classList.add('btn');
                btn_add.classList.add('btn-primary');
                btn_add.setAttribute('onclick','modalAgregar('+ unidade.id +')');
                btn_add.setAttribute('type','button');
                btn_add.innerHTML = "+";
                //agrego el boton al td
                td_opciones.appendChild(btn_add);
                //agreamos el texto a los TD
                td_id.innerHTML = unidade.id;
                td_ciclo.innerHTML = unidade.ciclo;
                td_modulo.innerHTML = "MODULO";
                td_tipo.innerHTML = unidade.tipo;
                td_nombre.innerHTML = unidade.nombre;
                td_creditos.innerHTML = unidade.creditos;
                //lo agreamos a la fila;
                row.appendChild(td_id);
                row.appendChild(td_ciclo);
                row.appendChild(td_modulo);
                row.appendChild(td_tipo);
                row.appendChild(td_nombre);
                row.appendChild(td_creditos);
                row.appendChild(td_opciones);
                table.appendChild(row);
                //console.log(unidade);
            });
        });
        
    }
    </script>

    
@stop