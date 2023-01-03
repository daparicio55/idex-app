<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>Verificaciones {{ $periodo->nombre }}</title>
    <style>
        .verticalText{
            display: inline;
            line-height: 1;
            position: relative;
            -webkit-transform: rotate(89deg);
            transform: rotate(180deg);
            white-space: nowrap;
            -webkit-writing-mode: vertical-rl;
            writing-mode: vertical-rl;
        }
        td{
            border: 1px solid #000;
            border-spacing: 0;
        }
        h4{
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>
</head>
<div class="container">
    <header class="mt-3">
        <table style="border: 0px; with 100%">
            <th>
                <img src="https://sisge.idexperujapon.edu.pe/img/pjHeader.jpg" height="80" alt="">
            </th>
            <th>
                <h4>Sistema de Control IDEX "Perú Japón" Nómina por Programa de Estudio y ciclo</h4>
            </th>
        </table>
    </header>
    <body class="mb-5">
        
        <table style="width: 100%">
            <tbody>
                <td style="background:lightblue"><b>Programa de Estudios</b></td>
                <td>{{ $carr->nombreCarrera }}</td>
                <td style="background:lightblue"><b>Semestre Academico</b></td>
                <td style="text-align: center">{{ $periodo->nombre }}</td>
                <td style="background:lightblue"><b>Ciclo</b></td>
                <td style="text-align: center"><b>{{ $ciclo }}</b></td>
            </tbody>
        </table>
        <br>
        {!! Form::open(['route'=>'sacademica.verificaciones.store','method'=>'post','autocomplete'=>'off']) !!}
        <table class="table" style="width: 100%">
            @php
                $contador = 1;
            @endphp
            <thead>
                <tr>
                    <td style="vertical-align: bottom;background:lightgray">N°</td>
                    <td style="vertical-align: bottom;background:lightgray">DNI</td>
                    <td style="vertical-align: bottom;background:lightgray">APELLIDOS, Nombres</th>
                    
                    @foreach ($modulos as $modulo)
                        <td style="vertical-align: bottom; background:gray; text-align: center;width: 85px"><div class="verticalText">{{ $modulo->nombre }}</div></td>
                    @endforeach
                    <td style="vertical-align: bottom; font-weight: bold; background:gray; text-align: center;width: 90px"><div class="verticalText">Promedio Ponderado</div></td>
                    <td class="bg-info" style="vertical-align: bottom; font-weight: bold; text-align: center;width: 80px"><div class="verticalText">Puesto</div></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $mayor = 0;
                @endphp
                @foreach ($estudiantes as $estudiante)
                @if($estudiante->licencia == "NO")
                    <tr>
                        <td>
                            <input type="hidden" name="es_id[]" value="{{ $estudiante->id }}">
                            {{ $contador }}
                        </td>
                        <td>{{ $estudiante->dniRuc }}</td>
                        <td><strong>{{Str::upper($estudiante->apellido)}}</strong>, {{Str::title($estudiante->nombre)}}</td>
                        @php
                            $sumacreditos = 0;
                            $promedio = 0;
                            $suma = 0;
                        @endphp
                        @foreach ($modulos as $modulo)
                            @php
                                $sumacreditos = $sumacreditos + $modulo->creditos;
                            @endphp
                            <td style="text-align: center">
                                @if (isset(detalle($estudiante->id,$modulo->id)->id))
                                    @if (detalle($estudiante->id,$modulo->id)->tipo == "Regular" || detalle($estudiante->id,$modulo->id)->tipo == "Repitencia" )
                                        <input style="text-align: right" type="hidden" name="id[]" value="{{ detalle($estudiante->id,$modulo->id)->id }}">
                                        <input class="form-control" onchange="color({{ detalle($estudiante->id,$modulo->id)->id }})"  @if(detalle($estudiante->id,$modulo->id)->nota>12) style="text-align: right ; color: blue" @else style="text-align: right ; color: red"  @endif type="number" id="texto{{ detalle($estudiante->id,$modulo->id)->id }}" name="notas[]" min="0" max="20" value="{{ detalle($estudiante->id,$modulo->id)->nota }}">    
                                        @php
                                            $suma = $suma + (detalle($estudiante->id,$modulo->id)->nota * $modulo->creditos);
                                        @endphp
                                    @endif
                                    @if (detalle($estudiante->id,$modulo->id)->tipo == "Convalidacion")
                                        {!! Form::label(null, detalle($estudiante->id,$modulo->id)->nota, ['class'=>'text-success']) !!}
                                    @endif
                                @else
                                    NM
                                @endif
                            </td>
                        @endforeach
                        @php
                            $promedio = $suma / $sumacreditos;
                        @endphp
                        <td id="pro{{ round($promedio,2) }}">
                            <input readonly style="background:lightgray; text-align: right" name="ponderados[]" class="form-control" type="text" id="txtpro{{ round($promedio,2) }}" value="{{ round($promedio,2) }}">
                        </td>
                        <td>
                            <input class="form-control bg-info text-center" readonly type="text" name="puestos[]" @if(!strpos($promedio, '.')) id="txt-{{ $promedio }}.00" @else id="txt-{{ round($promedio,2) }}" @endif>
                        </td>
                        <td style="text-align: center; width: 60px">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i>
                            </button>
                        </td>
                        @if ($promedio>$mayor)
                            @php
                                $mayor = $promedio;
                            @endphp
                        @endif
                        
                    </tr>
                @php
                    $contador ++;
                @endphp
                @endif
                @endforeach
                <input type="hidden" id="mayor"  value={{ round($mayor,2) }}>
            </tbody>
        </table>
        {!! Form::close() !!}
    </body>
</div>

<script>


function orden(){
        let notas = document.querySelectorAll('[id^="txtpro"]');
        let nota = [];
        for(let i=0;i< notas.length; i++){
            nota.push(parseFloat(notas[i].value));
        }
        nota = nota.sort((a, b) => b - a);
        //console.log(nota.length);
        /* nota = nota.filter((valor, indice, array) => array.indexOf(valor) === indice); */
        nota = nota.filter((valor, indice, array) => array.indexOf(valor) === indice);
        //ahora vamos a poner el los numeros
        
        for(let z=0; z<nota.length ; z++){
            console.log(nota[z]);
            let txt;
            if (!nota[z].toString().includes('.')){
                console.log('velor de 1');
                txt = document.querySelectorAll('[id^="txt-'+nota[z]+'.00'+'"]'); 
                console.log(txt[0]);
            }else{
                txt = document.querySelectorAll('[id^="txt-'+nota[z]+'"]');     
            }
            for(let j=0;j<txt.length;j++){
                if (z+1 == 1){
                    txt[j].style.color = "Green";
                    txt[j].style.fontWeight = "bold";
                }
                if (z+1 == 2){
                    txt[j].style.color = "Blue";
                    txt[j].style.fontWeight = "bold";
                }
                if (z+1 == 3){
                    txt[j].style.color = "Red";
                    txt[j].style.fontWeight = "bold";
                }
                let suma = z+1;
                txt[j].value= suma;
                
            }
        }
    }

    

    function color(id){
        var txt = document.getElementById('texto'+id);
        if (txt.value>12){
            txt.style.color='blue';
        }else{
            txt.style.color='red';
        }
    }
    
    window.addEventListener('load', (event) => {
        var mayor = document.getElementById('mayor');
        var txtmayor = document.getElementById('txtpro'+mayor.value);
        txtmayor.style.color = 'green';
        orden();
    });
</script>
</html>