@extends('layouts.saludcontenido')
@section('menu')
<div class="flex w-full pt-2 content-center justify-between md:w-1/3 md:justify-end">
    <ul class="list-reset flex justify-between flex-1 md:flex-none items-center">
        <li class="flex-1 md:flex-none md:mr-3">
            <div class="relative inline-block">
                <button onclick="toggleDD('myDropdown')" class="drop-button text-white py-2 px-2"> <span class="pr-2"><i class="fas fa-users fa-2x"></i></span> Hola, {{ $estudiante->postulante->cliente->nombre }}</button>
                <div id="myDropdown" class="dropdownlist absolute bg-gray-800 text-white right-0 mt-3 p-3 overflow-auto z-30 invisible">
                    <a href="{{ route('salud.app.profile',$estudiante->id) }}" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fa fa-user fa-fw fa-2x"></i> Perfil</a>
                    <a href="https://carnetvacunacion.minsa.gob.pe/" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-syringe fa-2x"></i> Vacunas</a>
                    <a href="{{ route('salud.app.herramientas',$estudiante->id) }}" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-balance-scale fa-2x"></i> Herramientas</a>
                    <div class="border border-gray-800"></div>
                    <a href="{{ route('salud.app.index') }}" class="p-2 hover:bg-gray-800 text-white text-sm no-underline hover:no-underline block"><i class="fas fa-sign-out-alt fa-fw fa-2x"></i> Cerrar</a>
                </div>
            </div>
        </li>
    </ul>
</div>
@stop
@section('cuerpo')
<div id="main" class="main-content flex-1 bg-gray-100 mt-12 md:mt-2 pb-24 md:pb-5">
    
    {{-- datos del alumno --}}
    <div class="bg-gray-800 pt-14">
        <div class="rounded-tl-3xl bg-gradient-to-r from-blue-900 to-gray-800 p-4 shadow text-2xl text-white">
            <h5 class="font-bold pl-2">Balanza IMC</h5>
        </div>
    </div>
    <div class="flex flex-wrap">                    
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
          
            <div class="mb-12">
                <label for="large-input" class="block text-lg text-gray-900 dark:text-white">Peso</label>
                <input type="number" id="txt_peso" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
            </div>
            <div class="mb-12">
                <label for="default-input" class="block text-lg text-gray-900 dark:text-white">Talla en centímetros</label>
                <input type="number" id="txt_talla" class="block w-full p-4 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 sm:text-md focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
            </div>
            <button id="btn_calcular" type="button" class="text-white bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">calcular</button>
            

            <div class="p-0 chartjs">
                <figure class="highcharts-figure">
                    <div id="container"></div>
                </figure>
            </div>

            <script>
                let btn_calcular = document.getElementById('btn_calcular');
                btn_calcular.addEventListener('click',function(){
                    let talla = document.getElementById('txt_talla');
                    let peso = document.getElementById('txt_peso');
                    let imc = peso.value / ((talla.value/100) * (talla.value/100));
                    imc = parseFloat(imc.toFixed(2));
                    Highcharts.chart('container', {
                    chart: {
                        type: 'gauge',
                        plotBackgroundColor: null,
                        plotBackgroundImage: null,
                        plotBorderWidth: 0,
                        plotShadow: false,
                        height: '80%'
                    },
                    title: {
                        text: 'Balanza IMC'
                    },
                    pane: {
                        startAngle: -90,
                        endAngle: 89.9,
                        background: null,
                        center: ['50%', '75%'],
                        size: '110%'
                    },
                    // the value axis
                    yAxis: {
                        min: 0,
                        max: 40,
                        tickPixelInterval: 72,
                        tickPosition: 'inside',
                        tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                        tickLength: 20,
                        tickWidth: 2,
                        minorTickInterval: null,
                        labels: {
                            distance: 20,
                            style: {
                                fontSize: '14px'
                            }
                        },
                        plotBands: [{
                            from: 0,
                            to: 10,
                            color: '#DF5353', // green #55BF3B
                            thickness: 20
                        },{
                            from: 10,
                            to: 18,
                            color: '#DDDF0D',
                            thickness: 20
                        },{
                            from: 18,
                            to: 25,
                            color: '#55BF3B',
                            thickness: 20
                        },{
                            from: 25,
                            to: 30,
                            color: '#DDDF0D',
                            thickness: 20
                        }, {
                            from: 30,
                            to: 40,
                            color: '#DF5353', // yellow #DDDF0D
                            thickness: 20
                        }]
                    },
                    series: [{
                        name: 'Speed',
                        data: [imc],
                        tooltip: {
                            valueSuffix: ' %'
                        },
                        dataLabels: {
                            format: '{y} %',
                            borderWidth: 0,
                            color: (
                                Highcharts.defaultOptions.title &&
                                Highcharts.defaultOptions.title.style &&
                                Highcharts.defaultOptions.title.style.color
                            ) || '#333333',
                            style: {
                                fontSize: '16px'
                            }
                        },
                        dial: {
                            radius: '80%',
                            backgroundColor: 'gray',
                            baseWidth: 12,
                            baseLength: '0%',
                            rearLength: '0%'
                        },
                        pivot: {
                            backgroundColor: 'gray',
                            radius: 6
                        }
                    }]
                    });



                });
                
            </script>
            <!--/Metric Card-->
        </div>
    </div>
</div>
@stop