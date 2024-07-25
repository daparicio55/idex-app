//variables
let URL = $('#url').val();
//desactiva boton de guardar del formulario
$('#frm').submit(function(event){
    $('#btn_guardar').attr('disabled',true);
});
//copia el correo electrónico del estudiante
document.getElementById('btn_mail').addEventListener('click',function(){
    let dni = document.getElementById('searchText');
    let text = dni.value + '@idexperujapon.edu.pe';
    document.getElementById('email').value = text;
});
//funcion para limiar la tabla
function clearTable(){
    $('#cprogramas tr').each(function(){ 
        this.remove();
    });
}
//funcion para buscar por DNI
function buscardni(){
    var dni = document.getElementById("searchText").value;
    if (dni.trim() == ""){
        alert('Ingrese un texto para buscar');
    }else{
        document.getElementById('deudas').style.display = "none";
        /* limpiar la tabla */
        this.clearTable();
        var HTMLResponse = document.querySelector("#cprogramas");
        var API_URL = URL+"estudiantepestudio/dni/"+dni;
        fetch(API_URL).then((response)=>response.json()).then((programas)=>{
            programas.forEach(programa=>{
                var tr = document.createElement('tr');
                var td1 = document.createElement('td');
                var td2 = document.createElement('td');
                var td3 = document.createElement('td');
                var td4 = document.createElement('td');
                var td5 = document.createElement('td');
                var td6 = document.createElement('td');
                /* vamos asignar los valores */
                td1.appendChild(document.createTextNode(programa.idCliente));
                td2.appendChild(document.createTextNode(programa.dniRuc));
                td3.appendChild(document.createTextNode(programa.Apellido + ', ' + programa.Nombre));
                td4.appendChild(document.createTextNode(programa.programa));
                /*botones  */
                var btn = document.createElement("button");
                btn.setAttribute('class','btn btn-primary');
                btn.setAttribute('onclick','eleccion('+programa.estudiante_id+')');
                btn.appendChild(
                    document.createTextNode('+')
                );
                td5.appendChild(btn);
                tr.appendChild(td1);
                tr.appendChild(td2);
                tr.appendChild(td3);
                tr.appendChild(td4);
                tr.appendChild(td5);
                HTMLResponse.appendChild(tr);
            });
        });
        $('#modal-pestudios').modal('show');
    }
}