@extends('salud.app.v2.layouts.main')
@section('page-content')
<div class="row">
    <div class="col-lg-6 mb-1">
        <x-highchart-card id="nota">
            <x-slot name="header">
                <a href="{{ route('salud.app.matriculas.index') }}" class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-long-arrow-alt-left"></i>
                </a>
                {{ $detalle->unidad->nombre }}
            </x-slot>
            <x-slot name="description">
                <p class="text-center">
                    {{ $detalle->tipo }}
                </p>
            </x-slot>
        </x-highchart-card>
        @php
            $uasignada = \App\Models\Uasignada::where('pmatricula_id','=',$detalle->matricula->pmatricula_id)
            ->where('udidactica_id','=',$detalle->udidactica_id)
            ->first();
        @endphp
        <div class="table-responsive mt-2">
            <table class="table mb-0" style="font-size: 0.8rem">
                <tbody>
                    @if (isset($uasignada->capacidades))
                        @foreach ($uasignada->capacidades as $key => $capacidade)
                            <tr class="bg-primary">
                                <td class="text-white d-flex justify-content-between">
                                    <span>
                                        CAPACIDAD {{ $key + 1 }}
                                    </span>
                                    <span>
                                        @if(isset($capacidade->fecha))
                                            {{ date('d-m-Y',strtotime($capacidade->fecha)) }}
                                        @else
                                            <span class="text-danger">No registrado</span>
                                        @endif
                                        
                                    </span>
                                    <span class="{{ caNota($capacidade->id,$detalle->id)['color'] }} bg-white p-2 font-weight-bold rounded-circle">
                                        {{ cero(caNota($capacidade->id,$detalle->id)['nota']) }}
                                    </span>
                                </td>
                            </tr>
                            @foreach ($capacidade->indicadores as $k => $indicadore)
                                <tr>
                                    <td class="d-flex justify-content-between p-1">
                                        <span>
                                            Indicador {{ $k + 1 }}
                                        </span>
                                        <span>
                                            @if(isset($indicadore->fecha))
                                                {{ date('d-m-Y',strtotime($indicadore->fecha)) }}
                                            @else
                                                <span class="text-danger">No registrado</span>
                                            @endif
                                            
                                        </span>
                                        <span class="{{ inNota($indicadore->id,$detalle->id)['color'] }} bg-white p-1 rounded-circle">
                                            {{ inNota($indicadore->id,$detalle->id)['nota'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 mb-5">
        <div id="asistencias" class="mb-5">
            <div class="card mt-2">
                <div class="card-header p-2" id="heading-{{ $detalle->id }}">
                    <h5 class="mb-0">
                      <button type="button" class="btn btn-link p-0 text-center w-100" data-toggle="collapse" data-target="#collapse-{{ $detalle->id }}" aria-expanded="true" aria-controls="#collapse-{{ $detalle->id }}">
                        <i class="fas fa-user"></i> Asistencias
                      </button>
                    </h5>
                </div>
                <div id="collapse-{{ $detalle->id }}" class="collapse" aria-labelledby="heading-{{ $detalle->id }}" data-parent="#asistencias">
                    <div class="card-body d-flex">
                        <div class="row">
                            @foreach ($fdias as $fdia)
                                @php
                                    $estado = null;
                                    $valor = \App\Models\Docentes\Asistencias::where('fecha','=',$fdia['fecha'])->where('emdetalle_id','=',$detalle->id)->first();
                                    if(isset($valor->estado)){
                                        $estado = $valor->estado;
                                    }else{
                                        $estado = "NR";
                                    }
                                @endphp
                                    <div class="col-sm-4 text-center" style="font-size: 0.8rem">
                                        <div class="border mb-1">
                                            <span class="d-block pt-1 border-bottom font-weight-bold bg-secondary text-white">
                                                {{ Str::upper($fdia['nombre_dia']) }}
                                            </span>
                                            <span class="d-block">
                                                {{ date('d-m-Y',strtotime($fdia['fecha'])) }}
                                            </span>
                                            <span class="d-block border-top pt-1">
                                                @if($estado == "NR")
                                                    <i class="fas fa-question-circle text-warning"></i> No registrado
                                                @endif
                                                @if($estado == "P")
                                                    <i class="fas fa-check-circle text-success"></i> Presente
                                                @endif
                                                @if($estado == "F")
                                                    <i class="fas fa-times-circle text-danger"></i> Faltó
                                                @endif
                                            </span>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('scripts')
<script>
    function setnumber(number){
        Highcharts.chart("nota", {
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
            max: 20,
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
                to: 13,
                color: "red", // green
                thickness: 20
            },
            {
                from: 13,
                to: 20,
                color: "blue", // yellow
                thickness: 20
            }
            ]
        },
        series: [
            {
            name: "Speed",
                data: [<?= $detalle->nota ?>],
            tooltip: {
                valueSuffix: " nota obtenida."
            },
            dataLabels: {
                format: "{y} nota.",
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
                backgroundColor: "black",
                baseWidth: 12,
                baseLength: "0%",
                rearLength: "0%"
            },
            pivot: {
                backgroundColor: "green",
                radius: 6
            }
            }
        ]
        });
    }
    document.addEventListener("DOMContentLoaded", function() {
        setnumber({{ $detalle->nota }});
    });

</script>
@endsection