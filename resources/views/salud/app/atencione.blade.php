@extends('layouts.saludcontenido')
@section('css')
<style>
.highcharts-figure,
.highcharts-data-table table {
  min-width: 310px;
  max-width: 500px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-data-table caption {
  padding: 1em 0;
  font-size: 1.2em;
  color: #555;
}

.highcharts-data-table th {
  font-weight: 600;
  padding: 0.5em;
}

.highcharts-data-table td,
.highcharts-data-table th,
.highcharts-data-table caption {
  padding: 0.5em;
}

.highcharts-data-table thead tr,
.highcharts-data-table tr:nth-child(even) {
  background: #f8f8f8;
}

.highcharts-data-table tr:hover {
  background: #f1f7ff;
}
</style>
@stop
@if($estudiante->acampanias->count()>0)
@section('cuerpo')
<div class="main-content flex-1 mt-2 md:mt-2 pb-24 md:pb-5">
    <div class="flex flex-wrap">
      {{-- frecuencia cardiaca --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-red-600">
                        <i class="fas fa-heartbeat"></i> Frecuencia Cardiaca
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container"></div>
                        <p class="highcharts-description mx-5 pb-2">
                            La frecuencia cardíaca es el número de veces que el corazón late por minuto.
                        </p>
                    </figure>
                </div>
            </div>
            <!--/Graph Card-->
        </div>
        {{-- frecuencia respiratoria --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
          <!--Graph Card-->
          <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                  <h5 class="font-bold uppercase text-blue-600">
                    <i class="fas fa-lungs"></i> Frecuencia Respiratoria
                  </h5>
              </div>
              <div class="p-0 chartjs">
                  <figure class="highcharts-figure">
                      <div id="container_fr"></div>
                      <p class="highcharts-description mx-5 pb-2">
                        La frecuencia respiratoria es la cantidad de veces que una persona respira por minuto. Es medida para determinar si una persona está respirando de manera normal o si hay algún problema respiratorio.                       </p>
                  </figure>
              </div>
          </div>
        </div>
          <!--/Graph Card-->
          {{-- temperatura --}}
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-red-600">
                      <i class="fas fa-thermometer-half"></i> Temperatura
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_temperatura"></div>
                        <p class="highcharts-description mx-5 pb-2">
                          La temperatura se refiere a la medida de la calidad térmica del cuerpo humano. Es un indicador de la salud del cuerpo</p>
                    </figure>
                </div>
            </div>
          </div>
            <!--/Graph Card-->
            {{-- systole --}}
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-blue-600">
                      <i class="fas fa-water"></i> Presión Arterial (Sis - Dia)
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_sis"></div>                        
                    </figure>
                </div>
                <div class="p-0 chartjs">
                  <figure class="highcharts-figure">
                      <div id="container_dia"></div>                        
                  </figure>
              </div>
            </div>
          </div>

          {{-- saturacion de oxigeno --}}


          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-blue-600">
                      <i class="fab fa-skyatlas"></i> Saturacion de Oxigeno
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_saturacion"></div>
                        <p class="highcharts-description mx-5 pb-2">
                          La saturación de oxígeno es la medida de la cantidad de oxígeno disponible en la sangre.
                        </p>
                    </figure>
                </div>
            </div>
          </div>

          {{-- informacion indice de maza corporal --}}
          <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-green-600">
                      <i class="fas fa-balance-scale"></i> Indice de Masa Corporal
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_imc"></div>
                        <p class="highcharts-description mx-5 pb-2">
                          El índice de masa corporal (IMC) es una medida de la relación entre el peso y la altura de una persona.
                        </p>
                        @php
                            $imc = round($estudiante->acampanias[0]->nutri_peso / (($estudiante->pmedico->nutri_talla)/100 * ($estudiante->pmedico->nutri_talla)/100),1);
                            $imc = str_replace(',','.',$imc);
                        @endphp
                    </figure>
                </div>
            </div>
          </div>
      </div>
    </div>
</div>
@stop
@section('js')
<script>
    Highcharts.chart("container", {
    chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: ""
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 0,
    max: 200,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 0,
        to: 60,
        color: "#DDDF0D", // green
        thickness: 20
      },
      {
        from: 61,
        to: 100,
        color: "#55BF3B", // yellow
        thickness: 20
      },
      {
        from: 101,
        to: 200,
        color: "#DDDF0D", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->vitales_fc ?>],
      tooltip: {
        valueSuffix: " lat/min."
      },
      dataLabels: {
        format: "{y} lat/min.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "blue",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});

Highcharts.chart("container_fr", {
  chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: ""
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 0,
    max: 30,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 0,
        to: 12,
        color: "#DDDF0D", // green
        thickness: 20
      },
      {
        from: 12,
        to: 25,
        color: "#55BF3B", // yellow
        thickness: 20
      },
      {
        from: 25,
        to: 30,
        color: "#DDDF0D", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->vitales_fr ?>],
      tooltip: {
        valueSuffix: " lat/min."
      },
      dataLabels: {
        format: "{y} lat/min.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "blue",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});

//temperatura
Highcharts.chart("container_temperatura", {
    chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: ""
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 20,
    max: 60,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 20,
        to: 35,
        color: "#170ddf", // azul
        thickness: 20
      },
      {
        from: 35,
        to: 41,
        color: "#55BF3B", // greem
        thickness: 20
      },
      {
        from: 41,
        to: 60,
        color: "#df0d0d", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->vitales_temperatura ?>],
      tooltip: {
        valueSuffix: " grados Centigrados."
      },
      dataLabels: {
        format: "{y} grados Centigrados.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "blue",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});


//sistolica
Highcharts.chart("container_sis", {
    chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: "Sistólica"
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 65,
    max: 200,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 65,
        to: 90,
        color: "#FF7F50", // azul
        thickness: 20
      },
      {
        from: 90,
        to: 110,
        color: "#008B8B", // greem
        thickness: 20
      },
      {
        from: 110,
        to: 130,
        color: "#006400", // red
        thickness: 20
      },
      {
        from: 130,
        to: 140,
        color: "#df0d0d", // red
        thickness: 20
      },
      {
        from: 140,
        to: 160,
        color: "#df0d0d", // red
        thickness: 20
      },
      {
        from: 160,
        to: 180,
        color: "#DC143C", // red
        thickness: 20
      },
      {
        from: 180,
        to: 200,
        color: "#8B0000", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->vitales_sys ?>],
      tooltip: {
        valueSuffix: " mmHg."
      },
      dataLabels: {
        format: "{y} mmHg.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "green",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});




//diastolica
Highcharts.chart("container_dia", {
    chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: "Diastólica"
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 35,
    max: 140,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 35,
        to: 60,
        color: "#FF7F50", // azul
        thickness: 20
      },
      {
        from: 60,
        to: 80,
        color: "#008B8B", // greem
        thickness: 20
      },
      {
        from: 80,
        to: 85,
        color: "#006400", // red
        thickness: 20
      },
      {
        from: 85,
        to: 89,
        color: "#df0d0d", // red
        thickness: 20
      },
      {
        from: 90,
        to: 100,
        color: "#df0d0d", // red
        thickness: 20
      },
      {
        from: 100,
        to: 110,
        color: "#DC143C", // red
        thickness: 20
      },
      {
        from: 110,
        to: 140,
        color: "#8B0000", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->vitales_dia ?>],
      tooltip: {
        valueSuffix: " mmHg."
      },
      dataLabels: {
        format: "{y} mmHg.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "green",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});

/* saturacion de oxigeno */
Highcharts.chart("container_saturacion", {
    chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: ""
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 70,
    max: 100,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 70,
        to: 85,
        color: "#df0d0d", // azul
        thickness: 20
      },
      {
        from: 85,
        to: 90,
        color: "#FF5733", // greem
        thickness: 20
      },
      {
        from: 90,
        to: 94,
        color: "#F5DA81", // red
        thickness: 20
      },
      {
        from: 94,
        to: 100,
        color: "#008000", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->vitales_saturacion ?>],
      tooltip: {
        valueSuffix: " %."
      },
      dataLabels: {
        format: "{y} %.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "blue",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});


/* INDICE DE MASA CORPORAL */

Highcharts.chart("container_imc", {
    chart: {
    type: "gauge",
    plotBackgroundColor: null,
    plotBackgroundImage: null,
    plotBorderWidth: 0,
    plotShadow: false,
    height: "80%",
  },
  exporting: {
    enabled: false
  },
  title: {
    text: ""
  },
  credits: {
    enabled: false
  },
  pane: {
    startAngle: -90,
    endAngle: 89.9,
    background: null,
    center: ["50%", "75%"],
    size: "110%"
  },
  
  // the value axis
  yAxis: {
    min: 10,
    max: 40,
    tickPixelInterval: 72,
    tickPosition: "inside",
    tickColor: Highcharts.defaultOptions.chart.backgroundColor || "#102045",
    tickLength: 20,
    tickWidth: 2,
    minorTickInterval: null,
    labels: {
      distance: 20,
      style: {
        fontSize: "14px"
      }
    },
    plotBands: [
      {
        from: 10,
        to: 18.5,
        color: "#FE2E2E", 
        thickness: 20
      },
      {
        from: 18.6,
        to: 24.9,
        color: "#04B431", 
        thickness: 20
      },
      {
        from: 25,
        to: 29.9,
        color: "#DF7401", 
        thickness: 20
      },
      {
        from: 30,
        to: 40,
        color: "#FF0000", 
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $imc ?>],
      tooltip: {
        valueSuffix: " %."
      },
      dataLabels: {
        format: "{y} %.",
        borderWidth: 0,
        color:
          (Highcharts.defaultOptions.title &&
            Highcharts.defaultOptions.title.style &&
            Highcharts.defaultOptions.title.style.color) ||
          "#333333",
        style: {
          fontSize: "16px"
        }
      },
      dial: {
        radius: "80%",
        backgroundColor: "blue",
        baseWidth: 12,
        baseLength: "0%",
        rearLength: "0%"
      },
      pivot: {
        backgroundColor: "black",
        radius: 6
      }
    }
  ]
});
</script>
@stop
@endif