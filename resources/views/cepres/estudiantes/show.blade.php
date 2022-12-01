<html lang="es">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <title>CEPRE</title>
</head>
<body>
   
    {{-- cabecera --}}
    <div class="card mb-12 border border-dark">
        <div class="row no-gutters align-items-center">
          <div class="col-md-2">
            <img src="{{asset('img/logo.png')}}"  style="width: 145px" class="mx-auto d-block card-img" alt="...">
          </div>
          <div class="col-md-10 text-center">
            <div class="card-body">
              <h1 class="card-title">CENTRO PRE "IDEX PERÚ JAPÓN"</h1>
              <h3 class="card-title">Ficha de Inscripción - Año {{$cepreEstudiante->periodoCepre}}</h3>
              <p class="card-subtitle"><strong>Chachapoyas - Amazonas</strong></p>
              <p class="card-subtitle"><small class="text-muted"><i class="fa fa-check" aria-hidden="true"></i> Jr. Amazonas #120 <i class="fa fa-mobile" aria-hidden="true"></i> 041 - 750047 <i class="fa fa-globe" aria-hidden="true"></i> www.idexperujapon.edu.pe</small></p>
            </div>
          </div>
        </div>
    </div>
    {{-- carrera profesional --}}
    <div class="card mb-12 border border-dark">
        <div class="card-header">
            <h4 class="text-center"><strong>CARRERA PROFESIONAL</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="card-body" style="text-align: center">
                <p class="h4"><strong class="text-uppercase">{{$cepreEstudiante->carrera->nombreCarrera}}</strong></p>
            </div>
        </div>
    </div>
    {{-- datos personales --}}

    <div class="card mb-12 border border-dark">
        <div class="card-header">
            <h4 class="text-center"><strong>DATOS PERSONALES</strong></h4>
        </div>
        <div class="row no-gutters">
          <div class="col-md-2">
            <img src="{{asset('img/foto.png')}}" style="" style="width: 4cm;height: 5cm" class="mx-auto d-block card-img" alt="...">
          </div>
          <div class="col-md-10">
            <div class="card-body">
                <p class="h5">APELLIDOS: <strong class="text-uppercase">{{$cepreEstudiante->cliente->apellido}}</strong> NOMBRES: <strong class="text-capitalize">{{$cepreEstudiante->cliente->nombre}}</strong></p>
                <p class="h5">DNI:<strong> {{$cepreEstudiante->cliente->dniRuc}}</strong> F. Nacimiento: <strong>{{date('d-m-Y', strtotime($cepreEstudiante->fechaNacimiento))}}</strong></p>
                <p class="h5">TELÉFONO <i class="fa fa-mobile" aria-hidden="true"></i>: <strong>{{$cepreEstudiante->cliente->telefono}}</strong> TELÉFONO <i class="fa fa-whatsapp" aria-hidden="true"></i>: <strong>{{$cepreEstudiante->cliente->telefono2}}</strong> </p>
                <p class="h5">EMAIL: <strong>{{$cepreEstudiante->cliente->email}}</strong></p>
                <p class="h5">DIRECCIÓN: <strong>{{$cepreEstudiante->cliente->direccion}}</strong></p>
                <p class="h5">DEPARTAMENTO: <strong>{{$cepreEstudiante->ceEsDepartamento}}</strong> PROVINCIA: <strong>{{$cepreEstudiante->ceEsProvincia}}</strong> DISTRITO: <strong>{{$cepreEstudiante->ceEsDistrito}}</strong></p>
            </div>
          </div>
        </div>
    </div>
    {{-- datos academicos --}}
    <div class="card mb-12 border border-dark">
        <div class="card-header">
            <h4 class="text-center"><strong>DATOS ACADÉMICOS</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                <p class="h5">INSTITUCIÓN SECUNDARIA DE PROCEDENCIA: <strong>{{$cepreEstudiante->ieProcedencia}}</strong></p>
                <p class="h5">DIRECCIÓN: <strong>{{$cepreEstudiante->ieDireccion}}</strong> DISTRITO: {{$cepreEstudiante->ieDistrito}} PROVINCIA: <strong>{{$cepreEstudiante->ieProvincia}}</strong> DEPARTAMENTO: <strong>{{$cepreEstudiante->ieDepartamento}}</strong></p>
                @if ($cepreEstudiante->ceEsDiscapacidad == "SI")
                    <p class="h5">¿CUENTA USTEN CON ALGUNA DISCAPACIDAD?: <strong>SI</strong> ¿QUE DISCAPACIDAD? <strong>{{$cepreEstudiante->ceEsObservacion}}</strong></p>
                    @if ($cepreEstudiante->ceEsDisCertificado == "SI")
                        <p class="h5">¿CUENTA USTED CON CERTIFICADO DE DISCAPACIDAD?: <strong>SI</strong></p>
                    @else
                        <p class="h5">¿CUENTA USTED CON CERTIFICADO DE DISCAPACIDAD?: <strong>NO</strong> OTRO DOCUMENTO: <strong>{{$cepreEstudiante->ceEsDisCerObservacion}}</strong></p>
                    @endif
                @else
                    <p class="h5">¿CUENTA USTED CON ALGUNA DISCAPACIDAD?: <strong>NO</strong></p>
                @endif
            </div>
        </div>
    </div>
    {{-- datos de emergencia --}}
    <div class="card mb-12 border border-dark">
        <div class="card-header">
            <h4 class="text-center"><strong>CONTACTO EN CASO DE EMERGENCIA</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                <p class="h5">APELLIDOS Y NOMBRES: <strong>{{$cepreEstudiante->conApellido}} {{$cepreEstudiante->conNombre}}</strong> TELEFONO: <strong>{{$cepreEstudiante->conTelefono}}</strong></p>
                <p class="h5">PARENTESCO: <strong>{{$cepreEstudiante->conParentesco}}</strong> DIRECCIÓN: <strong>{{$cepreEstudiante->conDireccion}}</strong></p>
            </div>
        </div>
    </div>
    {{-- firmas --}}
    <div class="card mb-12 border border-dark">
        <div class="card-header">
            <h4 class="text-center"><strong></strong></h4>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                <div class="row align-items-end">
                    <div class="col-md-7">
                        <p class="h6">Fecha de Solicitud:  Chachapoyas <strong>{{date('d F Y', strtotime($cepreEstudiante->ceEsFecha))}}</strong></p>
                    </div>
                    <div class="col-md-3">
                        <p style="text-decoration: overline"> Firma del Solicitante </p>
                    </div>
                    <div class="col-md-2">
                        <img src="{{asset('img/huella.png')}}" style="width: 3cm" class="mx-auto d-block card-img" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- footer --}}
    <div class="card mb-12 border border-dark">
        <div class="card-header">
            <h4 class="text-center"><strong>ADJUNTAR A ESTE FORMULARIO</strong></h4>
        </div>
        <div class="col-md-12">
            <div class="card-body">
                <p class="h5">Fotocopia simple de DNI del estudiante</p>
                <p class="h5">Comprobante de pago de inscripcion a <strong>CEPRE Perú Japón {{$cepreEstudiante->periodoCepre}}</strong></p>
                <p class="h5">02 Fotografias tamaño carnet</p>
                <p class="h5">Carta Compromiso <strong>CEPRE Perú Japón {{$cepreEstudiante->periodoCepre}}</strong></p>
            </div>
        </div>
    </div>
    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>