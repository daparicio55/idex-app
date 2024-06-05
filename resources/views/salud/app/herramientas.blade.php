@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Balanza IMC</h1>
    <small class="text-center d-block">calcula tu indice de masa corporal</small>
</div>
@endsection
@section('page-content')
<div class="row">
    <div class="col-lg-6 mb-4">
        <div class="card shadow mb-2 border-left-danger">
            <div class="card-body">
                <div class="form-group">
                    <label>Peso (en kilos)</label>
                    <input type="number" class="form-control" id="txt_peso">
                    <label class="mt-2">Talla (en centímetros)</label>
                    <input type="number" class="form-control" id="txt_talla">
                    <button class="btn btn-success btn-icon-split mt-4" id="btn_calcular">
                        <span class="icon text-white-50">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text">Calcular</span>
                    </button>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p id='estado' style="text-align: center"></p>
                    </figure>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    let btn_calcular = document.getElementById('btn_calcular');
                btn_calcular.addEventListener('click',function(){
                    let talla = document.getElementById('txt_talla');
                    let peso = document.getElementById('txt_peso');
                    let imc = peso.value / ((talla.value/100) * (talla.value/100));
                    imc = parseFloat(imc.toFixed(2));
                    let estado = document.getElementById('estado');
                    //estado.innerHTML="aca estamos";
                    if (imc < 18.5){
                        estado.innerHTML="Bajo Peso";
                    }else{
                        if (imc < 24.9){
                            estado.innerHTML="Adecuado";
                        }else{
                            if (imc < 29.9){
                                estado.innerHTML="Sobre Peso";
                            }else{
                                if (imc < 34.9){
                                    estado.innerHTML="Obesidad grado 1";
                                }else{
                                    if (imc < 39.9){
                                        estado.innerHTML="Obesidad grado 2";
                                    }else{
                                        estado.innerHTML="Obesidad grado 3";
                                    }
                                }
                            }
                        }
                    }
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
                        text: 'Resultado IMC',
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
@endsection