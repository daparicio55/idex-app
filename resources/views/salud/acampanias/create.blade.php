@php
    use Carbon\Carbon;
@endphp
@extends('adminlte::page')
@section('title', 'Atenciones de Campañas')
@section('content_header')
<h1>Registrar datos de la Atencion.</h1>
@stop
@section('content')
{!! Form::open(['route.salud.acampanias.create','method'=>'get','role'=>'search']) !!}
<div class="row">
    <div class="col-sm-12">
        <div class="input-group mb-3">
            <input type="text" name="buscar_dni" @isset($estudiante) value="{{ $estudiante->postulante->cliente->dniRuc }}" @endisset class="form-control" placeholder="ingrese DNI para ubicar estudiante" aria-label="ingrese DNI para ubicar estudiante" aria-describedby="btn_buscar">
            <div class="input-group-append">
                <button class="btn btn-outline-primary" type="submit" id="btn_buscar">
                    <i class="fa fa-search"></i> Buscar
                </button>
            </div>
          </div>
    </div>
</div>
{!! Form::close() !!}
@isset($estudiante)
{!! Form::open(['route'=>'salud.acampanias.store','method'=>'post','id'=>'frm']) !!}
{!! Form::hidden('idCliente', $estudiante->postulante->cliente->idCliente, [null]) !!}
{!! Form::hidden('estudiante_id', $estudiante->id, [null]) !!}

