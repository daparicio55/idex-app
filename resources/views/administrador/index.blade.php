@extends('adminlte::page')
@section('title', 'Administrador')

@section('content_header')
    <h1>Panel de Administrador</h1>
@stop
@section('content')

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="collapse navbar-collapse" id="navbarNavDropdown1">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a href="{{ route('administrador.normalizarnombres') }}" class="btn btn-outline-danger" >Normalizacion de Nombres</a>
      </li>
    </ul>
  </div>
</nav>


<nav class="navbar navbar-expand-lg navbar-light">
    {{-- <a class="navbar-brand" href="#">MENU</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button> --}}
    
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <button class="btn btn-outline-success" id="btn-notas" type="button">Revisar Notas</button>
        </li>
        <li>
          <button type="button" class="btn btn-outline-info ml-2">Revisar Ex. Formativas</button>
        </li>
        <li>
          <a href="{{ route('administrador.reportedeudas') }}" class="btn btn-outline-primary ml-2">Reporte Deudas</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navingresantes" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reporte Ingresantes
          </a>
          <div class="dropdown-menu" aria-labelledby="navingresantes">
            @foreach ($admisiones as $admisione)
                <a class="dropdown-item" href="{{ route('administrador.reporteingresantes',$admisione->id) }}">{{ $admisione->periodo }}</a>    
            @endforeach
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navdiscapacidad" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reporte Discapacidad
          </a>
          <div class="dropdown-menu" aria-labelledby="navdiscapacidad">
            @foreach ($periodos as $periodo)
              <a href="{{ route('administrador.reportedis',$periodo->id) }}" class="dropdown-item">
                {{ $periodo->nombre }}
              </a>
            @endforeach
          </div>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navreportematricula" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reporte de Matriculas
          </a>
          <div class="dropdown-menu" aria-labelledby="navreportematricula">
            @foreach ($periodos as $periodo)
                <a href="{{ route('administrador.reportematricula',$periodo->id) }}" class="dropdown-item">
                  {{ $periodo->nombre }}
                </a>
            @endforeach
          </div>
        </li>
      </ul>
    </div>
</nav>
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
    <script>
    function mostrarPantallaDeCarga() {
      const loader = document.getElementById('loader-wrapper');
      loader.style.display = "flex";
      loader.style.opacity = '1'; // Establece la opacidad al 100%
    }
    // Ocultar la pantalla de carga con un efecto fade
    function ocultarPantallaDeCarga() {
      const loader = document.getElementById('loader-wrapper');
      loader.style.display = "none";
      loader.style.opacity = '0'; // Establece la opacidad al 0%
    }
    document.getElementById('btn-notas',).addEventListener('click',function(){
      let url = '{{ asset('') }}';
      let ruta = url+'administrador/checknotas';
      console.log(ruta);
      mostrarPantallaDeCarga();
      fetch(ruta).then(response => {
        if (!response.ok){
          throw new Error('Error en la solicitud');
        }
        return response.json();
      }).then(data => {
        console.log(data);
      }).catch(error=>{
        console.log(error);
      }).finally(()=>{
        ocultarPantallaDeCarga();
      });
    });
    </script>
@stop