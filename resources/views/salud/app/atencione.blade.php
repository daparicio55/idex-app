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
@section('cuerpo')
<div class="main-content flex-1 mt-2 md:mt-2 pb-24 md:pb-5">
    <div class="flex flex-wrap">
        
        

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
    </div>
</div>
@stop
@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
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

// Add some life
/* setInterval(() => {
  const chart = Highcharts.charts[0];
  if (chart && !chart.renderer.forExport) {
    const point = chart.series[0].points[0],
      inc = Math.round((Math.random() - 0.5) * 20);

    let newVal = point.y + inc;
    if (newVal < 0 || newVal > 200) {
      newVal = point.y - inc;
    }

    point.update(newVal);
  }
}, 3000); */
</script>
@stop