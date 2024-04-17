@extends('adminlte::page')

@section('title', 'Registro de Licencia')

@section('content_header')
    <h1>Registro de Licencia</h1>
@stop

@section('content')
    {{-- <p>Welcome to this beautiful admin panel.</p> --}}
    
    @include('sacademica.licencias.mestudiante')
    <div class="input-group mb-3">
        <input type="text" class="form-control" id="txtdni" placeholder="ingrese DNI" aria-label="ingrese DNI" aria-describedby="button-addon2">
        <div class="input-group-append">
            <button class="btn btn-outline-primary" type="button" id="button-addon2" onclick="ebuscar()">
                <i class="fas fa-search"></i> Buscar
            </button>
        </div>
    </div>
    <div class="card">
        <div class="card-header bg-danger">
            <h5 class="h5"><i class="fas fa-user-graduate"></i> Datos Estudiante</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 mt-1">
                    <label>Apellidos</label>
                    <input type="text" class="form-control" id="e_apellido" readonly>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-1">
                    <label>Nombres</label>
                    <input type="text" class="form-control" id="e_nombre" readonly>
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-1">
                    <label>Teléfono</label>
                    <input type="text" class="form-control" id="e_telefono" readonly>
                </div>
                <div class="col-sm-12 mt-1">
                    <label>Programa de Estudios</label>
                    <input type="text" class="form-control" id="e_programa" readonly>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <h5 class="h5"><i class="fas fa-list"></i> Matrículas</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <th>Fecha</th>
                        <th>Tipo</th>
                        <th>Periodo</th>
                        <th>Marcar Licencia</th>
                    </thead>
                    <tbody id="tb_matriculas">
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        function ebuscar(){
            
            const dni = document.getElementById('txtdni');
            if (dni.value == ''){
                alert('Ingrese un numero de DNI');
            }else{
                //borrar las filas
                let tabledoby = document.getElementById('emtbody');
                while (tabledoby.firstChild) {
                    tabledoby.removeChild(tabledoby.firstChild);
                }
                //buscamos el DNI
                //mostrar el modal
                const ruta = "{{ asset('') }}"+"estudiantepestudio/dni/"+ dni.value;
                fetch(ruta)
                .then(function(response) {
                    // Verificar si la respuesta es exitosa (código de estado 200)
                    if (!response.ok) {
                    throw new Error('Error en la solicitud: ' + response.status);
                    }
                    // Convertir la respuesta a formato JSON
                    return response.json();
                })
                .then(function(data) {
                    // Manejar los datos obtenidos
                    data.forEach(element => {
                        let tabledoby = document.getElementById('emtbody');
                        let tr = document.createElement('tr');
                        let td1 = document.createElement('td');
                        let td2 = document.createElement('td');
                        let td3 = document.createElement('td');
                        let td4 = document.createElement('td');
                        let btn = document.createElement('button');
                        td1.innerHTML = element.dniRuc;
                        td2.innerHTML = element.Apellido + ', ' + element.Nombre;
                        td3.innerHTML = element.programa,
                        //dandole forma al boton
                        btn.innerHTML = "<i class='fas fa-plus-square'></i>";
                        btn.classList.add('btn');
                        btn.classList.add('btn-info');
                        btn.type="button";
                        btn.setAttribute('onclick','selectestudiante('+ element.estudiante_id +')');
                        td4.appendChild(btn);
                        tr.appendChild(td1);
                        tr.appendChild(td2);
                        tr.appendChild(td3)
                        tr.appendChild(td4);
                        tabledoby.appendChild(tr);
                    });
                    console.log('Datos recibidos:', data);
                })
                .catch(function(error) {
                    // Manejar errores de la solicitud
                    console.error('Error al realizar la solicitud:', error);
                });
                $('#mestudiante').modal('show');
            }
        }
        function selectestudiante(id){
            
            $('#mestudiante').modal('hide');
            //vamos a poner los datos 
            const ruta = "{{ asset('') }}"+"estudiantepestudio/licencias/"+id;
            fetch(ruta).then(function(response){
                if(!response.ok){
                    throw new Error('Error en la solicitud: ' + response.status);
                }
                return response.json();
            }).then(function(data){
                document.getElementById('e_apellido').value = data.apellido;
                document.getElementById('e_nombre').value = data.nombre;
                document.getElementById('e_telefono').value = data.telefono;
                document.getElementById('e_programa').value = data.programa;
                //llenamos la tabla con las matriculas
                let tb_matriculas = document.getElementById('tb_matriculas');
                while (tb_matriculas.firstChild) {
                    tb_matriculas.removeChild(tb_matriculas.firstChild);
                }
                data.matriculas.forEach(matricula => {
                    let frm = document.createElement('form');
                    let btn_enviar = document.createElement("button");
                    btn_enviar.type="submit";
                    btn_enviar.classList.add('btn');
                    btn_enviar.classList.add('btn-info');
                    btn_enviar.innerHTML = '<i class="fas fa-share-square"></i>';
                    frm.method = "POST";
                    frm.action = "{{ asset('') }}"+"sacademica/licencias/"+matricula.id;
                    let _token = '@csrf';
                    in_put = document.createElement('input');
                    in_put.name = "_method";
                    in_put.value = "PUT";
                    in_put.type = "hidden";
                    frm.innerHTML = _token;
                    in_observacion = document.createElement('input');
                    in_observacion.name = "observacion";
                    in_observacion.required = true;
                    in_observacion.classList.add('form-control');
                    in_observacion.classList.add('d-inline');
                    let div1 = document.createElement('div');
                    let div2 = document.createElement('div');
                    div1.classList.add('input-group');
                    div2.classList.add('input-group-append');
                    div2.appendChild(btn_enviar);
                    div1.appendChild(in_observacion);
                    div1.appendChild(div2);

                    //frm.appendChild(in_observacion);
                    frm.appendChild(in_put);
                    frm.appendChild(div1);
                    //frm.appendChild(btn_enviar);
                    let tr = document.createElement('tr');
                    let td1 = document.createElement('td');
                    let td2 = document.createElement('td');
                    let td3 = document.createElement('td');
                    let td4 = document.createElement('td');
                    td1.innerHTML = matricula.fecha;
                    td2.innerHTML = matricula.tipo;
                    td3.innerHTML = matricula.periodo;
                    td4.appendChild(frm);
                    tr.appendChild(td1);
                    tr.appendChild(td2);
                    tr.appendChild(td3);
                    tr.appendChild(td4);
                    //tr.appendChild(frm);
                    tb_matriculas.appendChild(tr);
                    //tb_matriculas.appendChild(frm);
                });                
            }).catch(function(error){
                console.error('Error al realizar la solicitud:', error);
            })
            



        }


    </script>
@stop