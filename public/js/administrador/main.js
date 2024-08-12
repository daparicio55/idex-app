function normalizar_nombres(ruta){
    console.log(ruta);
    mostrarPantallaDeCarga();
    fetch(ruta).then(response => {
      if (!response.ok){
        throw new Error('Error en la solicitud');
      }
    return response.json();
    }).then(data => {
      console.log(data);
    }).catch(error=>{
      console.log(error);
    }).finally(()=>{
      ocultarPantallaDeCarga();
    });
}
