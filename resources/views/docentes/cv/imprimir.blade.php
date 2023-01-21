<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <style type="text/css" media="all">
    .verticalText
    {
        text-align: center;
        vertical-align: bottom;
        width: auto;
        margin: 20px;
        padding: 0px;
        padding-left: 0px;
        padding-right: 0px;
        padding-top: 0px;
        white-space: nowrap;
        -webkit-transform: rotate(-270deg);
        -moz-transform: rotate(-270deg);
    }
    </style>
    <title>{{strtoupper($personales->apellidos)}} {{strtoupper($personales->nombres)}}</title>
</head>
<body>
<header>
    <div class="row">
        <div class="col-sm-6">
            <img src="{{asset('img/sinlogo.jpg')}}" alt="">
        </div>
        <div class="col-sm-6">
            <img src="{{asset('img/logo.png')}}" class="float-right" style="width: 145px" alt="">
        </div>
    </div>
    <br>
    <div class="card border-primary sm-12">
        <div class="row no-gutters align-items-center">
          <div class="col-sm-3">
            <img src="{{asset('img/fotos/'.$personales->perFoto)}}" class="rounded mx-auto d-block" style="width: 200px; margin: 0 auto" alt="...">
          </div>
          <div class="col-sm-9 align-middle" >
            <div class="card-body">
              <h2 class="card-title text-uppercase"><strong>{{$personales->apellidos}} {{$personales->nombres}}</strong></h2>
              <h3 class="card-text"><em>{{$personales->perTitulo}}</em></h3>
              <h6 class="card-title mb-1"><i class="fa fa-envelope-o" aria-hidden="true"></i> Correo:</h6>
            <p class="card-subtitle mb-2">{{$personales->correoInstitucional}}</p>
            <h6 class="card-title mb-1"><i class="fa fa-mobile" aria-hidden="true"></i> Telefono:</h6>
            <p class="card-subtitle mb-2">{{$personales->telefono}}</p>
            <h6 class="card-title mb-1"><i class="fa fa-check-circle" aria-hidden="true"></i> Dirección:</h6>
            <p class="card-subtitle mb-2">{{$personales->perDireccion}} - {{$personales->perCiudad}} - {{$personales->perDepartamento}}</p>
            </div>
          </div>
        </div>
    </div>
</header>
<br>
<div class="row">

<div class="col-sm-12">

<div class="card sm-12">
    <div class="card-header bg-primary text-white">
        <h4><i class="fa fa-graduation-cap" aria-hidden="true"></i> Formacion Profesional.</h4>
    </div>
    <div class="card-body">
        @foreach ($estudios as $estudio)
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="card-title"><i class="fa fa-calendar" aria-hidden="true"></i> {{$estudio->esAnioInicio}} - {{$estudio->esAnioFin}} </h5>
                </div>
                <div class="col-sm-8">
                    <h4 class="card-title"><i class="fa fa-graduation-cap" aria-hidden="true"></i> {{$estudio->esTitulo}} - {{$estudio->esMencion}}</h4>
                    <h5 class="card-title mb-1"><i class="fa fa-building-o" aria-hidden="true"></i> {{$estudio->esInstitucion}}</h5>
                    <h6 class="card-subtitle mb-3 text-muted">{{$estudio->esCiudad}} - {{$estudio->esDepartamento}} - {{$estudio->esPais}}</h6>
                    
                    {{-- <p class="card-text"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{$estudio->esDescripcion}}</p> --}}
                </div>
            </div>
            <br>
        @endforeach
    </div>
</div>


 {{-- experiencia laboral --}}   
<div class="card sm-12">
    <div class="card-header bg-primary text-white">
        <h4><i class="fa fa-briefcase" aria-hidden="true"></i> Experiencia Laboral.</h4>
    </div>
    <div class="card-body">
        @foreach ($experiencias as $experiencia)
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="card-title"><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d-m-Y',strtotime($experiencia->exFechaInicio))}} / {{date('d-m-Y',strtotime($experiencia->exFechaFin))}} </h5>
                </div>
                <div class="col-sm-8">
                    <h4 class="card-title"><i class="fa fa-cogs" aria-hidden="true"></i> {{$experiencia->exCargo}}</h4>
                    <h5 class="card-title mb-1"><i class="fa fa-building-o" aria-hidden="true"></i> {{$experiencia->exEmpresa}}</h5>
                    <h6 class="card-subtitle mb-3 text-muted">{{$experiencia->exCiudad}} - {{$experiencia->exDepartamento}} - {{$experiencia->exPais}}</h6>
                    
                    {{-- <p class="card-text"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{$experiencia->exTareas}}</p> --}}
                </div>
            </div>
            <br>
        @endforeach
    </div>
</div>


{{-- CAPACITACIONES --}}

{{-- <div class="card sm-12">
    <div class="card-header bg-info text-white">
        <h4><i class="fa fa-cogs" aria-hidden="true"></i> Cursos, Capacitacione y/o Actualizaciones .</h4>
    </div>
    <div class="card-body">
        @foreach ($capacitaciones as $capacitacion)
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="card-title"><i class="fa fa-calendar" aria-hidden="true"></i> {{date('d-m-Y',strtotime($capacitacion->caFechaInicio))}} - {{date('d-m-Y',strtotime($capacitacion->caFechaFin))}} </h5>
                </div>
                <div class="col-sm-8">
                    <h5 class="card-title mb-1"><i class="fa fa-building-o" aria-hidden="true"></i> {{$capacitacion->caInstitucion}}</h5>
                    <h6 class="card-subtitle mb-3 text-muted">{{$capacitacion->caCiudad}} - {{$capacitacion->caDepartamento}} - {{$capacitacion->caPais}}</h6>
                    <h6 class="card-subtitle">{{$capacitacion->caNombre}}</h6>
                    <p class="card-text"><i class="fa fa-hand-o-right" aria-hidden="true"></i> {{$capacitacion->caDescripcion}}</p>
                </div>
            </div>
            <br>
        @endforeach
    </div>
</div> --}}
</div>
</div>


    <!-- JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>
</html>