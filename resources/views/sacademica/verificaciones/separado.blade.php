<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Verificaciones Separadas {{ $periodo->nombre }}</title>
</head>
<header>
    <table style="border: 0px; with 100%">
        <th>
            <img src="https://sisge.idexperujapon.edu.pe/img/pjHeader.jpg" height="80" alt="">
        </th>
        <th>
            <h4>Sistema de Control IDEX "Perú Japón" Nómina por Programa de Estudio y ciclo</h4>
        </th>
    </table>
</header>
<body>
    {!! Form::open(['route'=>'sacademica.verificaciones.store','method'=>'post','autocomplete'=>'off']) !!}
    <table style="width: 100%">
        <tbody>
            <td style="background:lightblue"><b>Programa de Estudios</b></td>
            <td>
                {{ $carr->nombreCarrera }}
            </td>
            <td style="background:lightblue"><b>Semestre Academico</b></td>
            <td style="text-align: center">{{ $periodo->nombre }}</td>
            <td style="background:lightblue"><b>Ciclo</b></td>
            <td style="text-align: center"><b>{{ $ciclo }}</b></td>
        </tbody>
    </table>
    <br>
    @foreach ($modulos as $modulo)
            {{-- aca vamos con los estudiantes de este curso --}}
        <table style="width: 100%" class="table table-striped table-hover table-bordered">
            <thead>
                <tr style="border: 3px solid rgb(16, 117, 122)">
                    <td colspan="8" style="background:lightseagreen">
                        <div class="row">
                            <div class="col-sm-12">
                                <h3>
                                    {{ $modulo->nombre }}
                                </h3>
                            </div>
                            <div class="col-sm-12">
                                <label for="formFile{{ $modulo->id }}" class="form-label"><i class="bi bi-filetype-csv"></i> seleccione un archivo para subir de forma masiva las notas</label>
                                <input class="form-control" type="file" id="formFile{{ $modulo->id }}" onchange="cambio({{ $modulo->id }})">  
                            </div>
                        </div>               
                    </td>
                </tr>
                <tr class="table-dark">
                    <td>N°</td>
                    <td>DNI</td>
                    <td>APELLIDOS, Nombres</th>
                    <td style="width: 8%">NOTA</td>
                    <td style="width: 10%"></td>
                </tr>
            </thead>
            <tbody>
                @php
                    $contador = 1;
                @endphp
                @foreach ($estudiantes as $estudiante)
                    @if ($estudiante->unidad == $modulo->nombre)
                        @if($estudiante->licencia == "NO")
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ $estudiante->dniRuc }}</td>
                                <td><strong>{{Str::upper($estudiante->apellido)}}</strong>, {{Str::title($estudiante->nombre)}}</td>
                                <td>
                                    <input style="text-align: right" type="hidden" name="id[]" value="{{ detalle($estudiante->id,$modulo->id)->id }}">
                                    <input onchange="color({{ $modulo->id }},{{ $estudiante->dniRuc }})" @if(detalle($estudiante->id,$modulo->id)->nota>12) class="form-control text-primary"  @else class="form-control text-danger" @endif  id="{{ $modulo->id }}-{{ $estudiante->dniRuc }}" style="text-align: right" type="number" name="notas[]" min="0" max="20" value="{{ detalle($estudiante->id,$modulo->id)->nota }}">
                                </td>
                                <td style="text-align: center">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="bi bi-save2"></i>
                                        guardar
                                    </button>
                                </td>
                            </tr>
                        @else
                            <tr>
                                <td>{{ $contador }}</td>
                                <td>{{ $estudiante->dniRuc }}</td>
                                <td colspan="3">
                                    <strong>{{Str::upper($estudiante->apellido)}}</strong>, {{Str::title($estudiante->nombre)}}
                                     - <span class="text-danger fst-italic"> licencia {{ $estudiante->licenciaObservacion }} </span>
                                </td>
                            </tr>
                        @endif
                        @php
                            $contador ++;
                        @endphp
                    @endif
                @endforeach
            </tbody>
            </table>
    @endforeach
    {!! Form::close() !!}
</body>
<script>
    function color(id,dni){
        let input = document.getElementById(id+"-"+dni);
        if (input){
            if ( parseInt(input.value)>12){
                input.className="form-control text-primary";
            }else{
                input.className="form-control text-danger";
            }
        }
    }
    function cambio(id){
        const entrada = document.getElementById("formFile"+id);
        const archivo = entrada.files[0];
        const reader = new FileReader();
        reader.onload = function () {
        // Imprimimos el contenido del archivo en la consola
        const lines = reader.result.split("\n");
        lines.forEach((line) => {
            //tengo la linea
            let column = line.split(";");
            let input = document.getElementById(id+"-"+column[0]);
            if(input){
                input.value = parseInt(column[1].trim());
                //ahora vamos a llamar a la function de cambio de color
                color(id,column[0]);
            }else{
                console.log('no hay: '+id+"-"+column[0]);
            }
        });
        };
        reader.readAsText(archivo);
    }
    
</script>
</html>