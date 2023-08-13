@extends('adminlte::page')

@section('title', 'Matricula Registro')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Nuevo Registro de Matrícula</h1>
@stop
@section('content')
@include('sacademica.ematriculas.programa')
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" id="searchText" name="searchText" placeholder="Ingrese DNI a buscar ...">
        <span class="input-group-btn">
            <button type="submit" onclick="buscardni()" class="btn btn-primary">
                <i class="fas fa-binoculars"></i> Buscar
            </button>
        </span>
    </div>
</div>
{!! Form::open(['id'=>'frm','method'=>'post','route'=>'sacademica.matriculas.store','autocomplete'=>'off']) !!}
{{-- de apoyo --}}
<input type="hidden" id="url" value="{{ asset("") }}">
<input type="hidden" name="estudiante_id" id="estudiante_id">
<input type="hidden" name="cretotal" id="cretotal" value=0>
@php
    $estudiante_id = 0;
@endphp
<!-- verificamos si tiene deuda -->
<div class="row" id="deudas" style="display: none">
    <div class="card col-sm-12">
        <div class="card-header bg-danger mt-2">
            <h4><i class="fas fa-credit-card"></i> Pagos Pendientes.</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Fecha</td>
                            <td>Servicio</td>
                            <td>Observacion</td>
                        </tr>
                    </thead>
                    <tbody id="table_deudas">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
{{-- programa de estudios --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-graduation-cap"></i> Programa de Estudios.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    {!! Form::text('programa', null, ['class'=>'form-control','disabled','id'=>'programa']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::text('ingreso', null, ['class'=>'form-control','disabled','id'=>'ingreso']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos del cliente  --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos Personales.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('apellido', 'Apellidos', [null]) !!}
                    <input type="text" id="apellido" name="apellido" class="form-control" disabled>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('nombre', 'Nombres', [null]) !!}
                    <input type="text" id="nombre" name="nombre" class="form-control" disabled>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono', 'Telefono Llamadas', [null]) !!}
                    <input type="text" id="telefono" name="telefono" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono2', 'Telefono WhatsApp', [null]) !!}
                    <input type="text" id="telefono2" name="telefono2" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('fechaNacimiento', 'F. Nacimiento', [null]) !!}
                    <input type="date" id="fechaNacimiento" name="fechaNacimiento" class="form-control" required>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('sexo', 'Sexo', [null]) !!}
                    {!! Form::select('sexo', $sexos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('email', 'Correo', [null]) !!}
                    <input type="text" id="email" name="email" class="form-control" required>
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    {!! Form::label('direccion', 'Dirección', [null]) !!}
                    <input type="text" id="direccion" name="direccion" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos del periodo de matricula --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="far fa-calendar-alt"></i> Periodo de Matricula.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('pmatricula_id', 'Periodo', [null]) !!}
                    {!! Form::select('pmatricula_id', $periodos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('tipo', 'Tipo Matricula', [null]) !!}
                    {!! Form::select('tipo', $tipo, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('fecha', 'Fecha', [null]) !!}
                    {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
{{-- unidades didacticas --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-book"></i> Unidades Didácticas  </h4>
            <label for="" style="font-size: 25px" class="text-primary">Creditos </label><input type="text" style="border: 0ex; width: 70px; font-size: 30px; text-align: right" class="text-primary" id=txtcreditos disabled value=0>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                                <th style="width: 50px"></th>
                                <th style="width: 80px"></th>
                                <th style="text-align: center">Ciclo</th>
                                <th>Tipo</th>
                                <th>Unidad Didáctica</th>
                                <th style="width: 90px">Cre</th>
                                <th style="width: 90px">Nota</th>
                                <th>Horario</th>
                            </thead>
                            <tbody id="unidades">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
{!! Form::close() !!}
        <a class="btn btn-danger" href="{{route('sacademica.matriculas.index')}}">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>

@stop
@section('js')
    <script>
    var URL = $('#url').val();
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    function buscardni(){
        var dni = document.getElementById("searchText").value;
        if (dni.trim() == ""){
            alert('Ingrese un texto para buscar');
        }else{
            document.getElementById('deudas').style.display = "none";
            /* limpiar la tabla */
            $('#cprogramas tr').each(function(){ 
                this.remove();
            });
            var HTMLResponse = document.querySelector("#cprogramas");
            var API_URL = URL+"estudiantepestudio/dni/"+dni;
            fetch(API_URL).then((response)=>response.json()).then((programas)=>{
                programas.forEach(programa=>{
                    var tr = document.createElement('tr');
                    var td1 = document.createElement('td');
                    var td2 = document.createElement('td');
                    var td3 = document.createElement('td');
                    var td4 = document.createElement('td');
                    var td5 = document.createElement('td');
                    var td6 = document.createElement('td');
                    /* vamos asignar los valores */
                    td1.appendChild(document.createTextNode(programa.idCliente));
                    td2.appendChild(document.createTextNode(programa.dniRuc));
                    td3.appendChild(document.createTextNode(programa.Apellido + ', ' + programa.Nombre));
                    td4.appendChild(document.createTextNode(programa.programa));
                    /*botones  */
                    var btn = document.createElement("button");
                    btn.setAttribute('class','btn btn-primary');
                    btn.setAttribute('onclick','eleccion('+programa.estudiante_id+')');
                    btn.appendChild(
                        document.createTextNode('+')
                    );
                    td5.appendChild(btn);
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(td3);
                    tr.appendChild(td4);
                    tr.appendChild(td5);
                    HTMLResponse.appendChild(tr);
                });
            });
            
            $('#modal-pestudios').modal('show');
        }
    }
    function calcularnotas(estudiante,unidad){
        var API_URL2 = URL+"estudiantepestudio/notas?estudiante="+estudiante+"&unidad="+unidad;
        fetch(API_URL2).then((response)=>response.json()).then((notas)=>{
            notas.forEach(nota=>{
                $('#txt'+unidad).val(nota.nota);
                var texto = document.getElementById('txt'+unidad);
                var check = document.getElementById('check'+unidad);
                if (nota.nota<13){
                    texto.setAttribute('style','color: red');
                }else{
                    $('#fila'+unidad).remove();
                }
            });
        });
    }
    function eleccion(id){
        $('#modal-pestudios').modal('hide');
        $('#estudiante_id').val(id);
        /* mostrar los datos */
        var HTMLResponse = document.querySelector("#cprogramas");
        var API_URL = URL+"estudiantepestudio/datos/"+id;
        fetch(API_URL).then((response)=>response.json()).then((datos)=>{
            datos.forEach(dato=>{
                $('#apellido').val(dato.Apellido);
                $('#nombre').val(dato.Nombre);
                $('#telefono').val(dato.telefono);
                $('#telefono2').val(dato.telefono2);
                $('#fechaNacimiento').val(dato.fechaNacimiento);
                $('#sexo').val(dato.sexo);
                $('#email').val(dato.email);
                $('#direccion').val(dato.direccion);
                $('#programa').val(dato.nombreCarrera);
                $('#ingreso').val(dato.ingreso);
                $('#cretotal').val(dato.creditos);
                var carrera_id = dato.idCarrera;
            });
        });
        //para agregar las filas a las deudas
        DEUDA_URL = URL+"ventas/deudas/"+id;
        
        fetch(DEUDA_URL).then((response)=>response.json()).then((deudas)=>{
            
            deudas.forEach(deuda=>{
                //mostrar el card con las deudas
                document.getElementById('deudas').style.display = "flex";
                //vamos a crear la fila con las deudas
                let filadeuda = document.createElement('tr');
                let colnumero = document.createElement('td');
                let colfecha = document.createElement('td');
                let colservicio = document.createElement('td');
                let colobservacion = document.createElement('td');
                colnumero.innerHTML=deuda.numero;
                colfecha.innerHTML=deuda.fecha;
                colservicio.innerHTML=deuda.servicio;
                colobservacion.innerHTML=deuda.observacion;
                filadeuda.appendChild(colnumero);
                filadeuda.appendChild(colfecha);
                filadeuda.appendChild(colservicio);
                filadeuda.appendChild(colobservacion);
                //console.log(deuda);
                document.getElementById('table_deudas').appendChild(filadeuda);
                //aca mismo tengo que agregar la fila con los detalles:
                let filadeuda2 = document.createElement('tr');
                let coldetalles = document.createElement('td');
                coldetalles.setAttribute('colspan',4);
                //coldetalles.setAttribute('id','detalle'+deuda.numero);
                let lista = document.createElement('ul');
                lista.setAttribute('id','lista'+deuda.numero);
                coldetalles.appendChild(lista);
                filadeuda2.appendChild(coldetalles);
                document.getElementById('table_deudas').appendChild(filadeuda2);
                console.log(deuda.detalles);
                deuda.detalles.forEach(detalle=>{
                    let item = document.createElement('li');
                    item.innerHTML = "#: "+detalle.orden + " | Fecha Pago: "+detalle.fprogramada+" | Estado: "+detalle.estado+" | Monto: "+detalle.monto +" | Boleta: "+detalle.boleta;
                    document.getElementById('lista'+deuda.numero).appendChild(item);
                });
            });
            
        });
        //agrego todo a la tabla
        

        $('#unidades tr').each(function(){ 
            this.remove();
        });
        var HTMLResponse1 = document.querySelector("#unidades");
        var API_URL1 = URL+"estudiantepestudio/unidades/"+id;
        fetch(API_URL1).then((response)=>response.json()).then((unidades)=>{
            unidades.forEach(unidad=>{
                var tr = document.createElement('tr');
                var txt = document.createElement('input');
                var txtid = document.createElement('input');
                txt.setAttribute('name','unidades[]');
                txt.setAttribute('id','txtunidades'+unidad.id);
                txt.setAttribute('class','form-control');
                txt.setAttribute('style','text-align : center')
                txt.setAttribute('readonly',true);
                txtid.setAttribute('name','unidadesid[]');
                txtid.setAttribute('class','form-control');
                txtid.setAttribute('type','hidden');
                txtid.setAttribute('value',unidad.id);
                tr.setAttribute('id','fila'+unidad.id);
                var td0 = document.createElement('td');
                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                var td4 = document.createElement('td');
                var td5 = document.createElement('td');
                var td6 = document.createElement('td');
                var td7 = document.createElement('td');
                //inicio de TD
                    //console.log(unidad.horarios);
                    let ul = document.createElement('ul');
                    ul.setAttribute('id',"ul"+unidad.id);
                    unidad.horarios.forEach(horario=>{
                        let li = document.createElement('li');
                        li.innerHTML= horario.dia+"-"+horario.hinicio+"-"+horario.hfin;
                        ul.appendChild(li);
                    });
                    td7.appendChild(ul);
                //fin TD
                td0.appendChild(txt);
                td0.appendChild(txtid);
                td1.appendChild(document.createTextNode(unidad.ciclo));
                td1.setAttribute('style','text-align: center');
                td2.appendChild(document.createTextNode(unidad.tipo));
                td3.appendChild(document.createTextNode(unidad.nombre));
                td4.appendChild(document.createTextNode(unidad.creditos));
                td5.innerHTML = "<input type='text' id='txt"+unidad.id+"' name='notas[]' readonly class='form-control'>";
                td6.innerHTML = '<a id="btn'+unidad.id+'" onclick="creditos('+unidad.creditos+','+unidad.id+')" class="btn btn-primary">+</a>';
                tr.appendChild(td6);
                tr.appendChild(td0);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                tr.appendChild(td7);
                HTMLResponse1.appendChild(tr);
            });
        });
    /* termino la eleccion */
    var API_URL11 = URL+"estudiantepestudio/unidades/"+id;
    fetch(API_URL11).then((response)=>response.json()).then((unidades)=>{
        unidades.forEach(unidad=>{
            calcularnotas(id,unidad.id);         
        });
    });
    }
    function tohour(cadena){
        let partes = cadena.split(":");
        let hora = parseInt(partes[0]);
        let minutos = parseInt(partes[1]);
        let fecha = new Date(0);
        fecha.setHours(hora);
        fecha.setMinutes(minutos);
        return fecha;
    }
    function cruce(id){
        let respuesta = true;
        let lis = document.querySelectorAll("#ul"+id+" li");
        //tengo que crear un array con los horarios
        let parabuscar=[];
        lis.forEach(li=>{
            let data = li.innerHTML.split('-');
            parabuscar.push({
                 id: id,
                dia: data[0],
                inicio: data[1],
                fin: data[2]
            });
        });
        //parabuscar es el array que vamos a comprar.
        //AHORA TENGO QUE CREAR EL ARRAY dondebuscar.
        let dondebuscar=[];
        let ulElements = document.querySelectorAll('#unidades ul[id^="ul"]');
        ulElements.forEach(ul=>{
            let lis = ul.children;
            if (lis.length > 0){
                for (let $i = 0; $i < lis.length; $i++) {
                    let data = lis[$i].innerHTML.split('-');
                    //evitar poner el array 
                    if(ul.id !== "ul"+id){
                        if(document.getElementById('txtunidades'+ul.id.slice(2)).value == "SI"){
                            dondebuscar.push({
                            id: ul.id,
                            dia: data[0],
                            inicio: data[1],
                            fin: data[2]
                        });
                        }
                    }
                }
            }
        });
        //console.log(parabuscar);
        //console.log(dondebuscar);
        //ahora vamos a verificar
        parabuscar.forEach(para=>{
            dondebuscar.forEach(donde=>{
                if(para.dia == donde.dia){
                    if(tohour(para.inicio) >= tohour(donde.inicio) && tohour(para.inicio) < tohour(donde.fin)){
                        respuesta = false;
                    }else{
                        if( tohour(para.inicio) < tohour(donde.inicio) && tohour(para.fin)>tohour(donde.inicio)){
                            respuesta = false;
                        }
                    }
                }
            });
        });
        return respuesta;
    }
    function creditos(creditos,unidad){
        if (cruce(unidad)){
            //alert(cruce(unidad));
            var maximo = $('#cretotal').val();
            var valor = $('#txtunidades'+unidad).val();
            var total = $('#txtcreditos').val();
            total = parseFloat(total);
            if (valor == 'SI'){
                $('#txtunidades'+unidad).val('NO');
                /* quitar creditos */
                total = total - creditos;
            }else{
                /* aca verificamos el maximo */
                if(total+creditos>maximo){
                    alert('no se puede superar el maximo de: '+maximo+' creditos');   
                }else{
                    $('#txtunidades'+unidad).val('SI');
                    /* aumentar creditos */
                    total = total + creditos;    
                }
            }
            $('#txtcreditos').val(total);
        }else{
            alert("Existe un cruce de horarios con esta unidad didactica");
        }
    }
    </script>
@stop
