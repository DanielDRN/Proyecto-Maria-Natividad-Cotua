const ModalManager = {
    abrirModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'flex';
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
        } else {
            console.error('Modal no encontrado:', modalId);
        }
    },
    cerrarModal: function(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.style.display = 'none';
            modal.classList.remove('show');
            if (!document.querySelector('.modal-fondo[style*="flex"]')) { 
                 document.body.style.overflow = '';
            }
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
}

document.addEventListener('DOMContentLoaded', () => {
    const botonesVerEstudiantes = document.querySelectorAll('.ver-estudiantes-btn');
    const modalEstudiantes = document.getElementById('modalEstudiantes');
    const modalTitulo = document.getElementById('modalTitulo');
    const listaEstudiantes = document.getElementById('listaEstudiantes');

    const modalDetalles = document.getElementById('modalDetalles');
    const modalDetallesInfo = document.getElementById('modalDetallesInfo');
    const modalDetallesTitulo = document.getElementById('modalDetallesTitulo');
    const fotoEstudiante = document.getElementById('fotoEstudiante'); 
    const fotoEstudianteInput = document.getElementById('fotoEstudianteInput');
    const guardarFotoBtn = document.getElementById('guardarFotoBtn');
    let estudianteIdActual = null;
    
    const inputBuscador = document.getElementById('buscador');
    const footer = document.getElementById('footer');
    const tablaRepresentantes = document.querySelector('table');
    const filas = tablaRepresentantes ? tablaRepresentantes.getElementsByTagName('tr') : [];
    
    const modalRegistroEstudiante = document.getElementById('modalAgregarEstudiante');
    const btnCerrarHeaderRegistro = document.getElementById('btnCerrarModal');
    const btnCerrarFooter = document.getElementById('btnCerrarModalFooter');
    
    const modalEditar = document.getElementById('editarModal');
    const closeEditarModal = document.getElementById('closeEditarModal');
    
    const inputHiddenRepID = document.getElementById('hidden_id_representante'); 
    
    function parseResponseFlexible(response) {
        return response.text()
            .then(text => {
                try {
                    const parsed = JSON.parse(text);
                    return parsed;
                } catch (e) {
                    return { isHtml: true, raw: text, status: response.status };
                }
            })
            .catch(err => {
                return { isHtml: true, raw: String(err), status: (response && response.status) ? response.status : 0 };
            });
    }
    function escapeHTML(str) {
        if (str === null || str === undefined) return '';
        return String(str)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function updateFooterPosition() {
        if (!footer || !tablaRepresentantes) return;

        const filasActuales = Array.from(tablaRepresentantes.getElementsByTagName('tr')).slice(1);
        const numVisible = filasActuales.filter(r => (r.offsetParent !== null) && getComputedStyle(r).display !== 'none').length;

        const mainContent = document.querySelector('.main-content');
        const contentHeight = mainContent ? Math.ceil(mainContent.getBoundingClientRect().height) : document.body.scrollHeight;
        const footerHeight = footer ? Math.ceil(footer.getBoundingClientRect().height) : 0;
        const viewportHeight = window.innerHeight;

        if ((contentHeight + footerHeight) <= viewportHeight) {
            footer.style.position = 'fixed';
            footer.style.bottom = '0';
            footer.style.left = '0';
            footer.style.width = '100%';
        } else {
            footer.style.position = 'relative';
            footer.style.bottom = '';
            footer.style.left = '';
            footer.style.width = '';
        }

    }

    window.addEventListener('resize', updateFooterPosition);
    window.addEventListener('orientationchange', updateFooterPosition);

    if (tablaRepresentantes) {
        const tbody = tablaRepresentantes.tBodies && tablaRepresentantes.tBodies[0] ? tablaRepresentantes.tBodies[0] : tablaRepresentantes;
        const observer = new MutationObserver((mutationsList) => {
            setTimeout(updateFooterPosition, 50);
        });
        observer.observe(tbody, { childList: true, subtree: true, characterData: true });
    }

    // llamar inicialmente
    updateFooterPosition();

    if (inputBuscador && tablaRepresentantes) {
        inputBuscador.addEventListener('keyup', (event) => {
            const filtro = inputBuscador.value.toUpperCase();
            const filasActuales = Array.from(tablaRepresentantes.getElementsByTagName('tr'));
            
            for (let i = 1; i < filasActuales.length; i++) {
                const celdaCedula = filasActuales[i].getElementsByTagName('td')[1];
                if (celdaCedula) {
                    const textoCelda = (celdaCedula.textContent || celdaCedula.innerText || '').toUpperCase();
                    filasActuales[i].style.display = (textoCelda.indexOf(filtro) > -1) ? "" : "none";
                }
            }
            updateFooterPosition();
        });
    }

    if (tablaRepresentantes) {
        tablaRepresentantes.addEventListener('click', (e) => {
            const botonAgregarEstudiante = e.target.closest('.btn-agregar-estudiante-a-rep');
            
            if (botonAgregarEstudiante) {
                e.preventDefault();
                
                const idRepresentante = botonAgregarEstudiante.dataset.id;
                
                if (inputHiddenRepID && idRepresentante) {
                    inputHiddenRepID.value = idRepresentante;
                    
                    const form = document.getElementById('formAgregarEstudiante');
                    if (form) form.reset();

                    ModalManager.abrirModal('modalAgregarEstudiante');
                    console.log(`Modal de Estudiante abierta. ID de Representante cargado: ${idRepresentante}`);
                } else {
                    console.error("Error al cargar el ID. Verifique el data-id del botón y el input#hidden_id_representante.");
                }
            }
        });
    }

    botonesVerEstudiantes.forEach(button => {
        button.addEventListener('click', () => {
            const idRepresentante = button.dataset.id;
            const nombreRepresentante = button.dataset.nombre;

            modalTitulo.textContent = 'Cargando estudiantes...';
            listaEstudiantes.innerHTML = '';
            
            ModalManager.abrirModal('modalEstudiantes');

            fetch(`acciones/estudiantes.php?id=${idRepresentante}`)
                .then(parseResponseFlexible)
                .then(estudiantes => {
                    if (estudiantes && estudiantes.isHtml) {
                        modalTitulo.textContent = 'Error al cargar los estudiantes';
                        listaEstudiantes.innerHTML = '<li style="color:red;">Respuesta inválida del servidor.</li>';
                        console.error('Respuesta no JSON (estudiantes):', estudiantes.raw);
                        return;
                    }

                    modalTitulo.textContent = `Estudiantes de ${nombreRepresentante}`;

                    if (!Array.isArray(estudiantes) || estudiantes.length === 0) {
                        const li = document.createElement('li');
                        li.textContent = 'No hay estudiantes asociados a este representante.';
                        listaEstudiantes.appendChild(li);
                        return;
                    }

                    estudiantes.forEach(estudiante => {
                        const li = document.createElement('li');
                        li.className = 'modal-estudiantes__item';
                        li.innerHTML = `
                            <p><strong>Cédula:</strong> ${estudiante.cedula}</p>
                            <p><strong>Nombre:</strong> ${estudiante.nombre} ${estudiante.apellido}</p>
                            <p><strong>Grado:</strong> ${estudiante.grado_session}</p>
                            <button class="ver-detalles-estudiante-btn" data-id="${estudiante.id}">Ver detalles</button>
                        `;
                        listaEstudiantes.appendChild(li);
                    });
                    
                    const botonesDetallesEstudiante = document.querySelectorAll('.ver-detalles-estudiante-btn');
                    botonesDetallesEstudiante.forEach(detalleButton => {
                        detalleButton.addEventListener('click', () => {
                            const idEstudiante = detalleButton.dataset.id;
                            estudianteIdActual = idEstudiante;
                            
                            modalDetallesInfo.innerHTML = 'Cargando detalles...';
                            fotoEstudiante.src = '';
                            fotoEstudianteInput.value = null;
                            guardarFotoBtn.style.display = 'none';

                            ModalManager.cerrarModal('modalEstudiantes');
                            ModalManager.abrirModal('modalDetalles');
                            
                            fetch(`acciones/obtenerDetallesEstudiante.php?id=${idEstudiante}`)
                                .then(parseResponseFlexible)
                                .then(estudianteDetalles => {
                                    if (estudianteDetalles && estudianteDetalles.isHtml) {
                                        modalDetallesInfo.innerHTML = 'Error al cargar los detalles.';
                                        console.error('Respuesta no JSON (detalles):', estudianteDetalles.raw);
                                        return;
                                    }
                                    if (estudianteDetalles.error) {
                                        modalDetallesInfo.innerHTML = `Error: ${escapeHTML(estudianteDetalles.error)}`;
                                        return;
                                    }
                                    
                                    fotoEstudiante.src = estudianteDetalles.foto_estudiante || 'img/placeholder.jpg';

                                    modalDetallesTitulo.textContent = `Detalles de ${estudianteDetalles.nombre} ${estudianteDetalles.apellido}`;
                                    modalDetallesInfo.innerHTML = `
                                        <div style="background:#fff;padding:14px;border-radius:8px;box-shadow:0 2px 8px rgba(0,0,0,0.06);font-family:Arial,Helvetica,sans-serif;color:#222;">
                                            <div style="display:grid;grid-template-columns:140px 1fr;gap:8px 16px;align-items:start;font-size:0.95rem;">
                                                <div style="font-weight:700;color:#444;">Cédula:</div><div>${escapeHTML(estudianteDetalles.cedula)}</div>
                                                <div style="font-weight:700;color:#444;">Fecha de Nacimiento:</div><div>${escapeHTML(estudianteDetalles.Fecha_nacimiento)}</div>
                                                <div style="font-weight:700;color:#444;">Género:</div><div>${escapeHTML(estudianteDetalles.genero)}</div>
                                                <div style="font-weight:700;color:#444;">Grado:</div><div>${escapeHTML(estudianteDetalles.grado_session)}</div>
                                                <div style="font-weight:700;color:#444;">Representante:</div><div>${escapeHTML(estudianteDetalles.nombre_representante)}</div>
                                                <div style="font-weight:700;color:#444;">Lugar de Nacimiento:</div><div>${escapeHTML(estudianteDetalles.lug_nacimiento)}</div>
                                                <div style="font-weight:700;color:#444;">Talla de Camisa:</div><div>${escapeHTML(estudianteDetalles.TC)}</div>
                                                <div style="font-weight:700;color:#444;">Talla de Zapato:</div><div>${escapeHTML(estudianteDetalles.TZ)}</div>
                                            </div>
                                            ${estudianteDetalles.observaciones ? `<p style="margin-top:10px;color:#555;"><strong>Observaciones:</strong> ${escapeHTML(estudianteDetalles.observaciones)}</p>` : ''}
                                        </div>
                                    `;
                                })
                                .catch(error => {
                                    const msg = (error && error.message) ? error.message : 'Error al cargar los detalles.';
                                    modalDetallesInfo.innerHTML = `Error al cargar los detalles. ${escapeHTML(msg)}`;
                                    console.error('Error:', error);
                                });
                        });
                    });
                })
                .catch(error => {
                    const txt = (error && error.message) ? error.message : '';
                    modalTitulo.textContent = 'Error al cargar los datos';
                    console.error('Error:', error);
                    listaEstudiantes.innerHTML = `<li>Hubo un problema al obtener los estudiantes. ${txt}</li>`;
                });
        });
    });

    fotoEstudianteInput.addEventListener('change', () => {
        if (fotoEstudianteInput.files.length > 0) {
            guardarFotoBtn.style.display = 'block';
        } else {
            guardarFotoBtn.style.display = 'none';
        }
    });

    guardarFotoBtn.addEventListener('click', () => {
        if (!estudianteIdActual) {
            console.log('Error: No se pudo determinar el estudiante actual.');
            return;
        }
        const archivo = fotoEstudianteInput.files[0];
        if (!archivo) {
            console.log('Por favor, selecciona un archivo.');
            return;
        }

        const formData = new FormData();
        formData.append('id_estudiante', estudianteIdActual);
        formData.append('foto', archivo);

        fetch('acciones/subirFotoEstudiante.php', {
            method: 'POST',
            body: formData
        })
        .then(parseResponseFlexible)
        .then(data => {
            if (data && data.isHtml) {
                console.error('Respuesta no JSON (subir foto):', data.raw);
                return;
            }

            if (data && data.error) {
                console.error('Error al subir la foto:', data.error);
            } else {
                console.log(data.success || 'Foto subida correctamente');
                if (data.foto_nueva) {
                    fotoEstudiante.src = data.foto_nueva;
                }
                guardarFotoBtn.style.display = 'none';
                fotoEstudianteInput.value = null;
            }
        })
        .catch(error => {
            const msg = (error && error.message) ? error.message : 'Error de conexión al subir la foto.';
            console.error('Error de conexión al subir la foto:', msg);
        });
    });

    function cerrarRegistroModal() {
        ModalManager.cerrarModal('modalAgregarEstudiante');
    }

    if (btnCerrarHeaderRegistro) {
        btnCerrarHeaderRegistro.addEventListener('click', cerrarRegistroModal);
    }
    
    if (btnCerrarFooter) {
        btnCerrarFooter.addEventListener('click', cerrarRegistroModal);
    }

    if (closeEditarModal) {
        closeEditarModal.onclick = function() {
            ModalManager.cerrarModal('editarModal');
        };
    }

    window.onclick = function(event) {
        
        if (modalEditar && event.target === modalEditar) {
            ModalManager.cerrarModal('editarModal');
        }
        
        if (modalEstudiantes && event.target === modalEstudiantes) {
            ModalManager.cerrarModal('modalEstudiantes');
        }
        
        if (modalDetalles && event.target === modalDetalles) {
            ModalManager.cerrarModal('modalDetalles');
        }

        if (modalRegistroEstudiante && event.target === modalRegistroEstudiante) {
            ModalManager.cerrarModal('modalAgregarEstudiante');
        }
    };
});