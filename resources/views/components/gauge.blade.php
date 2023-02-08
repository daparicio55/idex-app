<div>
    <!-- estilos css -->
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
    @php
        $obj = json_decode($datos);
    @endphp
    {{-- html del componente --}}
    <figure class="highcharts-figure">
        <div id="container_{{ $obj->name }}"></div>
        <p class="highcharts-description mx-5 pb-2">
        </p>
    </figure>


    {{-- java --}}
<script>
    Highcharts.chart(<?= 'container_'.$obj->name ?>, {
    chart: {
        type: 'gauge',
        plotBackgroundColor: null,
        plotBackgroundImage: null,
        plotBorderWidth: 0,
        plotShadow: false,
        height: '80%'
    },

title: {
    text: <?="'".$obj->title_text."'" ?>
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
    min: <?= $obj->min ?>,
    max: <?= $obj->max ?>,
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
    plotBands: <?= $plotBands ?>,
},

series: [{
    name: <?="'".$obj->serie_name."'" ?>,
    data: [<?= $obj->points ?>],
    tooltip: {
        valueSuffix: <?="'".$obj->sufix."'" ?>
    },
    dataLabels: {
        format:  <?="'{y} ".$obj->sufix."'" ?>,
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




</script>
</div>