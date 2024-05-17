function modal_series(id,cantidad,nombre){
    console.log(id);
}
function modal(id,cantidad,nombre){
let modalfade = document.createElement('div');
modalfade.classList.add('modal','fade');
modalfade.setAttribute('tabindex','-1');
modalfade.setAttribute('aria-labelledby','exampleModalLabel');
modalfade.setAttribute('aria-hidden','true');

modalfade.setAttribute('id',nombre+'-'+id);


let modaldialog = document.createElement('div');
modaldialog.classList.add('modal-dialog');

let modalcontent = document.createElement('div');
modalcontent.classList.add('modal-content');


let modalheader = document.createElement('div');
modalheader.classList.add('modal-header');
let h_header = document.createElement('h5');
h_header.classList.add('modal-title');

if (nombre == "serie"){
    h_header.innerHTML = "Números de SERIE";
}else{
    h_header.innerHTML = "Fechas de VENCIMIENTO";
}
let btn_close = document.createElement('button');
btn_close.type = "button";
btn_close.classList.add('close');
btn_close.setAttribute('data-dismiss','modal');
btn_close.setAttribute('aria-label','Cerrar');
let btn_span = document.createElement('span');
btn_span.setAttribute('aria-hidden','true');
btn_span.innerHTML = "&times;";
btn_close.appendChild(btn_span);

modalheader.appendChild(h_header);
modalheader.appendChild(btn_close);

let modalbody = document.createElement('div');
modalbody.classList.add('modal-body');


let formgroup = document.createElement('div');
formgroup.classList.add('form-group');

for (let index = 0; index < cantidad; index++) {
    if(nombre == "perecible"){
        let input = document.createElement('input');
        input.type = "date";
        input.classList.add('form-control','mb-2');
        let orden = index+1;
        input.setAttribute('required','true');
        input.setAttribute('placeholder','Fecha de vencimiento '+ orden);
        input.name = "perecible"+id+"[]";
        formgroup.appendChild(input);
    }
    if (nombre == "serie"){
        let input = document.createElement('input');
        input.type = "text";
        input.classList.add('form-control','mb-2');
        let orden = index+1;
        input.setAttribute('placeholder','Número de serie '+ orden);
        input.setAttribute('required','true');
        input.name = "serie"+id+"[]";
        formgroup.appendChild(input);
    }
}



modalbody.appendChild(formgroup);

let modalfooter = document.createElement('div');
modalfooter.classList.add('modal-footer');

let btn_footer_close = document.createElement('button');
btn_footer_close.classList.add('btn','btn-secondary');
btn_footer_close.setAttribute('data-dismiss','modal');
btn_footer_close.innerHTML = "Cerrar";
let btn_footer_save = document.createElement('button');
btn_footer_save.classList.add('btn','btn-primary');

modalfooter.appendChild(btn_footer_close);
//modalfooter.appendChild(btn_footer_save);

modalcontent.appendChild(modalheader);
modalcontent.appendChild(modalbody);
modalcontent.appendChild(modalfooter);

modaldialog.appendChild(modalcontent);

modalfade.appendChild(modaldialog);

return modalfade;
}

function llenarTabla(data){
    let tabla = document.getElementById('tb_productos');
    $('#tb_productos').empty();
    data.detalles.forEach(element => {
        let fila = document.createElement('tr');
        let td_producto = document.createElement('td');
        let td_cantidad = document.createElement('td');
        let td_serie = document.createElement('td');
        let td_perecible = document.createElement('td');
        let td_botton = document.createElement('td');
        let btn_check = document.createElement('input');
        //btn_check.classList.add('form-check-input');
        btn_check.type="checkbox";
        btn_check.classList.add('form-control');
        btn_check.setAttribute('name','check[]');
        btn_check.value = element.id;

        let btn_serie = document.createElement('button');
        let btn_perecible = document.createElement('button');
        btn_serie.innerHTML = "num. series";
        btn_serie.classList.add('btn','btn-danger');
        btn_serie.type = "button";

        btn_perecible.innerHTML = "vencimiento";
        btn_perecible.classList.add('btn','btn-danger');
        btn_perecible.type = "button";

        if(element.cambio === null){
            td_producto.innerHTML = element.catalogo;
            //verificamos si tiene serie
            if(element.serie == 1){
                btn_serie.setAttribute("data-toggle",'modal');
                btn_serie.setAttribute("data-target","#"+"serie-"+element.id);
                td_serie.appendChild(btn_serie);
                td_serie.appendChild(modal(element.id,element.cantidad,"serie"));
            }else{
                td_serie.innerHTML = "no aplica";
            }
            //verificamos si tiene f. de vencimiento
            if(element.perecible == 1){
                btn_perecible.setAttribute("data-toggle",'modal');
                btn_perecible.setAttribute("data-target","#"+"perecible-"+element.id);
                td_perecible.appendChild(btn_perecible);
                td_perecible.appendChild(modal(element.id,element.cantidad,"perecible"));
            }else{
                td_perecible.innerHTML = "no aplica";
            }
        }else{
            td_producto.innerHTML = element.cambio.catalogo;
            //verificamos si tiene serie o fecha de vencimiento;
            if(element.cambio.serie == 1){
                btn_serie.setAttribute("data-toggle",'modal');
                btn_serie.setAttribute("data-target","#"+"serie-"+element.id);
                td_serie.appendChild(btn_serie);
                td_serie.appendChild(modal(element.id,element.cantidad,"serie"));
            }else{
                td_serie.innerHTML = "no aplica";
            }
            //verificamos si tiene f. de vencimiento
            if(element.cambio.perecible == 1){
                btn_perecible.setAttribute("data-toggle",'modal');
                btn_perecible.setAttribute("data-target","#"+"perecible-"+element.id);
                td_perecible.appendChild(btn_perecible);
                td_perecible.appendChild(modal(element.id,element.cantidad,"perecible"));
            }else{
                td_perecible.innerHTML = "no aplica";
            }
        }
        td_cantidad.innerHTML = element.cantidad;
        td_botton.appendChild(btn_check);
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
