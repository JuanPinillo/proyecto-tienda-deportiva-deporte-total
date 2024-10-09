// script.js

// Función para abrir la modal
function abrirModal(id) {
    document.getElementById(id).style.display = "block";
}

// Función para cerrar la modal
function cerrarModal(id) {
    document.getElementById(id).style.display = "none";
}

// Cerrar la modal al hacer clic fuera de ella
window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = "none";
    }
}
