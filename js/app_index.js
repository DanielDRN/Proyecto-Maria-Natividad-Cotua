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

document.addEventListener('DOMContentLoaded', function(){
        var registrarse = document.getElementById('Registrarse');
        var loginTitle = document.getElementById('loginTitle');
        var submitBtn = document.getElementById('submitBtn');
        var registroMode = false;

        if (registrarse && submitBtn) {
            registrarse.addEventListener('click', function(){
                registroMode = !registroMode;
                if (registroMode) {
                    submitBtn.name = 'registro';
                    submitBtn.textContent = 'REGISTRARSE';
                    loginTitle.textContent = 'REGISTRAR UN NUEVO USUARIO';
                    registrarse.textContent = '<-- Volver al login';
                } else {
                    submitBtn.name = 'login';
                    submitBtn.textContent = 'INICIAR SESIÓN';
                    loginTitle.textContent = 'INICIA SESIÓN EN TU CUENTA';
                    registrarse.textContent = 'Registrarse';
                }
            });
        }
    });