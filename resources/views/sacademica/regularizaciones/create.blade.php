@extends('adminlte::page')

@section('title', 'Convalidacion Registro')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Nuevo Registro de Regularizacion o Extraordinario</h1>
@stop
@section('content')
{{-- buscamos por numero de dni --}}
<div class='form-group'>
    @include('sacademica.regularizaciones.search')
    @include('sacademica.regularizaciones.modalchoise')
</div>
{!! Form::open(['id'=>'frm','method'=>'post','route'=>'sacademica.regularizaciones.store','autocomplete'=>'off']) !!}
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
                    <input type="text" name="apellido" id="apellido" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('nombre', 'Nombres', [null]) !!}
                    <input type="text" name="nombre" id="nombre" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono', 'Telefono Llamadas', [null]) !!}
                    <input type="text" name="telefono" id="telefono" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono2', 'Telefono WhatsApp', [null]) !!}
                    <input type="text" name="telefono2" id="telefono2" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('fechaNacimiento', 'F. Nacimiento', [null]) !!}
                    <input type="text" disabled name="fechaNacimiento" id="fechaNacimiento" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('sexo', 'Sexo', [null]) !!}
                    <input type="text" name="sexo" id="sexo" disabled  class="form-control" required>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    {!! Form::label('email', 'Correo', [null]) !!}
                    <input type="text" name="email" id="email" class="form-control" required>
                </div>
            </div>
            <div class="row">
                
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    {!! Form::label('direccion', 'Dirección', [null]) !!}
                    <input type="text" name="direccion" id="direccion" class="form-control" required>                    
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
                    <input type="text" disabled name="carrera_id" id="carrera_id" class="form-control" required>                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('admisione_id','A. Ingreso' , [null]) !!}
                    <input type="text" disabled name="admisione_id"  id="admisione_id" class="form-control" required>                    
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
            {{-- <div class="row">
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
            </div> --}}
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead style="background-color:#A9D0F5">
                            <th></th>
                            <th></th>
                            <th style="width: 5%">Ciclo</th>
                            <th style="width: 10%">Tipo</th>
                            <th>Unidad Didáctiva</th>
                            <th style="width: 5%">Creditos</th>
                            <th style="width: 15%">Nota</th>
                        </thead>
                        <tbody id="detalles">
                            
                        </tbody>
                        <tfoot>
                                
                        </tfoot>
                    </table>
                </div> 
            </div>



        </div>
    </div>
</div>
<br>
{{-- lista de unidades --}}




<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
{!! Form::close() !!}
@if (isset($unidades))
    @include('sacademica.regularizaciones.modal')    
@endif
        <a class="btn btn-danger" href="{{route('sacademica.regularizaciones.index')}}">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>
