@extends('adminlte::page')

@section('title', 'Convalidacion Registro')

@section('content_header')
    <h1><i class="far fa-address-book text-success"></i> Nuevo Registro de Convalidacion</h1>
@stop
@section('content')
{{-- buscamos por numero de dni --}}
{!! Form::open(['method'=>'get','role'=>'search','route'=>'sacademica.convalidaciones.create']) !!}
<div class='form-group'>
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="Ingrese DNI a buscar ..." @if(isset($searchText)) value="{{$searchText}}" @endif >
        <span class="input-group-btn">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-binoculars"></i> Buscar
            </button>
        </span>

    </div>
</div>
{!! Form::close() !!}

{!! Form::open(['id'=>'frm','method'=>'post','route'=>'sacademica.convalidaciones.store','autocomplete'=>'off']) !!}
@if (isset($estudiante))
    {!! Form::hidden('estudiante_id', $estudiante->id, [null]) !!}    
@endif
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-database"></i> Datos Personales.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('apellido', 'Apellidos', [null]) !!}
                    <input type="text" name="apellido" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->apellido}}@endif" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('nombre', 'Nombres', [null]) !!}
                    <input type="text" name="nombre" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->nombre}}@endif" class="form-control" disabled required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono', 'Telefono Llamadas', [null]) !!}
                    <input type="text" name="telefono" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->telefono}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('telefono2', 'Telefono WhatsApp', [null]) !!}
                    <input type="text" name="telefono2" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->telefono2}}@endif" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('fechaNacimiento', 'F. Nacimiento', [null]) !!}
                    <input type="text" disabled name="fechaNacimiento" value="@if(isset($estudiante)){{date('d-m-Y',strtotime($estudiante->postulante->fechaNacimiento))}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('sexo', 'Sexo', [null]) !!}
                    <input type="text" name="sexo" disabled value="@if(isset($estudiante)){{$estudiante->postulante->sexo}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('discapacidad', 'Discapacidad', [null]) !!}
                    <input type="text" name="discapacidad" disabled value="@if(isset($estudiante))@if($estudiante->postulante->discapacidad == 0){{'SI'}}@else{{'NO'}}@endif  @endif" class="form-control" required>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    {!! Form::label('discapacidadNombre', '¿Que discapacidad tiene?', [null]) !!}
                    <input type="text" name="discapacidadNombre" disabled value="@if(isset($estudiante)){{$estudiante->postulante->discapacidadNombre}}@endif" class="form-control" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('email', 'Correo', [null]) !!}
                    <input type="text" name="email" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->email}}@endif" class="form-control" required>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                    {!! Form::label('direccion', 'Dirección', [null]) !!}
                    <input type="text" name="direccion" value="@if(isset($estudiante)){{$estudiante->postulante->cliente->direccion}}@endif" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos de el programa de estudios --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-user-graduate"></i> Datos de Programa de Estudios.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                    {!! Form::label('carrera_id','Nombre' , [null]) !!}
                    <input type="text" disabled name="carrera_id" value="@if(isset($estudiante)){{$estudiante->postulante->carrera->nombreCarrera}}@endif" class="form-control" required>                    
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('admisione_id','A. Ingreso' , [null]) !!}
                    <input type="text" disabled name="admisione_id" value="@if(isset($estudiante)){{$estudiante->postulante->admisione->periodo}}@endif" class="form-control" required>                    
                </div>
            </div>
        </div>
    </div>
