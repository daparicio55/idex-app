<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tailwind Admin Starter Template : Tailwind Toolbox</title>
    <meta name="author" content="name">
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords,here">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/tailwind/css/tailwind.min.css') }}">
    <link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">
    <script src="{{ asset('vendor/chars/highcharts.js') }}"></script>
    <script src="{{ asset('vendor/chars/highcharts-more.js') }}"></script>
    @yield('css')
</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12">
<header>
    <!--Nav-->
    <nav aria-label="menu nav" class="bg-gray-800 pt-2 md:pt-1 pb-1 px-1 mt-0 h-auto fixed w-full z-20 top-0">
        <div class="flex flex-wrap items-center">
            <div class="flex flex-1 md:w-1/3 justify-center md:justify-start text-white px-2">
                <span class="relative w-full">
                        <label style="display: block; font-size: 1.6rem" class="w-full bg-gray-900 text-white transition border border-transparent focus:outline-none focus:border-gray-400 rounded py-3 px-2 pl-10 appearance-none leading-normal">I.E.S.T.P. Perú Japón</label>
                    <div class="absolute search-icon" style="top: 1.2rem; left: .8rem;">
                        {!! Form::open(['route'=>'salud.app.store','method'=>'post']) !!}
                            <input type="hidden" name="dni" value={{ $estudiante->postulante->cliente->dniRuc }}>
                            <input type="hidden" name="fecha" value="{{ $estudiante->postulante->fechaNacimiento }}">
                            <button type="submit">
                                <i class="fas fa-house-user fill-current pointer-events-none text-white w-4 h-4"></i>
                               {{--  <img class="fill-current pointer-events-none text-white w-4 h-4" src="{{ asset('img/logoapp.png') }}"  alt=""> --}}
                            </button>
                        {!! Form::close() !!}
                    </div>
                </span>
            </div>
            @yield('menu')
        </div>
    </nav>
</header>

<main>
    <div class="flex flex-col md:flex-row">
        <nav aria-label="alternative nav">
            <div class="bg-gray-800 shadow-xl h-20 fixed bottom-0 mt-12 md:relative md:h-screen z-10 w-full md:w-48 content-center">
                <div class="md:mt-12 md:w-48 md:fixed md:left-0 md:top-0 content-center md:content-start text-left justify-between">
                    <ul class="list-reset flex flex-row md:flex-col pt-3 md:py-3 px-1 md:px-2 text-center md:text-left">
                        <li class="mr-3 flex-1">
                            <a href="{{ route('salud.app.atencione',$estudiante->id) }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-pink-500">
                                <i class="fas fa-user-md fa-2x pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Atenciones</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                                <i class="fas fa-syringe fa-2x pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Vacuna</span>
                            </a>
                        </li>
                        {{-- <li class="mr-3 flex-1">
                            <a href="#" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-blue-600">
                                <i class="fas fa-vials fa-2x pr-0 md:pr-3 text-blue-600"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-white md:text-white block md:inline-block">Resultados</span>
                            </a>
                        </li> --}}
                        <li class="mr-3 flex-1">
                            <a href="{{ route('salud.app.resultados',$estudiante->id) }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                                <i class="fas fa-vials fa-2x pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Resultados</span>
                            </a>
                        </li>
                        <li class="mr-3 flex-1">
                            <a href="{{ route('salud.app.encuestas',$estudiante->id) }}" class="block py-1 md:py-3 pl-0 md:pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-red-500">
                                <i class="far fa-list-alt fa-2x pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Encuesta</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <section>
            @yield('cuerpo')
        </section>
    </div>
</main>
@yield('js')

<script>
    /*Toggle dropdown list*/
    function toggleDD(myDropMenu) {
        document.getElementById(myDropMenu).classList.toggle("invisible");
    }
    /*Filter dropdown options*/
    function filterDD(myDropMenu, myDropMenuSearch) {
        var input, filter, ul, li, a, i;
        input = document.getElementById(myDropMenuSearch);
        filter = input.value.toUpperCase();
        div = document.getElementById(myDropMenu);
        a = div.getElementsByTagName("a");
        for (i = 0; i < a.length; i++) {
            if (a[i].innerHTML.toUpperCase().indexOf(filter) > -1) {
                a[i].style.display = "";
            } else {
                a[i].style.display = "none";
            }
        }
    }
    // Close the dropdown menu if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches('.drop-button') && !event.target.matches('.drop-search')) {
            var dropdowns = document.getElementsByClassName("dropdownlist");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (!openDropdown.classList.contains('invisible')) {
                    openDropdown.classList.add('invisible');
                }
            }
        }
    }
</script>
</body>
</html>





















{{-- @extends('layouts.saludapp')
@section('titulo','Salud APP')
@section('css') --}}
{{-- <style>
    .form-control-dark {
    border-color: var(--bs-gray);
    }
    .form-control-dark:focus {
    border-color: #fff;
    box-shadow: 0 0 0 .25rem rgba(255, 255, 255, .25);
    }
    .text-small {
    font-size: 85%;
    }
    .dropdown-toggle {
    outline: 0;
    }
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
      footer{
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
      }
     
</style> --}}
{{-- @stop
@section('contenido') --}}
    {{-- <header class="py-2 bg-primary mb-3 border-bottom">
        <div class="container-fluid d-grid gap-3 align-items-center" style="grid-template-columns: 1fr 2fr;">
          <div class="dropdown">
            <a href="#" class="text-white d-flex align-items-center col-lg-4 mb-2 mb-lg-0 link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-sliders-h fa-2x"></i>
            </a>
            <ul class="dropdown-menu shadow" style="">
              <li><a class="dropdown-item" href="{{ route('salud.app.atencione',$estudiante->id) }}">Atenciones</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Customers</a></li>
              <li><a class="dropdown-item" href="#">Products</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="#">Reports</a></li>
              <li><a class="dropdown-item" href="#">Analytics</a></li>
            </ul>
          </div>
    
          <div class="d-flex align-items-center">
            <form class="w-100 me-3" role="search">
              
            </form>
            <div class="flex-shrink-0 dropdown">
              <a href="#" class="w-100 d-block link-dark text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                <b class="text-white">{{ $estudiante->postulante->cliente->apellido }}</b> <img src="{{ Storage::url($estudiante->postulante->url) }}" alt="mdo" width="45" height="45" class="rounded-circle"> 
              </a>
              <ul class="dropdown-menu text-small shadow" style="">
                <li><a class="dropdown-item" href="{{ route('salud.app.profile',$estudiante->id) }}"><i class="fas fa-user-tag"></i> Perfil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="{{ route('salud.app.index') }}"><i class="fas fa-sign-out-alt"></i> Cerrar</a></li>
              </ul>
            </div>
          </div>
        </div>
    </header>     
    <main>
        <div class="container">
            @yield('cuerpo')
        </div>
    </main> --}}
{{-- @stop --}}