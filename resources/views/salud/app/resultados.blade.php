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
                        <i class="fas fa-heartbeat"></i> Glucosa
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_glicemia"></div>
                        <p class="highcharts-description mx-5 pb-2">
                            Cantidad de un azúcar llamado glucosa en una muestra de sangre.
                        </p>
                    </figure>
                </div>
            </div>
            <!--Graph Card-->
        </div>
        {{-- frecuencia cardiaca --}}
        {{-- tiglicerios --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-red-600">
                        <i class="fas fa-heartbeat"></i> Triglicéridos
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-trigliceridos">
                        <div id="container_trigliceridos"></div>
                        <p class="highcharts-description mx-5 pb-2">
                            Los triglicéridos son un tipo de grasa (lípidos) que se encuentran en la sangre.
                        </p>
                    </figure>
                </div>
            </div>
            <!--Graph Card-->
        </div>
        {{-- triglicerios --}}
        {{-- colesterol --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-red-600">
                        <i class="fas fa-heartbeat"></i> Colesterol
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_colesterol"></div>
                        <p class="highcharts-description mx-5 pb-2">
                            El colesterol es una sustancia cerosa que se encuentra en la sangre.
                        </p>
                    </figure>
                </div>
            </div>
            <!--Graph Card-->
        </div>
        {{-- colesterol --}}
        {{-- HDL --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
          <!--Graph Card-->
          <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                  <h5 class="font-bold uppercase text-red-600">
                      <i class="fas fa-heartbeat"></i> HDL - Colesterol Positivo
                  </h5>
              </div>
              <div class="p-0 chartjs">
                  <figure class="highcharts-figure">
                      <div id="container_hdl"></div>
                      <p class="highcharts-description mx-5 pb-2">
                        El colesterol de lipoproteínas de alta densidad (HDL) es conocido como el colesterol "bueno" porque ayuda a eliminar otras formas de colesterol del torrente sanguíneo. Los niveles más altos de colesterol HDL están asociados con un menor riesgo de desarrollar una enfermedad cardíaca..
                      </p>
                  </figure>
              </div>
          </div>
          <!--Graph Card-->
        </div>
        {{-- HDL --}}
        {{-- LDL --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
          <!--Graph Card-->
          <div class="bg-white border-transparent rounded-lg shadow-xl">
              <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                  <h5 class="font-bold uppercase text-red-600">
                      <i class="fas fa-heartbeat"></i> LDL - Colesterol Negativo
                  </h5>
              </div>
              <div class="p-0 chartjs">
                  <figure class="highcharts-figure">
                      <div id="container_ldl"></div>
                      <p class="highcharts-description mx-5 pb-2">
                        LDL significa lipoproteínas de baja densidad en inglés. En ocasiones se le llama colesterol "malo" porque un nivel alto de LDL lleva a una acumulación de colesterol en las arteria.
                      </p>
                  </figure>
              </div>
          </div>
          <!--Graph Card-->
        </div>


        {{-- LDL --}}
        {{-- hemoglobina --}}
        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-red-600">
                        <i class="fas fa-heartbeat"></i> Hemoglobina
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_hemoglobina"></div>
                        <p class="highcharts-description mx-5 pb-2">
                            Proteína del interior de los glóbulos rojos que transporta oxígeno desde los pulmones a los tejidos y órganos del cuerpo; además, transporta el dióxido de carbono de vuelta a los pulmones.
                        </p>
                    </figure>
                </div>
            </div>
            <!--Graph Card-->
        </div>
        {{-- hemoglobina --}}
        {{-- hematocrito --}}

        <div class="w-full md:w-1/2 xl:w-1/3 p-6">
            <!--Graph Card-->
            <div class="bg-white border-transparent rounded-lg shadow-xl">
                <div class="bg-gradient-to-b from-gray-300 to-gray-100 uppercase text-gray-800 border-b-2 border-gray-300 rounded-tl-lg rounded-tr-lg p-2">
                    <h5 class="font-bold uppercase text-red-600">
                        <i class="fas fa-heartbeat"></i> Hematocrito
                    </h5>
                </div>
                <div class="p-0 chartjs">
                    <figure class="highcharts-figure">
                        <div id="container_hto"></div>
                        <p class="highcharts-description mx-5 pb-2">
                            El hematocrito es un análisis de sangre que permite detectar anemia y otros trastornos de la sangre.
                        </p>
                    </figure>
                </div>
            </div>
            <!--Graph Card-->
        </div>

        {{-- hematocrito --}}

    </div>
</div>
@stop
@section('js')
<script>
/* frecuencia cardiaca */
Highcharts.chart("container_glicemia", {
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
    min: 60,
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
        from: 60,
        to: 110,
        color: "green", // green
        thickness: 20
      },
      {
        from: 110,
        to: 130,
        color: "yellow", // yellow
        thickness: 20
      },
      {
        from: 130,
        to: 200,
        color: "red", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_glicemia ?>],
      tooltip: {
        valueSuffix: " mg/dl."
      },
      dataLabels: {
        format: "{y} mg/dl.",
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

/* trigliceridos */
Highcharts.chart("container_trigliceridos", {
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
    min: 15,
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
        from: 15,
        to: 150,
        color: "green", // green
        thickness: 20
      },
      {
        from: 150,
        to: 250,
        color: "yellow", // yellow
        thickness: 20
      },
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_trigliceridos ?>],
      tooltip: {
        valueSuffix: " mg/dl."
      },
      dataLabels: {
        format: "{y} mg/dl.",
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

/* colesterol */

Highcharts.chart("container_colesterol", {
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
    max: 400,
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
        to: 200,
        color: "green", // green
        thickness: 20
      },
      {
        from: 200,
        to: 400,
        color: "yellow", // yellow
        thickness: 20
      },
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_colesterol ?>],
      tooltip: {
        valueSuffix: " mg/dl."
      },
      dataLabels: {
        format: "{y} mg/dl.",
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

/* HDL */
Highcharts.chart("container_ldl", {
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
    max: 300,
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
        to: 129,
        color: "red", // green
        thickness: 20
      },
      {
        from: 129,
        to: 300,
        color: "green", // yellow
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_ldl ?>],
      tooltip: {
        valueSuffix: " mg/dl."
      },
      dataLabels: {
        format: "{y} mg/dl.",
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
/* ******************************* */
/* LDL */

Highcharts.chart("container_hdl", {
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
        from: 0,
        to: 40,
        color: "red", // green
        thickness: 20
      },
      {
        from: 40,
        to: 60,
        color: "green", // yellow
        thickness: 20
      },
      {
        from: 60,
        to: 100,
        color: "red", // red
        thickness: 20
      }
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_hdl ?>],
      tooltip: {
        valueSuffix: " mg/dl."
      },
      dataLabels: {
        format: "{y} mg/dl.",
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



/* ************************************ */













/* hemoglobina */


Highcharts.chart("container_hto", {
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
        from: 0,
        to: 30,
        color: "red", // green
        thickness: 20
      },
      {
        from: 30,
        to: 50,
        color: "green", // yellow
        thickness: 20
      },
      {
        from: 50,
        to: 100,
        color: "red", // yellow
        thickness: 20
      },
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_hto ?>],
      tooltip: {
        valueSuffix: " %"
      },
      dataLabels: {
        format: "{y} %",
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


/* HTO */
Highcharts.chart("container_hemoglobina", {
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
        to: 11.6,
        color: "red", // green
        thickness: 20
      },
      {
        from: 11.6,
        to: 18,
        color: "green", // yellow
        thickness: 20
      },
      {
        from: 18,
        to: 30,
        color: "red", // yellow
        thickness: 20
      },
    ]
  },

  series: [
    {
      name: "Speed",
      data: [<?= $estudiante->acampanias[0]->lab_hemoglobina ?>],
      tooltip: {
        valueSuffix: " mg/dl."
      },
      dataLabels: {
        format: "{y} mg/dl.",
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