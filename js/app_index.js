function mostrarModal(mensaje) {
    document.getElementById('mensajeError').innerText = mensaje;
    document.getElementById('modalerror').style.display = 'block';
}

document.addEventListener('DOMContentLoaded', function() {
    var cerrar = document.getElementById('cerrarModal');
    if (cerrar) {
        cerrar.onclick = function() {
            document.getElementById('modalerror').style.display = 'none';
        }
    }
    window.onclick = function(event) {
        var modal = document.getElementById('modalerror');
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
});