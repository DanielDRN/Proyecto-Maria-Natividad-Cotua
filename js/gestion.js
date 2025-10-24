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
    const tablaRepresentantes = document.querySelector('table');
    const filas = tablaRepresentantes.getElementsByTagName('tr');



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

    inputBuscador.addEventListener('keyup', (event) => {
        const filtro = inputBuscador.value.toUpperCase();
        
        for (let i = 1; i < filas.length; i++) {
            const celdaCedula = filas[i].getElementsByTagName('td')[1];
            if (celdaCedula) {
                const textoCelda = celdaCedula.textContent || celdaCedula.innerText;
                if (textoCelda.toUpperCase().indexOf(filtro) > -1) {
                    filas[i].style.display = "";
                } else {
                    filas[i].style.display = "none";
                }
            }
        }
    });

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
                        listaEstudiantes.innerHTML = '';
                        const li = document.createElement('li');
                        li.textContent = 'Respuesta inválida del servidor. Revisa consola para detalles.';
                        li.style.color = 'red';
                        listaEstudiantes.appendChild(li);
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
                                        modalDetallesInfo.innerHTML = 'Error al cargar los detalles. Revisa la consola para más información.';
                                        console.error('Respuesta no JSON (detalles):', estudianteDetalles.raw);
                                        return;
                                    }

                                    if (estudianteDetalles.error) {
                                        modalDetallesInfo.innerHTML = `Error: ${estudianteDetalles.error}`;
                                        return;
                                    }
                                    
                                    if (estudianteDetalles.foto_estudiante) {
                                        fotoEstudiante.src = estudianteDetalles.foto_estudiante;
                                    } else {
                                        fotoEstudiante.src = 'img/placeholder.jpg';
                                    }

                                    modalDetallesTitulo.textContent = `Detalles de ${estudianteDetalles.nombre} ${estudianteDetalles.apellido}`;
                                    modalDetallesInfo.innerHTML = `
                                        <p><strong>Cédula:</strong> ${estudianteDetalles.cedula}</p>
                                        <p><strong>Fecha de Nacimiento:</strong> ${estudianteDetalles.Fecha_nacimiento}</p>
                                        <p><strong>Género:</strong> ${estudianteDetalles.genero}</p>
                                        <p><strong>Grado:</strong> ${estudianteDetalles.grado_session}</p>
                                        <p><strong>Representante:</strong> ${estudianteDetalles.nombre_representante}</p>
                                    `;
                                })
                                .catch(error => {
                                    const msg = (error && error.message) ? error.message : 'Error al cargar los detalles.';
                                    modalDetallesInfo.innerHTML = `Error al cargar los detalles. ${msg}`;
                                    console.error('Error:', error);
                                });
                        });
                    });
                })
                .catch(error => {
                    const txt = (error && error.message) ? error.message : '';
                    modalTitulo.textContent = 'Error al cargar los datos';
                    console.error('Error:', error);
                    const li = document.createElement('li');
                    li.textContent = 'Hubo un problema al obtener los estudiantes. Inténtalo de nuevo más tarde.';
                
                    if (txt) {
                        const liErr = document.createElement('li');
                        liErr.style.color = 'red';
                        liErr.textContent = `Detalles del servidor: ${txt}`;
                        listaEstudiantes.appendChild(liErr);
                    }
                    listaEstudiantes.appendChild(li);
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

});

