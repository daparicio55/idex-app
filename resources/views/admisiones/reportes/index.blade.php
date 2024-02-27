@extends('adminlte::page')
@section('title', 'Admisiones')

@section('content_header')
    <h1><i class="fas fa-list-ol text-primary"></i> Reportes</h1>
@stop
@section('content')
@if (session('info'))
    <div class="alert alert-success" id='info'>
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('error'))
    <div class="alert alert-danger" id='error'>
        <strong>{{session('error')}}</strong>
    </div>
@endif
{!! Form::open(['route'=>'admisiones.reportes.index','method'=>'get','autocomplete'=>'off','role'=>'search']) !!}
<div class="form-group">
    {!! Form::label('id', 'Periodo de Admision', [null]) !!}
    {!! Form::select('id', $admisiones, null, ['class'=>'form-control']) !!}
</div>
<div class="form-group">
    <button class="btn btn-dark" type="submit">
        <i class="fas fa-eye"></i> Ver Reporte
    </button>
</div>
{!! Form::close() !!}
@if(isset($admisione))
    @include('admisiones.reportes.modal')
    <div class="card border-success">
        <div class="card-header text-center">
            <h3><strong> Proceso de Admisión IDEX Perú Japón - {{$admisione->periodo}} </strong></h1>
        </div>
        <div class="card-body">
        {{-- exonerados --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="3" class="h4" style="text-align: center; background:lightgray"><b>POSTULANTES EXONERADOS</b></th>
                </tr>
                <tr>
                    <th class="text-right text-primary"><strong>Total expedientes activos:</strong> {{count($postulantesX)}}</th>
                    <th class="text-right text-danger" colspan="2"><strong>Total expedientes anulados:</strong> {{count($anuladosX)}}</th>
                </tr>
              <tr>
                <th scope="col">Programa de Estudios</th>
                <th scope="col"  class="text-center">Alumnos</th>
                <th scope="col"  class="text-center">%</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($programasX as $programax)
                    <tr>
                        <td><a href=""  data-target="#modal-detalles" data-toggle="modal" id="{{$programax->idCarrera}}" >{{$programax->programa}}</a></td>
                        <td class="text-center">{{$programax->cantidad}}</td>
                        <td class="text-center">{{round(($programax->cantidad / count($postulantesX)*100),0)}}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- ordinarios --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="3" class="h4" style="text-align: center; background:lightgray"><b>POSTULANTES ORDINARIO</b></th>
                </tr>
                <tr>
                    <th class="text-right text-primary"><strong>Total expedientes activos:</strong> {{count($postulantesO)}}</th>
                    <th class="text-right text-danger" colspan="2"><strong>Total expedientes anulados:</strong> {{count($anuladosO)}}</th>
                </tr>
              <tr>
                <th scope="col">Programa de Estudios</th>
                <th scope="col"  class="text-center">Alumnos</th>
                <th scope="col"  class="text-center">%</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($programasO as $programao)
                    <tr>
                        <td>{{$programao->programa}}</td>
                        <td class="text-center">{{$programao->cantidad}}</td>
                        <td class="text-center">{{round(($programao->cantidad / count($postulantesO)*100),0)}}%</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{-- total de postulantes --}}
        <table class="table table-hover">
            <thead>
                <tr>
                    <th colspan="5" class="h4" style="text-align: center; background:lightgray"><b>TOTAL DE POSTULANTES</b></th>
                </tr>
                <tr>
                    <th class="text-right text-primary"><strong>Total expedientes activos:</strong> {{count($postulantes)}}</th>
                    <th class="text-right text-danger" colspan="4"><strong>Total expedientes anulados:</strong> {{count($anulados)}}</th>
                </tr>
              <tr>
                <th scope="col">Programa de Estudios</th>
                <th scope="col">Hombres</th>
                <th scope="col">Mujeres</th>
                <th scope="col"  class="text-center">TOTAL</th>
                <th scope="col"  class="text-center">%</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($programas as $programa)
                    <tr>
                        <td>{{$programa->programa}}</td>
                        <td>{{ $totalpostulantes->where('idCarrera','=',$programa->idCarrera)->where('sexo','=','Masculino')->count() }}</td>
                        <td>{{ $totalpostulantes->where('idCarrera','=',$programa->idCarrera)->where('sexo','=','Femenino')->count() }}</td>
                        <td class="text-center">{{$programa->cantidad}}</td>
                        <td class="text-center">{{round(($programa->cantidad / count($postulantes)*100),0)}}%</td>
                    </tr>
                @endforeach
            </tbody>
          </table>
          <br>
        </div>
        <div class="card-footer text-muted">
            Reporte Sistema SISGE-PJ
        </div>
    </div>
    @include('admisiones.reportes.colegios')
@endif



@stop
@section('js')
    <script>
	$(document).ready(function(){
    setTimeout(() => {
        $("#info").hide();
    }, 12000);
    });
    $(document).ready(function(){
        setTimeout(() => {
        $("#error").hide();
      }, 12000);
    });
    //enfermeria
    $('#8').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Enfermería Técnica'){
                $(this).find("td").show();
            }
        });
    });
    //Mecanica
    $('#9').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Mecatrónica Automotriz'){
                $(this).find("td").show();
            }
        });
    });
    //electronica
    $('#10').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Electrónica Industrial'){
                $(this).find("td").show();
            }
        });
    });
    //asptic
    $('#11').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Arquitectura de Plataformas y Servicios de Tecnologías de la Información'){
                $(this).find("td").show();
            }
        });
    });
    //produccion
    $('#12').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Producción Agropecuaria'){
                $(this).find("td").show();
            }
        });
    });
    //asistencia
    $('#13').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Asistencia Administrativa'){
                $(this).find("td").show();
            }
        });
    });
    //laboratorio
    $('#14').click(function(){
        //vamos a ocultar todos los programas
        $('#tabla').find("tbody tr").each(function(){
            $(this).find("td").hide();
        });
        //mostrar todos y solo dejar los de computacion
        $('#tabla').find('tbody tr').each(function(){
            $carrera = $(this).find('td:eq(3)').html();
            if($carrera == 'Laboratorio Clínico y Anatomía Patológica'){
                $(this).find("td").show();
            }
        });
    });
	</script>
@stop