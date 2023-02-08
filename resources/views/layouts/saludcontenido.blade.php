<div class="spinner-container" id="loader">
    <div class="loader"></div>
</div>
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
    <style>
        .loader {
          border: 16px solid #f3f3f3;
          border-radius: 50%;
          border-top: 16px solid #3498db;
          width: 120px;
          height: 120px;
          -webkit-animation: spin 2s linear infinite; /* Safari */
          animation: spin 2s linear infinite;
        }
        .spinner-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
    </style>
    @yield('css')
</head>

<body class="bg-gray-800 font-sans leading-normal tracking-normal mt-12" onload="myFunction()">
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
                            <a href="{{ route('salud.app.psicologia',$estudiante->id) }}" class="block py-1 md:py-3 pl-1 align-middle text-white no-underline hover:text-white border-b-2 border-gray-800 hover:border-purple-500">
                                <i class="fas fa-brain fa-2x pr-0 md:pr-3"></i><span class="pb-1 md:pb-0 text-xs md:text-base text-gray-400 md:text-gray-200 block md:inline-block">Psicología</span>
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
    function myFunction() {
        document.getElementById("loader").style.display = "none";
    }
</script>
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