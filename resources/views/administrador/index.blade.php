@extends('adminlte::page')
@section('title', 'Administrador')

@section('content_header')
    <h1>Panel de Administrador</h1>
@stop
@section('content')
<x-alert/>

<table class="table mt-2">
  <thead>
    <tr>
      <th>#</th>
      <th>Acciones del Administrador</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="pb-1 pt-1">1</td>
      <td class="pb-1 pt-1">Normalizacion de nombres de clientes del sistema a todos en mayusculas</td>
      <td class="pb-1 pt-1">
        <button type="button" class="btn btn-secondary w-100" id="btn_normalizar">
          Normalizar
        </button>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">2</td>
      <td class="pb-1 pt-1">Revisar notas de estudiantes del sistema.</td>
      <td class="pb-1 pt-1">
        <button type="button" class="btn btn-secondary w-100" id="btn_revizar_notas">
          Revisar
        </button>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">3</td>
      <td class="pb-1 pt-1">Revisar experiencias formativas de los estudiantes</td>
      <td class="pb-1 pt-1">
        <button type="button" class="btn btn-secondary w-100" id="btn_revizar_experiencias">
          Revisar
        </button>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">4</td>
      <td class="pb-1 pt-1">Mostrar reportes de deudas de todo el sistema</td>
      <td class="pb-1 pt-1">
        <a type="button" href="{{ route('administrador.reportedeudas') }}" target="_blank" class="btn btn-secondary w-100" id="btn_reportes_deudas"> 
          Mostrar
        </a>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">5</td>
      <td class="pb-1 pt-1">Mostrar reportes de ingresantes por periodo de admision</td>
      <td class="pb-1 pt-1">
        <x-btn-drop-down id="reporteingresantes" :items=$admisiones ruta="administrador.reporteingresantes">
          Admisiones
        </x-btn-drop-down>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">6</td>
      <td class="pb-1 pt-1">Mostrar reportes de estudiantes con dicapacidad por periodo de estudios</td>
      <td class="pb-1 pt-1">
        <x-btn-drop-down id="reportediscapacitados" :items=$periodos ruta="administrador.reportedis">
          P. Matrículas
        </x-btn-drop-down>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">7</td>
      <td class="pb-1 pt-1">Mostrar reportes de matriculas por periodo de estudios</td>
      <td class="pb-1 pt-1">
        <x-btn-drop-down id="reportematriculas" :items=$periodos ruta="administrador.reportematricula">
          P. Matrículas
        </x-btn-drop-down>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">8</td>
      <td class="pb-1 pt-1">Creacion de cuentas de estudiantes masivamente por periodo de estudios</td>
      <td class="pb-1 pt-1">
        <x-btn-drop-down id="makemasiveaccount" :items=$periodos ruta="administrador.masivemakeaccount">
          P. Matrículas
        </x-btn-drop-down>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">9</td>
      <td class="pb-1 pt-1">Set <span class="text-info">NULL</span> notas a estudiantes con licencia</td>
      <td class="pb-1 pt-1">
        <x-btn-drop-down id="setnulllicencias" :items=$periodos ruta="administrador.setnulllicencias">
          P. Matrículas
        </x-btn-drop-down>
      </td>
    </tr>
    <tr>
      <td class="pb-1 pt-1">10</td>
      <td class="pb-1 pt-1">Set <span class="text-danger">CERO</span> notas a estudiates deshabilitados por inasistencia</td>
      <td class="pb-1 pt-1">
        <x-btn-drop-down id="setcerodeshabilitados" :items=$periodos ruta="administrador.setceroinabilitados">
          P. Matrículas
        </x-btn-drop-down>
      </td>
    </tr>
  </tbody>
</table>

<x-loading/>
@stop
@section('css')
  <link rel="stylesheet" href="{{ asset('css/loading.css') }}">
@stop
@section('js')
  <script src="{{ asset('js/carga.js') }}"></script>
  <script src="{{ asset('js/administrador/main.js') }}"></script>
  <script>
    document.getElementById('btn_normalizar').addEventListener('click',function(){
      let ruta = "{{ route('administrador.normalizarnombres') }}";
      normalizar_nombres(ruta);
    });
  </script>
@stop