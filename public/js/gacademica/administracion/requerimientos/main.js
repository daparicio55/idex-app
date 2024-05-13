$('#mySelect').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
    // do something...
});
//le damos click en el boton agregar del modal
function destino(){
    var select = document.createElement('select');
    select.name = "destinos[]";
    select.classList.add('form-control');
    var op1 = document.createElement('option');
    op1.value = "Almacen";
    op1.innerHTML = "Almacen";
    var op2 = document.createElement('option');
    op2.value = "Abastecimiento";
    op2.innerHTML = "Abastecimiento";
    var op3 = document.createElement('option');
    op3.value = "Caja Chica";
    op3.innerHTML = "Caja Chica";
    select.appendChild(op1);
    select.appendChild(op2);
    select.appendChild(op3);
    return select;
}   
function tabla(id){
    var tabla = document.createElement('table');
    tabla.classList.add('table');
    var t_header = document.createElement('thead');
    var th_row = document.createElement('tr');
    var th1 = document.createElement('th');
    var th2 = document.createElement('th');
    var th3 = document.createElement('th');
    var th4 = document.createElement('th');
    var t_body = document.createElement('tbody');
    t_body.id = "catalogo"+id;
    th1.innerHTML="Catálogo";
    th2.innerHTML="Destino";
    th3.innerHTML="Cantidad";
    th1.classList.add('pt-1','pb-1');
    th2.classList.add('pt-1','pb-1');
    th3.classList.add('pt-1','pb-1');
    th_row.appendChild(th1);
    th_row.appendChild(th2);
    th_row.appendChild(th3);
    th_row.appendChild(th4);
    t_header.appendChild(th_row);
    tabla.appendChild(t_header);
    tabla.appendChild(t_body);
    return tabla;
}
function s_row(id){
    var row = document.createElement('tr');
    var td = document.createElement('td');
    td.setAttribute('colspan','4');
    td.appendChild(tabla(id));
    row.appendChild(td);
    return row;
}
function cat_remove(id){
    $('#cat'+id).remove();
    $('#catalogos').find('[value='+id+']').prop('disabled',false);
    $('#catalogos').val("0");
    $('#catalogos').selectpicker('refresh');
}


document.getElementById('btn_modal_catalogo_add').addEventListener('click',function(){
    var catalogo = document.getElementById('catalogos');
    var cantidad = document.getElementById('cantidad');
    var fila = document.getElementById('fila_detalle');
    var selectedText = $('#catalogos').find("option:selected").text();

    if (catalogo.value == 0){
        alert('Debe seleccionar un catálogo');
    }else{
        var t_body = document.getElementById('catalogo'+fila.value);
        var row = document.createElement('tr');
        row.id = "cat"+catalogo.value;
        var td1 = document.createElement('td');
        var td2 = document.createElement('td');
        var td3 = document.createElement('td');
        var td4 = document.createElement('td');
        var cantidad = document.createElement('input');
        var btn_delete = document.createElement('button');
        var txt = document.createElement('input');
        txt.type = "hidden";
        txt.name = "elementos[]";
        txt.value = fila.value + ':' + catalogo.value;
        btn_delete.type = "button";
        btn_delete.classList.add('btn','btn-danger');
        btn_delete.setAttribute('onClick','cat_remove('+catalogo.value+')');
        btn_delete.innerHTML = '<i class="fas fa-trash-alt"></i>';
        cantidad.type = 'number';
        cantidad.name = "cantidades[]";
        cantidad.setAttribute('min','1');
        cantidad.setAttribute('step','1');
        cantidad.classList.add('form-control');
        td1.innerHTML = selectedText;
        td1.appendChild(txt);
        td2.appendChild(destino());
        td3.appendChild(cantidad);
        td3.style.width = "150px";
        td4.appendChild(btn_delete)
        row.appendChild(td1);
        row.appendChild(td2);
        row.appendChild(td3);
        row.appendChild(td4);
        t_body.appendChild(row);
        //desactivamos el select
        $('#catalogos').find('[value='+catalogo.value+']').prop('disabled',true);
        $('#catalogos').val("0");
        $('#catalogos').selectpicker('refresh');
        $('#modal_catalogos').modal('hide');
    }
});
function add_catalogo(id){    
    //buscamos la cantidad en el array
    var td_cantidad = document.getElementById('cantidad'+id);
    var input_cantidad = document.getElementById('cantidad');
    input_cantidad.value = td_cantidad.innerHTML;
    document.getElementById('fila_detalle').value = id;
    $('#modal_catalogos').modal('show');
}

function llenarFillas(element,tbody){
    var fila = document.createElement('tr');
    fila.id ='fila'+element.id;
    var fsecondary = document.createElement('tr');
    fsecondary.appendChild(tabla());

    var td1 = document.createElement('td');
    var td2 = document.createElement('td');
    var td3 = document.createElement('td');

    var td4 = document.createElement('td');
    var btn_add = document.createElement('button');
    //creando el boton
    btn_add.type = "button";
    btn_add.classList.add("btn","btn-primary");
    btn_add.title = "agregar un catálogo al requerimiento";
    btn_add.innerHTML = '<i class="fas fa-plus-square"></i>';
    btn_add.setAttribute('onClick','add_catalogo('+ element.id +')');
    td4.appendChild(btn_add);
    //
    td1.innerHTML = element.denominacion;
    td2.innerHTML = element.observacion;
    td3.innerHTML = element.cantidad;
    td3.id = "cantidad"+element.id;

    fila.appendChild(td1);
    fila.appendChild(td2);
    fila.appendChild(td3);
    fila.appendChild(td4);
    tbody.appendChild(fila);

    tbody.appendChild(s_row(element.id));
}


function selectTramite(url){
    var requerimiento = $('#requerimiento').val();
    if (requerimiento == ""){
        alert('Seleccione un REQUERIMIENTO');
    }else{
        //vamos a buscar el array
        const ruta = url+'gadministrativa/administracion/requerimientos/'+requerimiento+'/getrequerimiento';
        fetch(ruta)
        .then(response => {
            // Verifica si la respuesta es exitosa (código de estado 200-299)
            if (!response.ok) {
            throw new Error('Hubo un problema al obtener los datos.');
            }
            // Convierte la respuesta en formato JSON
            return response.json();
        })
        .then(data => {
            // Aquí puedes trabajar con los datos obtenidos
            //creamo la tabla la fila 
            var tbody = document.getElementById('requerimientos');
            $('#requerimientos').empty();
            data.detalles.forEach(element => {
                llenarFillas(element,tbody);
            });
        })
        .catch(error => {
            // Captura cualquier error que ocurra durante la solicitud
            console.error('Error:', error);
        });
    }
}