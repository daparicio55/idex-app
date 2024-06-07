@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Resultados</h1>
    <small class="text-center d-block">atenciones de enfermería</small>    
</div>
@endsection
@section('page-content')
<div class="row">
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container">
            <x-slot name="header">
                Frecuencia Cardiaca
            </x-slot>
            <x-slot name="description">
                La frecuencia cardíaca es el número de veces que el corazón late por minuto.
            </x-slot>
        </x-highchart-card>
    </div>
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container_fr">
            <x-slot name="header">
                Frecuencia Respiratoria
            </x-slot>
            <x-slot name="description">
                La frecuencia respiratoria es la cantidad de veces que una persona respira por minuto. Es medida para determinar si una persona está respirando de manera normal o si hay algún problema respiratorio.
            </x-slot>
        </x-highchart-card>
    </div>
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container_temperatura">
            <x-slot name="header">
                Temperatura
            </x-slot>
            <x-slot name="description">
                La temperatura se refiere a la medida de la calidad térmica del cuerpo humano. Es un indicador de la salud del cuerpo.
            </x-slot>
        </x-highchart-card>
    </div>
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container_sis">
            <x-slot name="header">
                Presión Arterial (Sistole)
            </x-slot>
            <x-slot name="description">
                Sistole
            </x-slot>
        </x-highchart-card>
    </div>
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container_dia">
            <x-slot name="header">
                Presión Arterial (Diastole)
            </x-slot>
            <x-slot name="description">
                Diastole
            </x-slot>
        </x-highchart-card>
    </div>
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container_saturacion">
            <x-slot name="header">
                Saturación de Oxígeno
            </x-slot>
            <x-slot name="description">
                La saturación de oxígeno es la medida de la cantidad de oxígeno disponible en la sangre.
            </x-slot>
        </x-highchart-card>
    </div>
    <div class="col-lg-6 mb-4">
        <x-highchart-card id="container_imc">
            <x-slot name="header">
                Indice de masa corporal
            </x-slot>
            <x-slot name="description">
                El índice de masa corporal (IMC) es una medida de la relación entre el peso y la altura de una persona.
                @php
                    $imc = 0;
                    if(Auth::user()->hasRole('Bolsa User')){
                        $imc = round(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->nutri_peso / pow(Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->pmedico->nutri_talla/100,2),2);
                    }
                    if(Auth::user()->hasRole('Docentes')){
                        $imc = round(Auth::user()->acampanias[0]->nutri_peso / pow(Auth::user()->acampanias[0]->nutri_talla/100,2),2);
                    }
                @endphp
            </x-slot>
        </x-highchart-card>
    </div>
</div>
@endsection
@section('scripts')
<script>
    //Frecuencia respiratoria
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->vitales_fc ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->vitales_fc ?>],
      @endif
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
//Frecuencia respiratoria
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->vitales_fr ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->vitales_fr ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->vitales_temperatura ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->vitales_temperatura ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->vitales_sys ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->vitales_sys ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->vitales_dia ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->vitales_dia ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->vitales_saturacion ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->vitales_saturacion ?>],
      @endif
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
@endsection