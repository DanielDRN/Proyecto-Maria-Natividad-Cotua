window.ModalManager = {
mostrarModal: function (idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
        modal.classList.add('mostrar');
    } else {
        console.warn(`No se encontró la modal con id: ${idModal}`);
    }
},

cerrarModal: function (idModal) {
    const modal = document.getElementById(idModal);
    if (modal) {
    modal.classList.remove('mostrar');
    } else {
        console.warn(`No se encontró la modal con id: ${idModal}`);
    }
},

inicializarEventos: function () {
    const btnCerrar = document.getElementById('btnCerrarModalEstudiantes');
    if (btnCerrar) {
    btnCerrar.addEventListener('click', () => {
        ModalManager.cerrarModal('modalEstudiantes');
    });
    }
}
};

document.addEventListener('DOMContentLoaded', () => {
ModalManager.inicializarEventos();
});
