let estudiantesData = [];

function renderEstudiantes(estudiantes) {
return estudiantes.map(est => `
    <li>
        ${est.nombre} ${est.apellido} - Grado: ${est.grado_session}
        <button class="btn-ver-detalle" data-id="${est.id}">Ver Detalles</button>
    </li>
`).join('');
}

async function abrirModalEstudiantes(idRep, nombreRep) {
await ModalManager.cargarModal('mod/modal_estudiantes.html', 'modalEstudiantes');
ModalManager.activarCierreExterno('modalEstudiantes');

const titulo = document.getElementById('modalTitulo');
const lista = document.getElementById('listaEstudiantes');

if (titulo) titulo.textContent = `Estudiantes de ${nombreRep}`;
if (lista) lista.innerHTML = "<li>Cargando...</li>";

ModalManager.mostrarModal('modalEstudiantes');

try {
    const datos = await fetch(`acciones/estudiantes.php?id=${idRep}`).then(r => r.json());
    estudiantesData = datos;

    if (lista) {
    lista.innerHTML = datos.length
        ? renderEstudiantes(datos)
        : "<li>No hay estudiantes registrados.</li>";
    }

    // Eliminar listeners previos y reasignar
    document.querySelectorAll('.btn-ver-detalle').forEach(btn => {
        const nuevoBtn = btn.cloneNode(true);
        btn.replaceWith(nuevoBtn);
    });

    document.querySelectorAll('.btn-ver-detalle').forEach(btn => {
    btn.addEventListener('click', () => {
        const est = estudiantesData.find(e => e.id == btn.dataset.id);
        if (est) abrirModalDetalle(est);
        });
    });

} catch (err) {
    console.error("Error al cargar estudiantes:", err);
    if (lista) lista.innerHTML = "<li>Error al cargar datos</li>";
}
}

async function abrirModalDetalle(estudiante) {
const idModal = 'modalDetalleEstudiante';

if (!document.getElementById(idModal)) {
    await ModalManager.cargarModal('mod/modal_estudiantes_detallada.html', idModal);
}

ModalManager.activarCierreExterno(idModal);

const nombre = document.getElementById('detalleNombreEstudiante');
const grado = document.getElementById('detalleGrado');
const cedula = document.getElementById('detalleCedula');

if (nombre) nombre.textContent = estudiante.nombre;
if (grado) grado.textContent = estudiante.grado;
if (cedula) cedula.textContent = estudiante.cedula;

    ModalManager.mostrarModal(idModal);
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.ver-estudiantes-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const id = btn.dataset.id;
        const nombre = btn.dataset.nombre;
        if (id && nombre) abrirModalEstudiantes(id, nombre);
    });
});
});
