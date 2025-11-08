
const ModalManager = (function() {
    const modals = {};

    function init() {
        modals.modalBienvenida = document.getElementById('modalBienvenida');
        modals.modalDatosRegistrados = document.getElementById('modalDatosRegistrados');
        modals.modalError = document.getElementById('modalerror');

        addCloseListeners();
        document.addEventListener('click', handleOutsideClick);
        document.addEventListener('keydown', handleEscapeKey);
    }
    
    function abrirModal(id) {
        const modalElement = document.getElementById(id);
        if (modalElement) {
            modalElement.style.display = 'flex'; 
            document.body.style.overflow = 'hidden'; 
        } else {
            console.error(`Modal con ID '${id}' no encontrada.`);
        }
    }


    function cerrarModal(id) {
        const modalElement = document.getElementById(id);
        if (modalElement) {
            modalElement.style.display = 'none';
            if (document.querySelectorAll('.modal:not([style*="display: none"])').length === 0 &&
                document.querySelectorAll('.modal-fondo:not([style*="display: none"])').length === 0) {
                document.body.style.overflow = ''; 
            }
        }
    }

    function cerrarTodasLasModales() {
        document.querySelectorAll('.modal, .modal-fondo, .modal-bienvenida, .datos-registrados').forEach(modal => {
            modal.style.display = 'none';
        });
        document.body.style.overflow = '';
    }

    function addCloseListeners() {
        const btnCerrarError = document.getElementById('cerrarModal');
        if (btnCerrarError) {
            btnCerrarError.onclick = () => cerrarModal('modalerror');
        }
        const btnCerrarRegistro = document.querySelector('.datos-registrados .cerrar-registro');
        if (btnCerrarRegistro) {
            btnCerrarRegistro.onclick = () => cerrarModal('modalDatosRegistrados');
        }

        const btnCerrarBienvenida = document.querySelector('.modal-bienvenida .cerrar-bienvenida');
        if (btnCerrarBienvenida) {
            btnCerrarBienvenida.onclick = () => cerrarModal('modalBienvenida');
        }
        const btnRegistrarse = document.getElementById('Registrarse');
        if (btnRegistrarse) {
        }
    }

    function handleOutsideClick(event) {
        if (event.target.classList.contains('modal') || 
            event.target.classList.contains('modal-bienvenida') ||
            event.target.classList.contains('datos-registrados')) {
            cerrarModal(event.target.id);
        }
    }


    function handleEscapeKey(event) {
        if (event.key === 'Escape') {
            cerrarTodasLasModales();
        }
    }
    document.addEventListener('DOMContentLoaded', init);
    return {
        abrirModal,
        cerrarModal
    };

})();


