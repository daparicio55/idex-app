<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matricula</title>
    <link rel="stylesheet" href="{{ asset('css/fichas.css') }}">
</head>
<body>
    <header>
        <div>
            <img src="https://titulosinstitutos.minedu.gob.pe/Content/img/logo-minedu.png" width="200px"
                alt="a">
        </div>
        <div>
            <h5>Sistema de Control IDEX "Perú Japón"</h5>
            <h5>Ficha de Matrícula Semestral ({{ $matricula->tipo }})</h5>
            <h6 class="text-center">fecha de matrícula: {{ date('d-m-Y',strtotime($matricula->fecha)) }}</h6>
        </div>
        <div>
            <img src="https://idexperujapon.edu.pe/wp-content/uploads/2023/08/cropped-logo-300x93.png"
                width="150px" alt="b">
        </div>
    </header>
    <main>
        {{-- información personal --}}
        <div class="card">
            <div class="card-header bg-primary text-white">
                <span class="text-bold">DATOS PERSONALES</span>
            </div>
            <div class="card-body d-flex">
                    <div class="personales-data d-flex aling-center">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                    <th class="bg-primary text-white">Institución</th>
                                    <td>IESTP Perú Japón</td>
                                    <th class="bg-primary text-white">DRE</th>
                                    <td>Amazonas</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" colspan="2">Programa de Estudios</th>
                                    <th class="bg-primary text-white">Admisión</th>
                                    <td>{{ $matricula->estudiante->postulante->admisione->nombre }}</td>
                                </tr>
                                <tr>
                                    <td class="pt-0 pb-0 pl-1" colspan="4">{{ $matricula->estudiante->postulante->carrera->nombreCarrera }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white" colspan="2">APELLIDOS, Nombres</th>
                                    <th class="bg-primary text-white">DNI</th>
                                    <td>{{ $matricula->estudiante->postulante->cliente->dniRuc }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">{{ Str::upper($matricula->estudiante->postulante->cliente->apellido) }}, {{ Str::title($matricula->estudiante->postulante->cliente->nombre) }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white">Correo</th>
                                    <td>{{ $matricula->estudiante->postulante->cliente->email }}</td>
                                    <th class="bg-primary text-white">Teléfono</th>
                                    <td>{{ $matricula->estudiante->postulante->cliente->telefono }}</td>
                                </tr>
                                <tr>
                                    <th class="bg-primary text-white">U. Sistema</th>
                                    <td>{{ $matricula->user->email }}</td>
                                    <th class="bg-primary text-white">Periodo</th>
                                    <td>{{ $matricula->matricula->nombre }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="personales-img d-flex aling-center">
                        <img style="height: 100px" src="{{ Storage::url($matricula->estudiante->postulante->url) }}" alt="">
                    </div>
            </div>
        </div>
        {{-- unidades didacticas regulares --}}
        @if($matricula->detalles->where('tipo','=','Regular')->count()>0)
            <div class="card">
                <div class="card-header bg-success text-white">
                    <span class="text-bold">UNIDADES DIDÁCTICAS REGULARES</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th class="bg-success text-white">#</th>
                            <th class="bg-success text-white">Ci.</th>
                            <th class="bg-success text-white">Tipo</th>
                            <th class="bg-success text-white">Unidad Didáctica</th>
                            <th class="bg-success text-white">Horario</th>
                            <th class="bg-success text-white">H/C</th>
                        </thead>
                        <tbody>
                            @foreach ($matricula->detalles->where('tipo','=','Regular') as $detalle)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $detalle->unidad->ciclo }}</td>
                                    <td>{{ $detalle->unidad->tipo }}</td>
                                    @if(isset($detalle->unidad->equivalencia->id))
                                    @php
                                        $unidad = getDocente($matricula->pmatricula_id,$detalle->unidad->equivalencia->id);
                                    @endphp
                                        <td>
                                            {{ $detalle->unidad->nombre }}
                                            @if(isset($unidad->user->name))
                                                <span class="text-danger">
                                                    Equivalencia:
                                                    {{ $detalle->unidad->equivalencia->nombre }} Ciclo:
                                                    {{ $detalle->unidad->equivalencia->ciclo }}
                                                </span>
                                                <span>
                                                    <b>Docente:</b> {{ $unidad->user->name }}
                                                </span>
                                            @endif
                                        </td> 
                                    @else
                                    @php
                                        $unidad = getDocente($matricula->pmatricula_id,$detalle->unidad->id);
                                    @endphp
                                        <td>
                                            {{ $detalle->unidad->nombre }}
                                            @if(isset($unidad->user->name ))
                                                <b>Docente:</b> {{ $unidad->user->name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if(isset($unidad->user->name))
                                            <ul class="mb-0">
                                                @foreach ($unidad->horarios as $horario)
                                                    <li>{{ $horario->day }} de {{ date('H:i',strtotime($horario->hinicio)) }} a {{ date('H:i',strtotime($horario->hfin)) }}</li>
                                                @endforeach
                                            </ul>
                                        @endif  
                                    </td>
                                    <td>
                                        {{ $detalle->unidad->horas }}/{{ $detalle->unidad->creditos }}
                                    </td>                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-secondary d-flex justify-content-between">
                    <div class="text-white">
                        Total Horas Semanales: {{ $matricula->detalles->where('tipo','=','Regular')->sum('unidad.horas') }}
                    </div>
                    <div class="text-white">
                        Total Creditos: {{ $matricula->detalles->where('tipo','=','Regular')->sum('unidad.creditos') }}
                    </div>
                </div>
            </div>
        @endif
        {{-- unidades didacticas repitencia --}}
        @if($matricula->detalles->where('tipo','=','Repitencia')->count()>0)
            <div class="card">
                <div class="card-header bg-danger text-white">
                    <span class="text-bold">UNIDADES DIDÁCTICAS REPITENCIA</span>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <th class="bg-danger text-white">#</th>
                            <th class="bg-danger text-white">Ci.</th>
                            <th class="bg-danger text-white">Tipo</th>
                            <th class="bg-danger text-white">Unidad Didáctica</th>
                            <th class="bg-danger text-white">Horario</th>
                            <th class="bg-danger text-white">H/C</th>
                        </thead>
                        <tbody>
                            @foreach ($matricula->detalles->where('tipo','=','Repitencia') as $detalle)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $detalle->unidad->ciclo }}</td>
                                    <td>{{ $detalle->unidad->tipo }}</td>
                                    @if(isset($detalle->unidad->equivalencia->id))
                                    @php
                                        $unidad = getDocente($matricula->pmatricula_id,$detalle->unidad->equivalencia->id);
                                    @endphp
                                        <td>
                                            {{ $detalle->unidad->nombre }}
                                            @if(isset($unidad->user->name))
                                                <span class="text-danger">
                                                    Equivalencia:
                                                    {{ $detalle->unidad->equivalencia->nombre }} Ciclo:
                                                    {{ $detalle->unidad->equivalencia->ciclo }}
                                                </span>
                                                <span>
                                                    <b>Docente:</b> {{ $unidad->user->name }}
                                                </span>
                                            @endif
                                        </td> 
                                    @else
                                    @php
                                        $unidad = getDocente($matricula->pmatricula_id,$detalle->unidad->id);
                                    @endphp
                                        <td>
                                            {{ $detalle->unidad->nombre }}
                                            @if(isset($unidad->user->name ))
                                                <b>Docente:</b> {{ $unidad->user->name }}
                                            @endif
                                        </td>
                                    @endif
                                    <td>
                                        @if(isset($unidad->user->name))
                                            <ul class="mb-0">
                                                @foreach ($unidad->horarios as $horario)
                                                <li>{{ $horario->day }} de {{ date('H:i',strtotime($horario->hinicio)) }} a {{ date('H:i',strtotime($horario->hfin)) }}</li>
                                                @endforeach
                                            </ul>
                                        @endif  
                                    </td>
                                    <td>
                                        {{ $detalle->unidad->horas }}/{{ $detalle->unidad->creditos }}
                                    </td>                   
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-secondary d-flex justify-content-between">
                    <div class="text-white">
                        Total Horas Semanales: {{ $matricula->detalles->where('tipo','=','Repitencia')->sum('unidad.horas') }}
                    </div>
                    <div class="text-white">
                        Total Creditos: {{ $matricula->detalles->where('tipo','=','Repitencia')->sum('unidad.creditos') }}
                    </div>
                </div>
            </div>
        @endif
    </main>
    <footer class="fixed-footer">
        <div class="d-flex justify-space-around">
            <div>
                <span class="text-center">
                    SECRETARIA ACADÉMICA
                    <p>FIRMA Y SELLO</p>
                </span>
            </div>
            <div>
                <span class="text-center">
                    ESTUDIANTE
                    <p>FIRMA</p>
                </span>
            </div>
        </div>
    </footer>
</body>
</html>