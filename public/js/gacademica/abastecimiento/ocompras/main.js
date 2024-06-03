function delete_cambio(fila,catalogo){
    console.log(fila+":"+catalogo);
    //borrar el span
    let span2 = document.getElementById('span2-'+catalogo);
    span2.remove();
    $('#catalogos').find('[value='+catalogo+']').prop('disabled',false);
    $('#catalogos').val("0");
    $('#catalogos').selectpicker('refresh');
    //cambiar el color del span1
    let span1 = document.getElementById('span1-'+fila);
    span1.classList.remove('text-danger');
}
function changeCatalogo(id){
    document.getElementById('fila_detalle').value = id;
    $('#modal_catalogos').modal('show');
}
function changeprecio(id,cantidad){
    var txt_total = document.getElementById('total'+id);
    var txt_precio = document.getElementById('precio'+id);
    txt_total.innerHTML = parseFloat(txt_precio.value) * cantidad;
}
function llenarTabla(data){
    var tabla = document.getElementById('detalles');
    var tr = document.createElement('tr');
    var td1 = document.createElement('td');
    var txt_id = document.createElement('input');
    txt_id.type = "hidden";
    txt_id.value = data.id;
    txt_id.name ="ids[]";
    var td2 = document.createElement('td');
    var td3 = document.createElement('td');
    var txt_precio = document.createElement('input');
    var td4 = document.createElement('td');
    var td5 = document.createElement('td');
    var btn = document.createElement('button');
    var span1 = document.createElement('span');
    span1.id = "span1-"+data.id;
    span1.innerHTML = data.catalogo;
    btn.innerHTML = '<i class="fas fa-exchange-alt"></i>';
    btn.classList.add('btn','btn-success');
    btn.title = "Cambiar Producto"
    btn.setAttribute('onclick','changeCatalogo('+data.id+')');
    btn.type = "button";
    td1.innerHTML = data.cantidad;
    td1.appendChild(txt_id);
    td2.appendChild(span1);
    td2.id = "td-"+data.id;
    txt_precio.type = "number";
    txt_precio.classList.add('form-control');
//    txt_precio.setAttribute('min','0.01');
    txt_precio.value = 1;
    txt_precio.setAttribute('onchange','changeprecio('+data.id+','+data.cantidad+')');
    txt_precio.id = "precio"+data.id;
    txt_precio.name = "precios[]";
    td3.appendChild(txt_precio);
    td3.style.width = "140px";
    td4.innerHTML = data.cantidad;
    td4.id = 'total'+data.id;
    td5.appendChild(btn);
    tr.appendChild(td1);
    tr.appendChild(td2);
    tr.appendChild(td3);
    tr.appendChild(td4);
    tr.appendChild(td5);
    tabla.appendChild(tr);
}
function getCatalogosExcept(data,url){
    var ids = [];
    data.detalles.forEach(element => {
        ids.push(element.catalogo_id);
    });
    const arrayString = encodeURIComponent(JSON.stringify(ids));
    var ruta = url + `gadministrativa/administracion/getCatalogosExcept?ids=${arrayString}`;
    //ahora tenemos que traer los elementos
    fetch(ruta).then(response=>{
        if(!response.ok){
            throw new error('no se recibieron datos');
        }
        return response.json();
    }).then(data =>{
        //llenamos el select
        data.forEach(element => {
            var cat = document.getElementById('catalogos');
            var opt = document.createElement('option');
            opt.value = element.id;
            opt.innerHTML = element.nombre;
            cat.appendChild(opt);
            $('#catalogos').selectpicker('refresh');
        });
    }).catch(error=>{
        console.error('se producio un error: '+error);
    });
    console.log(ruta);
    //ahora los agregamos a la lista del modal;
    
}
function selectTramite (url){
    var tramite_id = $('#tramites').val();
    $('#detalles').empty();
    var ruta = url+'gadministrativa/administracion/tramites/'+tramite_id+'/gettramite';
    fetch(ruta).then(response =>{
        if(!response.ok){
            throw new Error('Problema al obtener los datos');
        }
        return response.json();
    }).then(data =>{
        data.detalles.forEach(element => {
            llenarTabla(element);
        });
        getCatalogosExcept(data,url);
    }).catch(error=>{
        console.error('Error: ',error);
    });
}
document.getElementById('btn_modal_catalogo_add').addEventListener('click',function(){
    //ahora tengo que agregar una nueva linea
    var id = document.getElementById('fila_detalle');
    var selectedText = $('#catalogos').find("option:selected").text();
    var cat_id = $('#catalogos').val();
    var td_producto = document.getElementById('td-'+id.value);
    var span1 = document.getElementById('span1-'+id.value);
    span1.classList.add('text-danger');
    var span2 = document.createElement('span');
    span2.id = "span2-"+cat_id;
    span2.classList.add('ml-4');
    span2.innerHTML = selectedText;
    //vamos a ponerle el boton de eliminar
    var btn = document.createElement('button');
    btn.classList.add('btn','btn-danger','btn-sm','ml-2');
    btn.innerHTML = '<i class="fas fa-window-close"></i>';
    btn.setAttribute('onclick','delete_cambio('+id.value+','+cat_id+')');
    btn.type="button";
    var text = document.createElement('input');
    text.name = "cambios[]";
    text.value = id.value+":"+cat_id;
    text.type = "hidden";
    span2.appendChild(text);
    span2.appendChild(btn);
    //td_producto.appendChild(span1);
    td_producto.appendChild(span2);
    //tengo que desactivar el catalogo del select
    $('#catalogos').find('[value='+cat_id+']').prop('disabled',true);
    $('#catalogos').val("0");
    $('#catalogos').selectpicker('refresh');
    $('#modal_catalogos').modal('hide');
})