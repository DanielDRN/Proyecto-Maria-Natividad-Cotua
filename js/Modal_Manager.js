const ModalManager = {
    abrirModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'block';
        }
    },
    
    cerrarModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
        }
    }
};

window.onclick = function(event) {
    const modalEstudiantes = document.getElementById('modalEstudiantes');
    const modalDetalles = document.getElementById('modalDetalles');
    
    if (event.target === modalEstudiantes) {
        modalEstudiantes.style.display = 'none';
    }
    if (event.target === modalDetalles) {
        modalDetalles.style.display = 'none';
    }
};