</div>
{{-- datos de la fecha del periodo academico --}}
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="far fa-calendar-alt"></i> Periodo Académico.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('pmatricula_id', 'Periodo', [null]) !!}
                    {!! Form::select('pmatricula_id', $periodos, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label('tipo', 'Tipo', [null]) !!}
                    {!! Form::select('tipo', $tipo, null, ['class'=>'form-control']) !!}
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                    {!! Form::label('fecha', 'Fecha', [null]) !!}
                    {!! Form::date('fecha', null, ['class'=>'form-control','required']) !!}
                </div>
                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
                    {!! Form::label('resolucion', 'Resolucion', [null]) !!}
                    {!! Form::text('resolucion', null, ['class'=>'form-control','required']) !!}
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card col-lg-12">
        <div class="card-header">
            <h4><i class="fas fa-book-reader"></i> Unidades Didacticas.</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    {!! Form::label(null, 'Ciclo', [null]) !!}
                    {!! Form::select('ciclo', ciclos(), null, ['id'=>'ciclo','class'=>'form-control']) !!}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    {!! Form::label(null, 'Tipo', [null]) !!}
                    {!! Form::select('tipoMatricula', $tipo, null, ['id'=>'tipoMatricula','class'=>'form-control']) !!}
                </div>
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    {!! Form::label('creditos', 'Creditos', [null]) !!}
                    {!! Form::text('creditos', 0, ['class'=>'form-control','id'=>'creditos','disabled']) !!}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <a href="" data-target="#modal-unidades" data-toggle="modal">
                        <button class="btn btn-success" id="btn_unidades">Unidades Didacticas</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
{{-- lista de unidades --}}
@if (isset($unidades))
<div class="row">
    <div class="col-lg-12 col-sm-12 col-md-12 col-xs-12">
        <table id="detalles" class="table table-striped table-bordered table-condensed table-hover">
            <thead style="background-color:#A9D0F5">
                <th style="width: 5%">Ciclo</th>
                <th style="width: 10%">Tipo</th>
                <th>Unidad Didáctiva</th>
                <th style="width: 5%">Creditos</th>
                <th style="width: 10%">Nota</th>
                <th style="width: 1%">ID</th>
            </thead>
            <tbody>
                
            </tbody>
            <tfoot>
                    
            </tfoot>
        </table>
    </div> 
</div>
@endif

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <button type="submit" id="btn_guardar" class="btn btn-primary">
            <i class="fas fa-save" title="guardar"></i> Guardar
        </button>
{!! Form::close() !!}
@if (isset($unidades))
    @include('sacademica.convalidaciones.modal')    
@endif
        <a class="btn btn-danger" href="{{route('sacademica.matriculas.index')}}">
            <i class="fas fa-backward" title="salir"> </i> Regresar
        </a>
    </div>
</div>
@stop
@section('js')
    <script>
    $('#frm').submit(function(event){
        $('#btn_guardar').attr('disabled',true);
    });
    $('#btn_unidades').click(function(){
        modalUnidades();
    });
    function modalAgregar(index){
        //vamos a recuperar los valores de la fila que se le dio click
        id = $("#fila"+index).find("td:eq(0)").html();
        ciclo = $("#fila"+index).find("td:eq(1)").html();
        modulo = $("#fila"+index).find("td:eq(2)").html();
        tipo = $("#fila"+index).find("td:eq(3)").html();
        unidad = $("#fila"+index).find("td:eq(4)").html();
        creditos = $("#fila"+index).find("td:eq(5)").html();
        tcreditos = $("#creditos").val();
        tmatricula = $("#tipoMatricula").val();
        if((Number(tcreditos) + Number(creditos))>100){
            alert('no se pueden exceder los 100 creditos');
        }else{
            //sumamos los creditos
            tcreditos = Number(tcreditos) + Number(creditos);
            $("#creditos").val(tcreditos);
            var fila='<tr class="selected" id="filaa'+id+'"><td><input type="hidden" name="idUniDidactica[]" value="'+id+'">'+ciclo+'</td><td>'+tipo+'</td><td>'+unidad+'</td><td>'+creditos+'</td><td>'+'<input name="notas[]" type="number" class="form-control">'+'</td><td>'+id+'</td><td><button type="button" class="btn btn-warning" onClick="eliminar('+id+')">X</button></td></tr>';
            //ocultar la fila actual.
            $("#fila"+index).each(function(){
                $(this).find("td").hide();
            });
            //agregar la fila.
            $('#detalles').append(fila);
        }
    }
    function modalUnidades(){
        //primero tengo q poner visibles todas
        $('#tb_unidades').find("tbody tr").each(function(){
            $(this).find("td").show();
        });
        //ocultamos los que son de diferente ciclo
        $('#tb_unidades').find("tbody tr").each(function(){
            ci = $(this).find("td:eq(1)").html();
            id = $(this).find("td:eq(0)").html();
            existe = 0;
            if (ci != $('#ciclo').val()){
                $(this).find("td").hide();
            }
        });
        //oculatamos los que ta estan en la lista
        $('#tb_unidades').find("tbody tr").each(function(){
            existe = 0;
            id = $(this).find("td:eq(0)").html();
            $('#detalles').find("tbody tr").each(function(){
                idd = $(this).find("td:eq(5)").html();
                if(id==idd){
                    existe = 1;
                }
            });
            if(existe == 1){
                $(this).find("td").hide();
            }
        });
    }
    function eliminar(index)
        {
            cre = $("#filaa"+index).find("td:eq(3)").html();
            creditos = $("#creditos").val();
            creditos = Number(creditos) - Number(cre);
            $("#creditos").val(creditos);
            $("#filaa"+index).remove();
        }
    </script>
@stop