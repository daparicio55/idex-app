//validar que no este vacio
function validar(dni){
    if(dni.length != 8){
        alert("Debe tener almenos 8 digitos");
        return false;
    }
    return true;
}


document.addEventListener('submit',function(event){
    //event.preventDefault();
    event.submitter.setAttribute('disabled',true)
    //console.log(event.submitter.setAttribute('disabled',true));
});

$(document).ready(function(){
setTimeout(() => {
    $("#info").hide();
}, 12000);
});
$(document).ready(function(){
    setTimeout(() => {
    $("#error").hide();
  }, 12000);
});

