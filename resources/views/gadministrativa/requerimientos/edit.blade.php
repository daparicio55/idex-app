@extends('adminlte::page')

@section('title', 'Editar Requerimiento | SISGE')

@section('content_header')
    <h1>Editar Requerimiento</h1>
@stop

@section('content')
{!! Form::open(['route'=>['gadministrativa.requerimientos.update',$requerimiento->id],'method'=>'PUT','id'=>'frm']) !!}
<x-adminlte-card title="Datos del requerimiento" theme="info" icon="fas fa-lg fa-bell" collapsible>
    <div class="row">
        <div class="col-sm-12">
            <label for="encabezado">Encabezado</label>
            <textarea name="encabezado" id="encabezado" rows="3" class="form-control" required>{{ $requerimiento->encabezado }}</textarea>
        </div>
        <div class="col-sm-12">
            <label for="asunto" class="mt-2">Asunto</label>
            <textarea name="asunto" id="asunto" rows="3" class="form-control" required>{{ $requerimiento->asunto }}</textarea>
        </div>
        <div class="col-sm-12">
            <label for="Justificación" class="mt-2">Justificación</label>
            <textarea name="justificacion" id="justificacion" rows="10" class="form-control" required>{{ $requerimiento->justificacion }}</textarea>
        </div>

    </div>
</x-adminlte-card>
<x-adminlte-card title="Agregar materiales y/o productos" theme="primary" icon="fas fa-list-ol" collapsible>
    <div class="row">
        <div class="col-sm-12 col-md-6">
            <label for="grupo">Grupo</label>
            <select name="grupo" id="grupo" class="form-control selectpicker" data-live-search=true data-size=10 >
                <option value="" disabled selected>Seleccione una grupo</option>
                
            </select>
        </div>
        <div class="col-sm-12 col-md-6">
            <label for="clase">Clase</label>
            <select name="clase" id="clase" class="form-control selectpicker" data-live-search=true data-size=10>
                <option value="" disabled selected>Seleccionar una clase</option>
                
            </select>
        </div>
        <div class="col-sm-12">
            <label for="" class="mt-2">Catalogo Nacional</label>
            <select name="denominacion" id="denominacion" class="form-control selectpicker" data-live-search=true data-size=10>
                <option value="" disabled selected>Seleccione un producto</option>
                
            </select>
        </div>
    </div>
    <x-slot name="footerSlot">
        <button type="button" id="btn_add" class="btn btn-primary">
            <i class="fas fa-save"></i> Agregar
        </button>
    </x-slot>
</x-adminlte-card>
<x-adminlte-card title="Lista de materiales y/o productos" theme="success" icon="fas fa-list-ol" collapsible>
    <div class="responsive-table">
        <table class="table">
            <thead>
                <tr>
                    <th>Grupo</th>
                    <th>Clase</th>
                    <th>Denominación</th>
                    <th>Cant.</th>
                    <th>Observación</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="table_body">
                @foreach ($requerimiento->re_detalles as $requerimiento)
                    <tr id="fila{{ $requerimiento->ncatalogo->id }}">
                        <td>
                            <input type="hidden" name="ids[]" value="{{ $requerimiento->ncatalogo->id }}">
                            {{ $requerimiento->ncatalogo->grupo }}
                        </td>
                        <td>{{ $requerimiento->ncatalogo->clase }}</td>
                        <td>{{ $requerimiento->ncatalogo->denominacion }}</td>
                        <td>
                            <input type="number" class="form-control" name="cantidades[]" style="width: 100px" value="{{ $requerimiento->cantidad }}">
                        </td>
                        <td>
                            <input type="text" name="observaciones[]" class="form-control" value="{{ $requerimiento->observacion }}">                            
                        </td>
                        <td>
                            <button type="button" class="btn btn-danger" onclick="eliminar({{ $requerimiento->ncatalogo->id }})">
                                <i class="fas fa-minus-circle"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <x-slot name="footerSlot">
        <button type="submit" class="btn btn-success">
            <i class="fas fa-save"></i> Guardar
        </button>
    </x-slot>
