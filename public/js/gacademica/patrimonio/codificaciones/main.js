function selectrecepcion(url){
    mostrarPantallaDeCarga();
    let id = document.getElementById('recepciones').value;
    let ruta = url+'gadministrativa/almacen/recepciones/'+id+'/getrecepcione';
    fetch(ruta).then(response=>{
        if(!response.ok){
            throw new Error('Ocurrio un error');
        }
        return response.json();
    }).then(data=>{
        console.log(data);
    }).catch(error=>{
        console.log(error);
    }).finally(()=>{
        ocultarPantallaDeCarga();
    });
}