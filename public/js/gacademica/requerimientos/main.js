document.getElementById('btn_add').addEventListener('click', function(){
    function eliminar(id){
        $('#fila'+id).remove();
    }
    //verificar que tengamos algo seleccionado
    var denominacion = $('#productos').val();
    console.log(denominacion);
    if (denominacion == null || denominacion == ""){
        alert('Seleccione un producto o material');
    }else{
        mostrarPantallaDeCarga();
        //verificamos si el item ya esta presente en la lista
        var id = $("#productos").val();
        /* var deno = $("#productos option:selected").text(); */
        var deno = $('#productos').find('[value='+id+']').text();
        //agregamos una nueva fila
        var elementos = $('[id^="fila'+id+'"]');
        //
        if (elementos.length == 0){                   
            var r = $('<tr></tr>');
            r.attr('id','fila'+id);

            var txt_id = $('<input>');

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
            txt_observacion.attr('required','true');
            txt_observacion.addClass('form-control');

            txt_cantidad.attr('type','number');
            txt_cantidad.attr('name','cantidades[]');
            txt_cantidad.attr('required','true');
            txt_cantidad.addClass('form-control');
            txt_cantidad.css('width','100px');


            td_denominacion.text(deno);
    
            

            r.append(td_denominacion);
            r.append(td_cantidad);
            r.append(td_observacion);
            r.append(td_button);

            $("#table_body").append(r);
            txt_id.appendTo(td_denominacion);
            txt_observacion.appendTo(td_observacion);
            txt_cantidad.appendTo(td_cantidad);
            btn_delete.appendTo(td_button);
        }else{
            alert('Este elemento ya esta en la lista seleccione otro');
        }
        ocultarPantallaDeCarga();
    }
});
