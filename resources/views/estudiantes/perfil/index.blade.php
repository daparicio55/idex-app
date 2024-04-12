@extends('adminlte::page')

@section('title', 'Estudiante | Perfil')

@section('content_header')
    <h1>Perfil</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header bg-info">
            <h5 class="h5"><i class="fas fa-address-card"></i> Datos Personales</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">DNI</label>
                    <input type="text" class="form-control" readonly  value="{{ $user->ucliente->cliente->dniRuc }}">
                </div>                
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">APELLIDOS</label>
                    <input type="text" class="form-control" readonly value="{{ Str::upper($user->ucliente->cliente->apellido) }}">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">Nombres</label>
                    <input type="text" class="form-control" readonly value="{{ Str::title($user->ucliente->cliente->nombre) }}">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">Email</label>
                    <input type="text" class="form-control" readonly value="{{$user->ucliente->cliente->email }}">
                </div>
                <div class="col-sm-12 col-md-8 mt-2">
                    <label for="">Dirección</label>
                    <input type="text" class="form-control" name="direccion" id="direccion" value="{{$user->ucliente->cliente->direccion }}">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">Telefono</label>
                    <input type="text" class="form-control" name="telefono1" id="telefono1" value="{{$user->ucliente->cliente->telefono }}">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">Whatsapp</label>
                    <input type="text" class="form-control" name="telefono2" id="telefono2" value="{{$user->ucliente->cliente->telefono2 }}">
                </div>
                <div class="col-sm-12 col-md-6 col-lg-4 mt-2">
                    <label for="">F. Nacimiento</label>
                    <input type="date" class="form-control" readonly value="{{ $estudiante[0]->postulante->fechaNacimiento }}">
                </div>
            </div>
        </div>
        <div class="card-footer">
            <button type="button" class="btn btn-primary" onclick="guardar()">
                <i class="fas fa-save"></i> Guardar
            </button>
        </div>
    </div>

<div id="loader-wrapper" style="display: none">
    <div id="loader">
        <div id="circle"></div>
    </div>
    <p id="loading-text">Cargando esto puede tomar varios minutos ...</p>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop

@section('js')
    <script src="{{ asset('js/carga.js') }}"></script>
    <script>
        function guardar(){
            let token = document.getElementsByName('_token');
            let ruta = "{{ route('estudiantes.perfile.update',$estudiante[0]->postulante->idCliente) }}";
            let telefono1 = document.getElementById('telefono1');
            let telefono2 = document.getElementById('telefono2');
            let direccion = document.getElementById('direccion');
            const datos = {
                _token : token[0].value,
                telefono1 : telefono1.value,
                telefono2 : telefono2.value,
                direccion : direccion.value,
            };
            const opciones = {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json' // Asegúrate de ajustar esto según sea necesario
            },
            body: JSON.stringify(datos)
            };

            mostrarPantallaDeCarga();
            fetch(ruta, opciones)
            .then(response => {
                if (!response.ok) {
                throw new Error('La solicitud ha fallado');
                }
                return response.json();
            })
            .then(data => {
                console.log('Respuesta del servidor:', data);
                // Maneja la respuesta del servidor aquí
            })
            .catch(error => {
                console.error('Error al realizar la solicitud:', error);
            }).finally(()=>{
                ocultarPantallaDeCarga();
            });

            console.log(datos);
        }
    </script>
@stop