<div class="card card-primary">
    <div class="card-header">
        <p class="card-title">
            Datos del Estudiante
        </p>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-3">
                {!! Form::label('apellido', 'Apellidos', [null]) !!}
                {!! Form::text('apellido', $estudiante->postulante->cliente->apellido, ['class'=>'form-control','readonly']) !!}
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('nombre', 'Nombres', [null]) !!}
                {!! Form::text('nombre', $estudiante->postulante->cliente->nombre, ['class'=>'form-control','readonly']) !!}
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('telefono', 'Telefono', [null]) !!}
                {!! Form::text('telefono', $estudiante->postulante->cliente->telefono, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-3">
                {!! Form::label('telefono2', 'WhatsApp', [null]) !!}
                {!! Form::text('telefono2', $estudiante->postulante->cliente->telefono2, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('fechaNacimiento','F. Nacimiento', [null]) !!}
                {!! Form::date('fechaNacimiento', $estudiante->postulante->fechaNacimiento, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('sexo','Sexo', [null]) !!}
                {!! Form::select('sexo', $sexos, $estudiante->postulante->sexo, ['class'=>'form-control']) !!}
            </div>
            <div class="col-sm-12 col-md-8">
                {!! Form::label('direccion', 'Direccion', [null]) !!}
                {!! Form::text('direccion', $estudiante->postulante->cliente->direccion, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="card-footer card-title bg-info">
        {{ $estudiante->postulante->carrera->nombreCarrera }}
    </div>
</div>
<div class="card card-dark">
    <div class="card-header">
        <div class="row">
            <div class="col-sm-12 col-md-10">
                <p class="card-title">
                    Registro de resultados de la atencion.
                </p>
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::select('campania_id', $campanias, null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 mb-2">
                <h4 class="card-title text-danger">
                    <b><i class="fas fa-heart"></i> Signos Vitales - Enfermeria...</b>
                </h4>
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('vitales_temperatura', 'Temperatura', [null]) !!}
                {!! Form::number('vitales_temperatura', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('vitales_fc', 'F. Cardiaca', [null]) !!}
                {!! Form::number('vitales_fc', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('vitales_fr', 'F. Respiratoria', [null]) !!}
                {!! Form::number('vitales_fr', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('vitales_saturacion', 'Sat. Oxígeno', [null]) !!}
                {!! Form::number('vitales_saturacion', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('vitales_sys', 'P.A. Sistólica', [null]) !!}
                {!! Form::number('vitales_sys', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('vitales_dia', 'P.A. Diastólica', [null]) !!}
                {!! Form::number('vitales_dia', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 mb-2 mt-3">
                <h4 class="card-title text-success">
                    <b><i class="fas fa-brain"></i> Mental - Psicologia...</b>
                </h4>
            </div>
            <div class="col-sm-12 mb-2 mt-3">
                <h4 class="card-title text-info">
                    <b><i class="fas fa-utensils"></i> Nutricional - Area Nutrición...</b>
                </h4>
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('nutri_peso', 'Peso Kg.', [null]) !!}
                {!! Form::number('nutri_peso', null, ['class'=>'form-control','step'=>'0.01','onChange="imc()"']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('nutri_talla', 'Talla cm.', [null]) !!}
                {!! Form::number('nutri_talla', null, ['class'=>'form-control','step'=>'0.01','onChange="imc()"']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('nutri_perimetro', 'Per. Abdominal', [null]) !!}
                {!! Form::number('nutri_perimetro', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('nutri_edad', 'Edad', [null]) !!}
                {!! Form::number('nutri_edad', Carbon::parse($estudiante->postulante->fechaNacimiento)->age, ['readonly','class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('nutri_imc', 'IMC', [null]) !!}
                {!! Form::number('nutri_imc', null, ['readonly','class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 mb-2 mt-3">
                <h4 class="card-title text-danger">
                    <b><i class="fas fa-flask"></i> Exámenes - Laboratório...</b>
                </h4>
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_glicemia', 'Glicemia', [null]) !!}
                {!! Form::number('lab_glicemia', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_trigliceridos', 'Trigliceridos', [null]) !!}
                {!! Form::number('lab_trigliceridos', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_colesterol', 'Colesterol', [null]) !!}
                {!! Form::number('lab_colesterol', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_hdl', 'HDL', [null]) !!}
                {!! Form::number('lab_hdl', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_ldl', 'LDL', [null]) !!}
                {!! Form::number('lab_ldl', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_hto', 'Hematocrito', [null]) !!}
                {!! Form::number('lab_hto', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_hemoglobina', 'Hemoglobina', [null]) !!}
                {!! Form::number('lab_hemoglobina', null, ['class'=>'form-control','step'=>'0.01']) !!}                
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_gs', 'Gr. Sanguineo', [null]) !!}
                @if(isset($estudiante->pmedico->lab_gs))
                    {!! Form::select('lab_gs', $gss, $estudiante->pmedico->lab_gs, ['class'=>'form-control']) !!}                    
                @else
                {!! Form::select('lab_gs', $gss, null, ['class'=>'form-control']) !!}   
                @endif
            </div>
            <div class="col-sm-12 col-md-2">
                {!! Form::label('lab_fs', 'Fac. Sanguineo', [null]) !!}
                @if(isset($estudiante->pmedico->lab_fs))
                    {!! Form::select('lab_fs', $fss, $estudiante->pmedico->lab_fs, ['class'=>'form-control']) !!} 
                @else
                {!! Form::select('lab_fs', $fss, null, ['class'=>'form-control']) !!}    
                @endif
            </div>
        </div>
    </div>
    <div class="card-footer">
        <button class="btn btn-primary" type="submit">
            <i class="far fa-save"></i> Guardar
        </button>
        <a href="{{ route('salud.acampanias.index') }}" class="btn btn-danger">
            <i class="fas fa-sign-out-alt"></i> Salir
        </a>
    </div>
</div>
{!! Form::close() !!}
@endisset
@stop
@section('js')
<script>
function imc(){
    const peso = parseFloat(document.getElementById('nutri_peso').value);
    const talla =parseFloat(document.getElementById('nutri_talla').value);
    console.log(peso);
    console.log(talla);
    let imc = document.getElementById('nutri_imc');
    let valor = peso / ((talla/100)*(talla/100));
    imc.value = valor.toFixed(2);
}
</script>
@stop