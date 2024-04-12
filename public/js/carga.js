function mostrarPantallaDeCarga() {
    const loader = document.getElementById('loader-wrapper');
    loader.style.display = "flex";
    loader.style.opacity = '1'; // Establece la opacidad al 100%
    }
    // Ocultar la pantalla de carga con un efecto fade
function ocultarPantallaDeCarga() {
    const loader = document.getElementById('loader-wrapper');
    loader.style.display = "none";
    loader.style.opacity = '0'; // Establece la opacidad al 0%
}