</x-adminlte-card>
{!! Form::close() !!}
@stop
@section('js')
    <script>
        function eliminar(id){
            $('#fila'+id).remove();
        }
        $(document).ready(function() {
            
            // Tu código aquí se ejecutará cuando el DOM esté completamente cargado
            var datos;
            var ruta = "{{ route('gadministrativa.nacionalcatalogos.getCatalogos') }}";
            $.ajax({
            url: ruta,
            type: 'GET',
            success: function(data) {
                // Manejar los datos de la respuesta
                //console.log('Datos recibidos:', data);
                datos = data;
                data.forEach(element => {
                    var nuevaOpcion = $("<option></option>");
                    nuevaOpcion.val(element.grupo).text(element.grupo);
                    $("#grupo").append(nuevaOpcion);
                    //console.log(element.grupo);
                });
                $('#grupo').selectpicker('refresh');
            },
            error: function(xhr, status, error) {
                // Manejar errores
                console.error('Error:', error);
            }
            });
            //cuando se da click en el select del grupo
            $('#grupo').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var elementoSeleccionado = $(e.target).val();
                //vamos a borrar el elementos clases;
                $('#clase').empty();
                var nuevaOpcion = $("<option></option>");
                nuevaOpcion.val("").text("Seleccionar una clase");
                $('#clase').append(nuevaOpcion);
                $('#clase').selectpicker('refresh');
                datos.forEach(element => {
                    if(element.grupo == elementoSeleccionado){
                        element.clases.forEach(clase => {
                            //console.log(clase.clase);
                            var nuevaOpcion = $("<option></option>");
                            nuevaOpcion.val(clase.clase).text(clase.clase);
                            $('#clase').append(nuevaOpcion);
                        });
                        $('#clase').selectpicker('refresh');
                    }
                });
            });
            //cuando se da click en el select de la clase
            $('#clase').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
                var grupo = $('#grupo').val();
                var clase = $(e.target).val();
                //borrar los elementos de la lista denominacion
                $('#denominacion').empty();
                var nuevaOpcion = $("<option></option>");
                nuevaOpcion.val("").text("Seleccionar un producto");
                $('#denominacion').append(nuevaOpcion);
                $('#denominacion').selectpicker('refresh');
                //##
                datos.forEach(element => {
                    if(element.grupo == grupo){
                        element.clases.forEach(cla => {
                            if(cla.clase == clase){
                                cla.catalogos.forEach(cat => {
                                    var nuevaOpcion = $("<option></option>");
                                    nuevaOpcion.val(cat.id).text(cat.denominacion);
                                    $('#denominacion').append(nuevaOpcion);
                                });
                            }
                        });
                    }
                });
                $('#denominacion').selectpicker('refresh');
            });
            
            $('#btn_add').on('click', function(){
                //verificar que tengamos algo seleccionado
                var denominacion = $('#denominacion').val();
                if (denominacion == null || denominacion == ""){
                    alert('Seleccione un producto o material');
                }else{
                    //verificamos si el item ya esta presente en la lista
                    
                    var grupo = $("#grupo").val();
                    var clase = $("#clase").val();
                    var id = $("#denominacion").val();
                    var deno = $("#denominacion option:selected").text();
                    //agregamos una nueva fila
                    var elementos = $('[id^="fila'+id+'"]');
                    console.log();
                    //
                    if (elementos.length == 0){                   
                        var r = $('<tr></tr>');
                        r.attr('id','fila'+id);
                        var td_grupo = $('<td></td>');
                        var txt_id = $('<input>');
                        var td_clase = $('<td></td>');
                        var td_denominacion = $('<td></td>');
                        var td_cantidad = $('<td></td>');
                        var td_observacion = $('<td></td>');
                        var td_button = $('<td></td>');
                        var txt_observacion = $('<input>');
                        var txt_cantidad = $('<input>');
                        var btn_delete = $('<button></button>');
                        btn_delete.html('<i class="fas fa-minus-circle"></i>');
                        btn_delete.attr('type','button');
                        btn_delete.addClass('btn');
                        btn_delete.addClass('btn-danger');
                        btn_delete.attr('title','Eliminar Item');
                        btn_delete.click(function() {
                            eliminar(id); // Aquí puedes pasar el argumento que necesites
                        });

                        txt_id.attr('type','hidden');
                        txt_id.attr('name','ids[]');
                        txt_id.val(id);

                        txt_observacion.attr('type','text');
                        txt_observacion.attr('name','observaciones[]');
                        txt_observacion.addClass('form-control');

                        txt_cantidad.attr('type','number');
                        txt_cantidad.attr('name','cantidades[]');
                        txt_cantidad.addClass('form-control');
                        txt_cantidad.css('width','100px');

                        td_grupo.text(grupo);
                        td_clase.text(clase);
                        td_denominacion.text(deno);
                
                        
                        r.append(td_grupo);
                        r.append(td_clase);
                        r.append(td_denominacion);
                        r.append(td_cantidad);
                        r.append(td_observacion);
                        r.append(td_button);

                        $("#table_body").append(r);
                        txt_id.appendTo(td_grupo);
                        txt_observacion.appendTo(td_observacion);
                        txt_cantidad.appendTo(td_cantidad);
                        btn_delete.appendTo(td_button);
                    }else{
                        alert('Este elemento ya esta en la lista seleccione otro');
                    }
                }
            });
        });
    </script>
@stop