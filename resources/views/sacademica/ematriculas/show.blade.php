<!DOCTYPE html>
<html>

<head>
    <title>Sistema IDEX Perú Japón</title>
    <meta lang="es_ES">
    <meta charset="utf-8">
    <style>
            .table-header {
            width: 100%;
            border-collapse: collapse;
            /* font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; */
            margin-bottom: 1rem;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>


<body>
    <header>
        <table class="table-header">
            <thead>
                <tr>
                    <th>
                        <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" width="200px"
                            alt="a">
                    </th>
                    <th>
                        <h5 class="mb-0 text-center"><b>Sistema de Control IDEX "Perú Japón"</b></h5>
                        <h5 class="mb-0 text-center"><b>Ficha de Matrícula Semestral ({{ $matricula->tipo }})</b></h5>
                        <p class="text-center">fecha de matrícula: {{ date('d-m-Y',strtotime($matricula->fecha)) }}</p>
                    </th>
                    <th>
                        <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png"
                            width="150px" alt="b">
                    </th>
                </tr>
            </thead>
        </table>
    </header>
    <div class="card" style="font-size: 0.7rem">
        <div class="card-header bg-primary text-white">
            <span class="font-bold">DATOS PERSONALES</span>
        </div>
        <div class="card-body pt-1 pb-0 pl-0 pr-0">
            <div class="row">
                <div class="col-sm-10 pl-0">
                    <table class="table mb-1" style="font-size: 0.8rem">
                        <tbody>
                            <tr>
                                <th class="pt-0 pb-0 pl-1 bg-primary">Institución</th>
                                <td class="pt-0 pb-0 pl-1">IESTP Perú Japón</td>
                                <th class="pt-0 pb-0 pl-1 bg-primary">DRE</th>
                                <td class="pt-0 pb-0 pl-1">Amazonas</td>
                            </tr>
                            <tr>
                                <th class="pt-0 pb-0 pl-1 bg-primary" colspan="2">Programa de Estudios</th>
                                <th class="pt-0 pb-0 pl-1 bg-primary">Admisión</th>
                                <td class="pt-0 pb-0 pl-1">{{ $matricula->estudiante->postulante->admisione->nombre }}</td>
                            </tr>
                            <tr>
                                <td class="pt-0 pb-0 pl-1" colspan="4">{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                            </tr>
                            <tr>
                                <th class="pt-0 pb-0 pl-1 bg-primary" colspan="2">APELLIDOS, Nombres</th>
                                <th class="pt-0 pb-0 pl-1 bg-primary">DNI</th>
                                <td class="pt-0 pb-0 pl-1">{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                            </tr>
                            <tr>
                                <td class="pt-0 pb-0 pl-1" colspan="4">{{ Str::upper($matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($matricula->estudiante->postulante->cliente->nombre) }}</td>
                            </tr>
                            <tr>
                                <th class="pt-0 pb-0 pl-1 bg-primary">Correo</th>
                                <td class="pt-0 pb-0 pl-1">{{ $matricula->estudiante->postulante->cliente->email }}</td>
                                <th class="pt-0 pb-0 pl-1 bg-primary">Teléfono</th>
                                <td class="pt-0 pb-0 pl-1">{{ $matricula->estudiante->postulante->cliente->telefono }}</td>
                            </tr>
                            <tr>
                                <th class="pt-0 pb-0 pl-1 bg-primary">U. Sistema</th>
                                <td class="pt-0 pb-0 pl-1">{{ $matricula->user->email }}</td>
                                <th class="pt-0 pb-0 pl-1 bg-primary">Periodo</th>
                                <td class="pt-0 pb-0 pl-1">{{ $matricula->matricula->nombre }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-2">
                    <img style="height: 150px" src="{{ Storage::url($matricula->estudiante->postulante->url) }}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div class="card" style="font-size: 0.6rem">
        <div class="card-header bg-success text-white">
            <b>UNIDADES DIDACTICAS REGULARES</b>
        </div>
        <div class="card-body pt-1 pb-0 pl-0 pr-0">
            <table class="table mb-1 table-bordered">
                <thead>
                    <tr class="bg-secondary">
                        <th class="pt-0 pb-0">#</th>
                        <th class="pt-0 pb-0">Ci.</th>
                        <th class="pt-0 pb-0">Tipo</th>
                        <th class="pt-0 pb-0">Unidad Didáctica</th>
                        <th class="pt-0 pb-0">Horario</th>
                        <th class="pt-0 pb-0">Tipo</th>
                        <th class="pt-0 pb-0">H/C</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($matricula->detalles->where('tipo','=','Regular') as $detalle)
                            <tr>
                                <td class="pt-0 pb-0">{{ $loop->index + 1 }}</td>
                                <td class="pt-0 pb-0">{{ $detalle->unidad->ciclo }}</td>
                                <td class="pt-0 pb-0">{{ $detalle->unidad->tipo }}</td>
                                @if(isset($detalle->unidad->equivalencia->id))
                                    <td class="pt-0 pb-0">
                                        {{ $detalle->unidad->nombre }}
                                        @if(isset(getDocente($matricula->pmatricula_id,$detalle->unidad->equivalencia->id)->user->name))
                                            <span class="text-danger">
                                                Equivalencia:
                                                {{ $detalle->unidad->equivalencia->nombre }} Ciclo:
                                                {{ $detalle->unidad->equivalencia->ciclo }}
                                            </span>
                                            <span class="d-block">
                                                <b>Docente:</b> {{ getDocente($matricula->pmatricula_id,$detalle->unidad->equivalencia->id)->user->name }}
                                            </span>
                                        @endif
                                    </td> 
                                @else
                                    <td class="pt-0 pb-0">
                                        {{ $detalle->unidad->nombre }}
                                        <b>Docente:</b> {{ getDocente($matricula->pmatricula_id,$detalle->unidad->id)->user->name }}
                                    </td>
                                @endif
                                <td class="pt-0 pb-0">
                                    @if(isset(getDocente($matricula->pmatricula_id,$detalle->unidad->id)->user->name))
                                        <ul class="mb-0">
                                            @foreach (getDocente($matricula->pmatricula_id,$detalle->unidad->id)->horarios as $horario)
                                                <li>{{ $horario->day }}-{{ $horario->hinicio }}-{{ $horario->hfin }}</li>
                                            @endforeach
                                        </ul>
                                    @endif  
                                </td>
                                <td class="pt-0 pb-0">{{ $detalle->tipo }}</td>
                                <td class="pt-0 pb-0">
                                    {{ $detalle->unidad->horas }}/{{ $detalle->unidad->creditos }}
                                </td>                   
                            </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-between pt-1 pb-0">
            <div>
                Total Horas Semanales: {{ $matricula->detalles->where('tipo','=','Regular')->sum('unidad.horas') }}
            </div>
            <div>
                Total Creditos: {{ $matricula->detalles->where('tipo','=','Regular')->sum('unidad.creditos') }}
            </div>
        </div>
    </div>
    
    
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <table style="width: 100%">
        <tbody>
            <tr style="text-align: center">
                <td style="width: 33%">_______________________</td>
                <td style="width: 33%">&nbsp;</td>
                <td style="width: 33%">_____________</td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 33%">SECRETARIA ACADÉMICA</td>
                <td style="width: 33%">&nbsp;</td>
                <td style="width: 33%">ESTUDIANTE</td>
            </tr>
            <tr style="text-align: center">
                <td style="width: 33%">firma post firma y sello</td>
                <td style="width: 33%">&nbsp;</td>
                <td style="width: 33%">firma</td>
            </tr>
        </tbody>
    </table>
</body>

</html>
