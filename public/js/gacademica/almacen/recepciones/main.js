function llenarTabla(data){
    let tabla = document.getElementById('tb_productos');
    data.detalles.forEach(element => {
        let fila = document.createElement('tr');
        let td_producto = document.createElement('td');
        let td_cantidad = document.createElement('td');
        let td_serie = document.createElement('td')
        let td_perecible = document.createElement('td')
        let td_botton = document.createElement('td');
        let btn_check = document.createElement('input');
        //btn_check.classList.add('form-check-input');
        btn_check.type="checkbox";
        btn_check.setAttribute('name','check[]');
        btn_check.value = element.id;

        let btn_serie = document.createElement('button');
        let btn_perecible = document.createElement('button');

        if(element.cambio === null){
            td_producto.innerHTML = element.catalogo;
            //verificamos si tiene serie o fecha de vencimiento;
            
            if (element.catalogo.serie){
                
            }
        }else{
            td_producto.innerHTML = element.cambio.catalogo;
        }
        td_cantidad.innerHTML = element.cantidad;
        td_botton.appendChild(btn_check);
        console.log(element);
        fila.appendChild(td_producto);
        fila.appendChild(td_cantidad);
        fila.appendChild(td_serie);
        fila.appendChild(td_perecible);
        fila.appendChild(td_botton);
        tabla.appendChild(fila);
    });
}




function selectocompra(url){
    var ocompra_id = $('#ocompras').val();
    console.log(ocompra_id);
    var ruta = url+'gadministrativa/abastecimiento/ocompras/'+ocompra_id+'/getocompra';
    mostrarPantallaDeCarga();
    fetch(ruta).then(response=>{
        if(!response.ok){
            throw new Error('Error al conseguir datos');
        }
        return response.json();
    }).then(data =>{
        llenarTabla(data);
    }).catch(error=>{
        console.log('Error: '+ error);
    }).finally(function(){
        ocultarPantallaDeCarga();
    });
}