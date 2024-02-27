<html lang="es">
<head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.css') }}">
    <link rel="stylesheet" href="{{asset('vendor\fontawesome-free\css\all.min.css')}}">
    <title>CEPRE</title>
</head>
<body>
   <div class="container mt-4">
        {{-- cabecera --}}
        <div class="card mb-3 border border-dark">
            <div class="row">
              <div class="col-sm-4">
                <img src="{{asset('img/logo.png')}}"  style="width: 140px" class="mx-auto d-block card-img p-2" alt="...">
              </div>
              <div class="col-sm-8">
                <div class="card-body text-center pb-0">
                    <h3 class="h3">CENTRO PRE "IDEX PERÚ JAPÓN"</h3>
                    <span class="h5">Ficha de Inscripción - Año {{$cepreEstudiante->cepre->periodoCepre}}</span>
                    <p class="card-subtitle"><strong>Chachapoyas - Amazonas</strong></p>
                    <p class="card-subtitle"><small class="text-muted"><i class="fa fa-check" aria-hidden="true"></i> Jr. Amazonas #120 <i class="fa fa-mobile" aria-hidden="true"></i> 041 - 750047 <i class="fa fa-globe" aria-hidden="true"></i> www.idexperujapon.edu.pe</small></p>
                    <p class="p-0 m-0">
                        <span class="text-danger"><strong>AULA: {{ cero($cepreEstudiante->aula) }}</strong></span>
                    </p>
                </div>
              </div>
            </div>
        </div>
        {{-- carrera profesional --}}
        <div class="card mb-12 border border-dark">
            <div class="card-header bg-secondary p-0">
                <h4 class="text-center m-1 p-1">
                    <strong>
                        <i class="fas fa-graduation-cap"></i> CARRERA PROFESIONAL
                    </strong>
                </h4>
            </div>
            <div class="col-md-12">
                <div class="card-body p-1" style="text-align: center">
                    <p class="h2"><strong class="text-uppercase">{{$cepreEstudiante->carrera->nombreCarrera}}</strong></p>
                </div>
            </div>
        </div>
        {{-- datos personales --}}
        <div class="card mb-3 border border-dark">
            <div class="card-header bg-secondary p-0">
                <h4 class="text-center m-1 p-1">
                    <strong>
                        <i class="fas fa-id-card"></i> DATOS PERSONALES
                    </strong>
                </h4>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <img src="{{ Storage::url($cepreEstudiante->url) }}"  style="width: 190px" class="mx-auto d-block card-img pt-2" alt="...">
              </div>
              <div class="col-sm-8">
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
            <div class="card-header bg-secondary p-0">
                <h4 class="text-center m-1 p-1">
                    <strong>
                        <i class="fas fa-school"></i> DATOS ACADÉMICOS
                    </strong>
                </h4>
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
            <div class="card-header bg-secondary p-0">
                <h4 class="text-center m-1 p-1">
                    <strong>
                        <i class="fas fa-ambulance"></i> CONTACTO EN CASO DE EMERGENCIA
                    </strong>
            </h4>
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
            <div class="col-sm-12">
                <div class="card-body">
                    <div class="row align-items-end">
                        <div class="col-sm-7">
                            <p class="h6">Fecha de Solicitud:  Chachapoyas <strong>{{date('d F Y', strtotime($cepreEstudiante->ceEsFecha))}}</strong></p>
                        </div>
                        <div class="col-sm-3">
                            <p style="text-decoration: overline"> Firma del Solicitante </p>
                        </div>
                        <div class="col-sm-2">
                            <img src="{{asset('img/huella.png')}}" style="width: 3cm" class="mx-auto d-block card-img" alt="...">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- footer --}}
        <div class="card mb-12 border border-dark">
            <div class="card-header bg-secondary p-0">
                <h4 class="text-center m-1 p-1"><strong>ADJUNTAR A ESTE FORMULARIO</strong></h4>
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    <p class="h6">Fotocopia simple de DNI del estudiante</p>
                    <p class="h6">Comprobante de pago de inscripcion a <strong>CEPRE Perú Japón {{$cepreEstudiante->periodoCepre}}</strong></p>
                    <p class="h6">Carta Compromiso <strong>CEPRE Perú Japón {{$cepreEstudiante->periodoCepre}}</strong></p>
                </div>
            </div>
        </div>
   </div>
</body>
</html>