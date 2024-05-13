function refreshMarcas(url){
    mostrarPantallaDeCarga();
    fetch(url)
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
        //vamos a llenar actualizar la lista
        $('#marcas').empty();
        data.forEach(element => {
            var op = $('<option></option>');
            op.val(element.id).text(element.nombre);
            $('#marcas').append(op);
        });
        $('#marcas').selectpicker('refresh');
    })
    .catch(error => {
        // Captura cualquier error que ocurra durante la solicitud
        console.error('Error:', error);
    }).finally(function(){
        ocultarPantallaDeCarga();
    });
}
function createMarca(url){
    mostrarPantallaDeCarga()
    const token = document.getElementsByName('_token')[0].value;
    //tenemos que abrir un modal
    var txt = document.getElementById('newMarca');
    if (txt.value == "")
    {
        alert('Ingrese el nombre de la marca');
        ocultarPantallaDeCarga();
    }else{
        const datosEnviar = {
            nombre: txt.value,
            _token: token
          };
          
          // Opciones de configuración para la solicitud POST
          const opciones = {
            method: 'POST', // Método HTTP
            headers: {
              'Content-Type': 'application/json' // Tipo de contenido que estás enviando (JSON en este caso)
            },
            body: JSON.stringify(datosEnviar) // Convierte los datos a formato JSON
          };
          
          // Haciendo la solicitud POST
          fetch(url, opciones)
            .then(response => {
              // Verifica si la respuesta es exitosa (código de estado 200-299)
              if (!response.ok) {
                throw new Error('Hubo un problema al enviar los datos.');
              }
              // Convierte la respuesta en formato JSON
              return response.json();
            })
            .then(data => {
              // Aquí puedes trabajar con la respuesta de la solicitud POST
              console.log('Respuesta del servidor:', data);
            })
            .catch(error => {
              // Captura cualquier error que ocurra durante la solicitud
              console.error('Error:', error);
            })
            .finally(function(){
                $('#modal-marca').modal('hide');
                txt.value = "";
                ocultarPantallaDeCarga();
            });
    }
    
}
function refreshTipos(url){
    mostrarPantallaDeCarga();
    fetch(url)
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
        //vamos a llenar actualizar la lista
        $('#tipos').empty();
        data.forEach(element => {
            var op = $('<option></option>');
            op.val(element.id).text(element.nombre);
            $('#tipos').append(op);
        });
        $('#tipos').selectpicker('refresh');
    })
    .catch(error => {
        // Captura cualquier error que ocurra durante la solicitud
        console.error('Error:', error);
    })
    .finally(function(){
        ocultarPantallaDeCarga();
    });
}
function createTipo(url){
    mostrarPantallaDeCarga();
    const token = document.getElementsByName('_token')[0].value;
    //tenemos que abrir un modal
    var txt = document.getElementById('newTipo');
    if (txt.value == "")
    {
        alert('Ingrese el nombre del tipo');
        ocultarPantallaDeCarga();
    }else{
        const datosEnviar = {
            nombre: txt.value,
            _token: token
          };
          
          // Opciones de configuración para la solicitud POST
          const opciones = {
            method: 'POST', // Método HTTP
            headers: {
              'Content-Type': 'application/json' // Tipo de contenido que estás enviando (JSON en este caso)
            },
            body: JSON.stringify(datosEnviar) // Convierte los datos a formato JSON
          };
          
          // Haciendo la solicitud POST
          fetch(url, opciones)
            .then(response => {
              // Verifica si la respuesta es exitosa (código de estado 200-299)
              if (!response.ok) {
                throw new Error('Hubo un problema al enviar los datos.');
              }
              // Convierte la respuesta en formato JSON
              return response.json();
            })
            .then(data => {
              // Aquí puedes trabajar con la respuesta de la solicitud POST
              console.log('Respuesta del servidor:', data);
            })
            .catch(error => {
              // Captura cualquier error que ocurra durante la solicitud
              console.error('Error:', error);
            })
            .finally(function(){
                $('#modal-tipo').modal('hide');
                txt.value = "";
                ocultarPantallaDeCarga();
            });
    }
}
function refreshUnidades(url){
    mostrarPantallaDeCarga();
    fetch(url)
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
        //vamos a llenar actualizar la lista
        $('#unidades').empty();
        data.forEach(element => {
            var op = $('<option></option>');
            op.val(element.id).text(element.nombre);
            $('#unidades').append(op);
        });
        $('#unidades').selectpicker('refresh');
    })
    .catch(error => {
        // Captura cualquier error que ocurra durante la solicitud
        console.error('Error:', error);
    })
    .finally(function(){
        ocultarPantallaDeCarga();
    });
}
function createUnidade(url){
    mostrarPantallaDeCarga();
    const token = document.getElementsByName('_token')[0].value;
    //tenemos que abrir un modal
    var txt = document.getElementById('newUnidad');
    if (txt.value == "")
    {
        alert('Ingrese el nombre de la nueva unidad de medida');
        ocultarPantallaDeCarga();
    }else{
        const datosEnviar = {
            nombre: txt.value,
            _token: token
          };
          
          // Opciones de configuración para la solicitud POST
          const opciones = {
            method: 'POST', // Método HTTP
            headers: {
              'Content-Type': 'application/json' // Tipo de contenido que estás enviando (JSON en este caso)
            },
            body: JSON.stringify(datosEnviar) // Convierte los datos a formato JSON
          };
          
          // Haciendo la solicitud POST
          fetch(url, opciones)
            .then(response => {
              // Verifica si la respuesta es exitosa (código de estado 200-299)
              if (!response.ok) {
                throw new Error('Hubo un problema al enviar los datos.');
              }
              // Convierte la respuesta en formato JSON
              return response.json();
            })
            .then(data => {
              // Aquí puedes trabajar con la respuesta de la solicitud POST
              console.log('Respuesta del servidor:', data);
            })
            .catch(error => {
              // Captura cualquier error que ocurra durante la solicitud
              console.error('Error:', error);
            })
            .finally(function(){
                $('#modal-unidad').modal('hide');
                txt.value = "";
                ocultarPantallaDeCarga();
            });
    }
}