@stop
@section('js')
    <script>
        var url = "{{ asset('') }}";
        function searchdni(){
            let dni = document.getElementById('txt-search');
            if (dni.value == ""){
                alert('debes ingresar un numero de DNI');
            }else{
                let ruta = url+"estudiantepestudio/dni/"+dni.value;
                fetch(ruta)
                .then(response =>{
                    if (!response.ok){
                        throw new Error('Error en la solicitud');
                    }
                    return response.json();
                })
                .then(data => {
                    let tabla = document.getElementById('modal-choise-table');
                    while (tabla.firstChild) {
                        tabla.removeChild(tabla.firstChild);
                    }
                    data.forEach(dato => {
                        //creamos la fila
                        let fila = document.createElement('tr');
                        let c_dni = document.createElement('td');
                        c_dni.innerHTML = dato.dniRuc;
                        let c_nombres = document.createElement('td');
                        c_nombres.innerHTML = dato.Apellido +', '+dato.Nombre;
                        let c_programa = document.createElement('td');
                        c_programa.innerHTML = dato.programa;
                        //vamos a programar el boton de agregar
                        let c_buttons = document.createElement('td');
                        let btnchoise = document.createElement('button');
                        btnchoise.setAttribute('type','button');
                        btnchoise.classList.add('btn','btn-info');
                        btnchoise.innerHTML = "+";
                        btnchoise.setAttribute('onclick','choiseestudiante('+dato.estudiante_id +')');
                        c_buttons.appendChild(btnchoise);
                        fila.appendChild(c_dni);
                        fila.appendChild(c_nombres);
                        fila.appendChild(c_programa);
                        fila.appendChild(c_buttons);
                        //agregamos la fila
                        tabla.appendChild(fila);
                        //console.log(data);
                        $('#modal-choise').modal('show');
                    });
                })
                .catch(error => {
                    console.log ('Error en el api', Error);
                });
            }            
        }
        function btnaddclick(id){
            let txt = document.getElementById('txtadd'+id);
            let nota = document.getElementById('txtnota'+id);
            if(txt.value == "SI"){
                txt.value = "NO";
                nota.setAttribute('readonly',true);
                nota.value = 0;
            }else{
                txt.value = "SI";
                nota.removeAttribute('readonly');
            }
        }
        function choiseestudiante(id){
            $('#modal-choise').modal('hide');
            let ruta = url+"estudiantepestudio/datos/"+id;
            fetch(ruta)
            .then(response => {
                if(!response.ok){
                    throw new Error('Error en la consulta de Estudiantes');
                }
                return response.json();
            })
            .then(estudiantes => {
                //console.log(estudiantes);
                estudiantes.forEach(estudiante => {
                    document.getElementById('apellido').value= estudiante.Apellido;
                    document.getElementById('nombre').value= estudiante.Nombre;
                    document.getElementById('telefono').value= estudiante.telefono;
                    document.getElementById('telefono2').value= estudiante.telefono2;
                    document.getElementById('fechaNacimiento').value= estudiante.fechaNacimiento;
                    document.getElementById('sexo').value= estudiante.sexo;
                    document.getElementById('direccion').value= estudiante.direccion;
                    document.getElementById('email').value= estudiante.email;
                    document.getElementById('carrera_id').value = estudiante.nombreCarrera;
                    document.getElementById('admisione_id').value = estudiante.ingreso;
                    document.getElementById('estudiante_id').value = id;
                });
            })
            .catch(error =>{
                console.log("Error en la api", Error);
            });
            //ahora tenemos que sacar las unidades didacticas
            //hacemos otro fetch();
            let route = url+'estudiantepestudio/unidadesfaltantes/'+id;
            fetch(route)
            .then(response => {
                if(!response.ok){
                    throw new Error('tenemos erroe en la cosulta de unidades');
                }
                return response.json();
            })
            .then(unidades =>{
                let detalles_table = document.getElementById('detalles');
                unidades.forEach(unidad =>{
                    let fila = document.createElement('tr');
                    let c_btnadd = document.createElement('td');
                    c_btnadd.classList.add('text-center');
                    let btnadd = document.createElement('button');
                    btnadd.innerHTML = "+";
                    btnadd.classList.add('btn','btn-info');
                    btnadd.type="button";
                    btnadd.setAttribute('onclick','btnaddclick('+unidad.id+')');
                    c_btnadd.appendChild(btnadd);
                    let c_txtadd = document.createElement('td');
                    c_txtadd.style.width = "80px";
                    let txtadd = document.createElement('input');
                    txtadd.classList.add('form-control');
                    txtadd.name = "estado[]";
                    txtadd.value = "NO";
                    txtadd.setAttribute('readonly',true);
                    txtadd.id = "txtadd"+unidad.id;
                    c_txtadd.appendChild(txtadd);
                    let c_ciclo = document.createElement('td');
                    c_ciclo.classList.add('text-center');
                    c_ciclo.innerHTML = unidad.ciclo;
                    let c_tipo = document.createElement('td');
                    c_tipo.innerHTML = unidad.tipo;
                    let c_unidad = document.createElement('td');
                    c_unidad.innerHTML = unidad.nombre;
                    let c_creditos = document.createElement('td');
                    c_creditos.innerHTML = unidad.creditos;
                    let c_nota = document.createElement('td');
                    let txtnota = document.createElement('input');
                    txtnota.classList.add('form-control');
                    txtnota.type = "number";
                    txtnota.max = 20;
                    txtnota.min = 0;
                    txtnota.step = 1;
                    txtnota.name="notas[]";
                    txtnota.value = 0;
                    txtnota.id = "txtnota"+unidad.id;
                    txtnota.setAttribute('readonly',true);
                    let txtunidade = document.createElement('input');
                    txtunidade.value = unidad.id;
                    txtunidade.name = "unidades[]";
                    txtunidade.type = "hidden";
                    c_nota.appendChild(txtnota);
                    c_nota.appendChild(txtunidade);
                    fila.appendChild(c_btnadd);
                    fila.appendChild(c_txtadd);
                    fila.appendChild(c_ciclo);
                    fila.appendChild(c_tipo);
                    fila.appendChild(c_unidad);
                    fila.appendChild(c_creditos);
                    fila.appendChild(c_nota);
                    console.log(unidad);
                    detalles_table.appendChild(fila);
                });
                
            })
            .catch(error => {
                console.log('Error en la consulta', Error);
            })
            console.log(id);
        }
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    </script>
@stop