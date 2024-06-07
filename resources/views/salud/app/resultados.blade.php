@extends('salud.app.v2.layouts.main')
@section('page-header')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 text-center">Resultados</h1>
    <small class="text-center d-block">análisis de laboratorio</small>    
</div>
@endsection
@section('page-content')
<div class="row">
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_glicemia">
        <x-slot name="header">
          Glucosa
        </x-slot>
        <x-slot name="description">
          Cantidad de un azúcar llamado glucosa en una muestra de sangre.
        </x-slot>
    </x-highchart-card>
  </div>
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_trigliceridos">
        <x-slot name="header">
          Triglicéridos
        </x-slot>
        <x-slot name="description">
          Los triglicéridos son un tipo de grasa (lípidos) que se encuentran en la sangre.
        </x-slot>
    </x-highchart-card>
  </div>
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_colesterol">
        <x-slot name="header">
          Colesterol
        </x-slot>
        <x-slot name="description">
          El colesterol es una sustancia cerosa que se encuentra en la sangre.
        </x-slot>
    </x-highchart-card>
  </div>
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_hdl">
        <x-slot name="header">
          HDL - Colesterol Positivo
        </x-slot>
        <x-slot name="description">
          El colesterol de lipoproteínas de alta densidad (HDL) es conocido como el colesterol "bueno" porque ayuda a eliminar otras formas de colesterol del torrente sanguíneo. Los niveles más altos de colesterol HDL están asociados con un menor riesgo de desarrollar una enfermedad cardíaca..
        </x-slot>
    </x-highchart-card>
  </div>
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_ldl">
        <x-slot name="header">
          LDL - Colesterol Negativo
        </x-slot>
        <x-slot name="description">
          LDL significa lipoproteínas de baja densidad en inglés. En ocasiones se le llama colesterol "malo" porque un nivel alto de LDL lleva a una acumulación de colesterol en las arteria.
        </x-slot>
    </x-highchart-card>
  </div>
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_hemoglobina">
        <x-slot name="header">
          Hemoglobina
        </x-slot>
        <x-slot name="description">
          Proteína del interior de los glóbulos rojos que transporta oxígeno desde los pulmones a los tejidos y órganos del cuerpo; además, transporta el dióxido de carbono de vuelta a los pulmones.
        </x-slot>
    </x-highchart-card>
  </div>
  <div class="col-lg-6 mb-4">
    <x-highchart-card id="container_hto">
        <x-slot name="header">
          Hematocrito
        </x-slot>
        <x-slot name="description">
          El hematocrito es un análisis de sangre que permite detectar anemia y otros trastornos de la sangre.
        </x-slot>
    </x-highchart-card>
  </div>
</div>
@endsection
@section('scripts')
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_glicemia ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_glicemia ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_trigliceridos ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_trigliceridos ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_colesterol ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_colesterol ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_ldl ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_ldl ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_hdl ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_hdl ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_hto ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_hto ?>],
      @endif
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
      @if(Auth::user()->hasRole('Bolsa User'))
        data: [<?= Auth::user()->ucliente->cliente->postulaciones[0]->estudiante->acampanias[0]->lab_hemoglobina ?>],
      @endif
      @if(Auth::user()->hasRole('Docentes'))
        data: [<?= Auth::user()->acampanias[0]->lab_hemoglobina ?>],
      @endif
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
@endsection