<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Estadisticas I.E.S.T. Perú Japón</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        thead{
            background-color: #BABABA;
        }
        .second2-tr{
            background-color: #E5E5E5;
        }
    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                        <!-- INGRESANTES -->
                        <div class="card mt-3">
                            <div class="card-header text-white" style="background-color: #49A1B9">
                                <h4 class="pt-2"><b>INGRESANTES</b></h4>
                            </div>
                            <div class="card-body">
                                @foreach ($admisiones as $key=>$admisione)
                                <table class="table">
                                    <thead>
                                        <tr class="second2-tr">
                                            <th style="width: 50px">#</th>
                                            <th>Periodo</th>
                                            <th>Hombres</th>
                                            <th>Mujeres</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            {{-- <td>{{ $key+1 }}</td> --}}
                                            <td colspan="2">{{ $admisione->nombre }}</td>
                                            <td>{{ $admisione->postulantes()->whereHas('estudiante',function($query){
                                                $query->where('sexo','=','Masculino');
                                            })->count() }}</td>
                                            <td>{{ $admisione->postulantes()->whereHas('estudiante',function($query){
                                                $query->where('sexo','=','Femenino');
                                            })->count() }}</td>
                                            <td>{{ $admisione->postulantes()->whereHas('estudiante',function($query){
                                                
                                            })->count() }}</td>
                                        </tr>
                                        @foreach ($carreras as $llave=>$carrera)
                                            <tr>
                                                <td>{{ $llave+1 }}</td>
                                                <td {{-- colspan="2" --}}>{{ $carrera->nombreCarrera }}</td>
                                                <td>{{ $admisione->postulantes()->whereHas('estudiante',function($query) use($carrera){
                                                    $query->where('sexo','=','Masculino')->where('idCarrera','=',$carrera->idCarrera);
                                                })->count() }}</td>
                                                <td>{{ $admisione->postulantes()->whereHas('estudiante',function($query) use($carrera){
                                                    $query->where('sexo','=','Femenino')->where('idCarrera','=',$carrera->idCarrera);
                                                })->count() }}</td>
                                                <td>{{ $admisione->postulantes()->whereHas('estudiante',function($query) use($carrera){
                                                    $query->where('idCarrera','=',$carrera->idCarrera);
                                                })->count() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="2"></td>
                                            <td colspan="3" class="text-center"><strong>TOTAL:</strong> {{ $admisione->postulantes()->whereHas('estudiante')->count() }} Ingresantes.</td>
                                        </tr>
                                    </tfoot>
                                </table>
                                @endforeach
                            </div>
                            <div class="card-footer bg-black">

                            </div>
                        </div>



                        <!-- MATRICULADOS --->
                        <div class="card mt-3">
                            <div class="card-header text-white" style="background-color: #49A1B9">
                                <h4 class="pt-2"><b>MATRICULADOS</b></h4>
                            </div>
                            <div class="card-body">
                                @foreach ($periodos as $key=>$periodo)
                                @if(substr($periodo->nombre,-1) == 1)
                                    <table class="table">
                                        <thead>
                                            <trclass="second2-tr">
                                                <th style="width: 50px">#</th>
                                                <th>Año</th>
                                                <th>Hombres</th>
                                                <th>Mujeres</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>#</td>
                                                <td>{{ substr($periodo->nombre,0,4) }}</td>
                                                <td>{{ $periodo->matriculas()->whereHas('estudiante.postulante',function($query){
                                                    $query->where('sexo','=','Masculino');
                                                })->count(); }}</td>
                                                <td>{{ $periodo->matriculas()->whereHas('estudiante.postulante',function($query){
                                                    $query->where('sexo','=','Femenino');
                                                })->count(); }}</td>
                                                <td>{{ $periodo->matriculas()->count() }}</td>
                                                @foreach ($carreras as $key=>$carrera)
                                                    <tr>
                                                        <td>{{ $key+1 }}</td>
                                                        <td {{-- colspan="2" --}}>{{ $carrera->nombreCarrera }}</td>
                                                        <td>{{ $periodo->matriculas()->whereHas('estudiante.postulante',function($query) use($carrera){
                                                            $query->where('sexo','=','Masculino')->where('idCarrera','=',$carrera->idCarrera);
                                                        })->count(); }}</td>
                                                        <td>{{ $periodo->matriculas()->whereHas('estudiante.postulante',function($query) use($carrera){
                                                            $query->where('sexo','=','Femenino')->where('idCarrera','=',$carrera->idCarrera);
                                                        })->count(); }}</td>
                                                        <td>{{ $periodo->matriculas()->whereHas('estudiante.postulante',function($query) use($carrera){
                                                            $query->where('idCarrera','=',$carrera->idCarrera);
                                                        })->count(); }}</td>
                                                    </tr>
                                                @endforeach
                                            </tr>
                                        </tbody>
                                    </table>
                                @endif
                                @endforeach
                            </div>
                            <div class="card-footer bg-black">
                            </div>
                        </div>
                        <!-- titulados -->

                        <div class="card mt-3">
                            <div class="card-header text-white" style="background-color: #49A1B9">
                                <h4 class="pt-2"><b>EGRESADOS 2022</b></h4>
                            </div>
                            <div class="card-body">
                                    <table class="table">
                                        <thead>
                                            <tr class="second2-tr">
                                                <th style="width: 50px">#</th>
                                                <th>Programa de Estudios</th>
                                                <th>Hombres</th>
                                                <th>Mujeres</th>
                                                <th>Total.</th>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>1</td>
                                                <td>Computación e Informática</td>
                                                <td>12</td>
                                                <td>10</td>
                                                <td>22</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Electrónica Industrial</td>
                                                <td>8</td>
                                                <td>3</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Enfermeria Técnica</td>
                                                <td>14</td>
                                                <td>7</td>
                                                <td>21</td>
                                            </tr>
                                            <tr>
                                                <td>4</td>
                                                <td>Laboratorio Clínico</td>
                                                <td>18</td>
                                                <td>12</td>
                                                <td>30</td>
                                            </tr>
                                            <tr>
                                                <td>5</td>
                                                <td>Mecánica Automotriz</td>
                                                <td>16</td>
                                                <td>0</td>
                                                <td>16</td>
                                            </tr>
                                            <tr>
                                                <td>6</td>
                                                <td>Producción Agropecuaria</td>
                                                <td>19</td>
                                                <td>11</td>
                                                <td>30</td>
                                            </tr>
                                            <tr>
                                                <td>7</td>
                                                <td>Secretariado Ejecutivo</td>
                                                <td>0</td>
                                                <td>32</td>
                                                <td>32</td>
                                            </tr>
                                        </tbody>
                                    </table>
                            </div>
                            <div class="card-footer bg-black">
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>