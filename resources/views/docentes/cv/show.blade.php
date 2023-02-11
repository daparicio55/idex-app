
<!DOCTYPE html>
<html lang="es_ES">
<head>
<title>{{ $personale->apellidos }} - {{ $personale->nombres }}</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Roboto'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta charset='utf-8'>
<style>
html,body,h1,h2,h3,h4,h5,h6 {font-family: "Roboto", sans-serif}
</style>
</head>
<body class="w3-light-grey">
<header class="w3-container w3-indigo w3-center w3-margin-botton">
  <img class="w3-margin-top" src="https://sisge.idexperujapon.edu.pe/img/logo.png" height="100">
  <h3>IESTP Perú Japón</h3>
  <p>"la unidad es la medalla que nos distingue"</p>
</header>
<!-- Page Container -->
<div class="w3-content w3-margin-top" style="max-width:1400px;">

  <!-- The Grid -->
  <div class="w3-row-padding">
  
    <!-- Left Column -->
    <div class="w3-third">
    
      <div class="w3-white w3-text-grey w3-card-4">
        <div class="w3-display-container">
          <img src="{{ Storage::url($personale->perFoto) }}" style="width:100%" alt="Avatar">
          <div class="w3-display-bottomleft w3-container w3-text-black w3-light-gray w3-opacity">
            <h2 class="w3-text-shadow" style="font-weight: bold;text-shadow:1px 1px 0 #444">{{ $personale->apellidos }} {{ $personale->nombres }}</h2>
          </div>
        </div>
        <div class="w3-container">
            <p>
                <i class="fa fa-briefcase fa-fw w3-margin-right w3-large w3-text-indigo"></i>
                {{ $personale->perTitulo }}
            </p>
          <p><i class="fa fa-home fa-fw w3-margin-right w3-large w3-text-indigo"></i>{{ $personale->perCiudad }}, {{ $personale->perDepartamento }}</p>
          <p><i class="fa fa-envelope fa-fw w3-margin-right w3-large w3-text-indigo"></i>{{ $personale->correoInstitucional }}</p>
          <p><i class="fa fa-phone fa-fw w3-margin-right w3-large w3-text-indigo"></i>{{ $personale->telefono }}</p>
          <p><i class="fa fa-id-card fa-fw w3-margin-right w3-large w3-text-indigo"></i>{{ $personale->dni }}</p>
          @isset($personale->ncolegiatura)
            <p><i class="fa fa-code fa-fw w3-margin-right w3-large w3-text-indigo"></i>{{ $personale->ncolegiatura }}</p>
          @endisset
          <hr>
            <p class="w3-large"><b><i class="fa fa-id-card fa-fw w3-margin-right w3-text-indigo"></i>Perfil</b></p>
            <p style="text-align:justify">{{ $personale->perPerfil }}</p>
            <hr>  
          <p class="w3-large"><b><i class="fa fa-asterisk fa-fw w3-margin-right w3-text-indigo"></i>Conocimientos</b></p>
          @isset($personale->conocimientos->ingles)
            <p>Inglés</p>
            <div class="w3-light-grey w3-round-xlarge w3-small">
              <div class="w3-container w3-center w3-round-xlarge w3-indigo" style="width:{{ $personale->conocimientos->ingles }}%">{{ $personale->conocimientos->ingles }}%</div>
            </div>
            <p>Ofimática</p>
            <div class="w3-light-grey w3-round-xlarge w3-small">
              <div class="w3-container w3-center w3-round-xlarge w3-indigo" style="width:{{ $personale->conocimientos->ofimatica }}%">
                <div class="w3-center w3-text-white">{{ $personale->conocimientos->ofimatica }}%</div>
              </div>
            </div>
            <p>TIC's</p>
            <div class="w3-light-grey w3-round-xlarge w3-small">
              <div class="w3-container w3-center w3-round-xlarge w3-indigo" style="width:{{ $personale->conocimientos->tics }}%">{{ $personale->conocimientos->tics }}%</div>
            </div>
            <br>
          @endisset
        </div>
      </div><br>

    <!-- End Left Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-twothird">
    
      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-suitcase fa-fw w3-margin-right w3-xxlarge w3-text-indigo"></i>Experiencia Laboral</h2>
        @foreach ( $personale->experiencias->sortByDesc('exFechaInicio') as $experiencia)
            <div class="w3-container">
                <h5 class="w3-opacity"><b>{{ $experiencia->exCargo }} / {{ $experiencia->exEmpresa }}</b></h5>
                <h6 class="w3-text-indigo">
                    <i class="fa fa-calendar fa-fw w3-margin-right"></i>
                    {{ \Carbon\Carbon::parse($experiencia->exFechaInicio)->formatLocalized('%B %Y') }} - @if ($experiencia->exActual == true) <span class="w3-tag w3-indigo w3-round">Actual</span> @else {{ \Carbon\Carbon::parse($experiencia->exFechaFin)->formatLocalized('%B %Y') }} @endif
                </h6>
                <p style="text-align:justify">{{ $experiencia->exTareas }}</p>
                <hr>
          </div>
        @endforeach
        
        
      </div>

      <div class="w3-container w3-card w3-white w3-margin-bottom">
        <h2 class="w3-text-grey w3-padding-16"><i class="fa fa-certificate fa-fw w3-margin-right w3-xxlarge w3-text-indigo"></i>Formacion Profesional</h2>
        @foreach ($personale->estudios->sortByDesc('esAnioInicio') as $estudio)
            <div class="w3-container">
                <h5 class="w3-opacity"><b>{{ $estudio->esInstitucion }}</b></h5>
                <h6 class="w3-text-indigo"><i class="fa fa-calendar fa-fw w3-margin-right"></i>{{ $estudio->esAnioInicio }} - {{ $estudio->esAnioFin }}</h6>
                <p>{{ $estudio->esTitulo }} - {{ $estudio->esMencion }}</p>
                <p>{{ $estudio->esDescripcion }}</p>
                <hr>
          </div>
        @endforeach
      </div>

      <div class="w3-container w3-card w3-white">
        <span class="w3-text-grey w3-padding-16">
          <h2 class="w3-text-grey" style="display: inline-block">
            <i class="fa fa-book fa-fw w3-margin-right w3-xxlarge w3-text-indigo"></i>
            Unidades didácticas asignadas
          </h2>
          <small class="w3-text-grey"> periodo académico {{ $periodo->nombre }}</small>
        </span>
        <ul class="w3-text-indigo">
            @foreach ($personale->user->unidades as $unidade)
              @if ($unidade->pmatricula_id == $periodo->id)
                <li> 
                  <h5>{{ $unidade->unidad->nombre }} - {{ $unidade->unidad->modulo->carrera->nombreCarrera }}</h5>
                </li>  
              @endif
            @endforeach
        </ul>
      </div>
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
  <!-- End Page Container -->
</div>

<footer class="w3-container w3-indigo w3-center w3-margin-top">
  <p>IESTP Perú Japón</p>
  <a href="https://www.facebook.com/iestpperujapon">
    <i class="fa fa-facebook-official w3-hover-opacity"></i>
  </a>
  {{-- <i class="fa fa-instagram w3-hover-opacity"></i>
  <i class="fa fa-snapchat w3-hover-opacity"></i>
  <i class="fa fa-pinterest-p w3-hover-opacity"></i>
  <i class="fa fa-twitter w3-hover-opacity"></i>
  <i class="fa fa-linkedin w3-hover-opacity"></i> --}}
  <p>Powered by Oficina de Soporte Tecnológico - <a href="https://www.iestpperujapon.edu.pe" target="_blank">2023</a></p>
</footer>

</body>
</html>