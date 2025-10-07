const ModalManager = {
    abrirModal: function(modalId) {
        console.log('Intentando abrir modal:', modalId);
        const modal = document.getElementById(modalId);
        if (modal) {
            console.log('Modal encontrado');
            modal.style.display = 'flex';
            modal.classList.add('show');
        } else {
            console.error('Modal no encontrado:', modalId);
        }
    },
    cerrarModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
        }
    }
};

function abrirModalEditar(id, nombre, apellido, telefono, email, direccion, cedula) {
    document.getElementById('editarId').value = id;
    document.getElementById('editarNombre').value = nombre;
    document.getElementById('editarApellido').value = apellido;
    document.getElementById('editarTelefono').value = telefono;
    document.getElementById('editarCorreo').value = email;
    document.getElementById('editarDireccion').value = direccion;
    document.getElementById('editarCedula').value = cedula;
    ModalManager.abrirModal('editarModal');
};


document.addEventListener('DOMContentLoaded', function() {
    const closeEditarModal = document.getElementById('closeEditarModal');
    if (closeEditarModal) {
        closeEditarModal.onclick = function() {
            ModalManager.cerrarModal('editarModal');
        };
    }
});

window.onclick = function(event) {
    const modalEstudiantes = document.getElementById('modalEstudiantes');
    const modalDetalles = document.getElementById('modalDetalles');
    const modalEditar = document.getElementById('modalEditar');

    if (event.target === modalEditar) {
        modalEditar.style.display = 'none';
    }
    
    if (event.target === modalEstudiantes) {
        modalEstudiantes.style.display = 'none';
    }
    if (event.target === modalDetalles) {
        modalDetalles.style.display = 'none';
    }
};
