document.addEventListener('DOMContentLoaded', () => {
});

function agregarEstudiante() {
    const estudiantesDiv = document.getElementById('estudiantes');
    const nuevoEstudianteDiv = document.createElement('div');
    nuevoEstudianteDiv.classList.add('estudiante');

    nuevoEstudianteDiv.innerHTML = `
        <div class="form-group">
            <label class="form-label">Cédula</label>
            <input type="text" class="form-control" name="cedula_estudiante[]" placeholder="Cédula del estudiante" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
        </div>
        <div class="form-group">
            <label class="form-label">Nombre</label>
            <input type="text" class="form-control" name="nombre_estudiante[]" placeholder="Nombre del estudiante" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
        </div>
        <div class="form-group">
            <label class="form-label">Apellido</label>
            <input type="text" class="form-control" name="apellido_estudiante[]" placeholder="Apellido del estudiante" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
        </div>
        <div class="form-group">
            <label class="form-label">Fecha_nacimiento</label>
            <input type="date" class="form-control" name="fecha_estudiante[]" placeholder="Fecha de Nacimiento" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
        </div>
        <div class="form-group">
            <label class="form-label">Lugar de Nacimiento</label>
            <input type="text" class="form-control" name="lugar_nacimiento[]" placeholder="Lugar de Nacimiento" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
        </div>
        <div class="form-group">
            <label class="form-label">Talla de Camisa</label>
            <input type="text" class="form-control" name="talla_camisa[]" placeholder="Talla de Camisa" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
        </div>
        <div class="form-group">
            <label class="form-label">Talla de Pantalon</label>
            <input type="text" class="form-control" name="talla_pantalon[]" placeholder="(solo numeros)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
        </div>
        
        <div class="form-group">
            <label class="form-label">Talla de Zapato</label>
            <input type="text" class="form-control" name="talla_zapato[]" placeholder="(solo números)" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)" required>
        </div>
        <div class="form-group">
            <label class="form-label">Sexo</label>
            <select class="form-control" name="sexo_estudiante[]">
                <option value="M">Masculino</option>
                <option value="F">Femenino</option>
            </select>
        </div>
        <div class="form-group">
            <label class="form-label">Grado y Sección</label>
            <select class="form-control" name="grado_estudiante[]">
                <optgroup label="Preescolar">
                    <option value="1er-Nivel A">1er Nivel - Sección A</option>
                    <option value="1er-Nivel B">1er Nivel - Sección B</option>
                    <option value="1er-Nivel C">1er Nivel - Sección C</option>
                    <option value="2do-Nivel A">2do Nivel - Sección A</option>
                    <option value="2do-Nivel B">2do Nivel - Sección B</option>
                    <option value="2do-Nivel C">2do Nivel - Sección C</option>
                    <option value="3er-Nivel A">3er Nivel - Sección A</option>
                    <option value="3er-Nivel B">3er Nivel - Sección B</option>
                    <option value="3er-Nivel C">3er Nivel - Sección C</option>
                </optgroup>
                <optgroup label="Primaria">
                    <option value="1er-Grado A">1er Grado - Sección A</option>
                    <option value="1er-Grado B">1er Grado - Sección B</option>
                    <option value="1er-Grado C">1er Grado - Sección C</option>
                    <option value="2do-Grado A">2do Grado - Sección A</option>
                    <option value="2do-Grado B">2do Grado - Sección B</option>
                    <option value="2do-Grado C">2do Grado - Sección C</option>
                    <option value="3er-Grado A">3er Grado - Sección A</option>
                    <option value="3er-Grado B">3er Grado - Sección B</option>
                    <option value="3er-Grado C">3er Grado - Sección C</option>
                    <option value="4to-Grado A">4to Grado - Sección A</option>
                    <option value="4to-Grado B">4to Grado - Sección B</option>
                    <option value="4to-Grado C">4to Grado - Sección C</option>
                    <option value="5to-Grado A">5to Grado - Sección A</option>
                    <option value="5to-Grado B">5to Grado - Sección B</option>
                    <option value="5to-Grado C">5to Grado - Sección C</option>
                    <option value="6to-Grado A">6to Grado - Sección A</option>
                    <option value="6to-Grado B">6to Grado - Sección B</option>
                    <option value="6to-Grado C">6to Grado - Sección C</option>
                </optgroup>
                <optgroup label="Media General">
                    <option value="1er-año A">1er año - Sección A</option>
                    <option value="1er-año B">1er año - Sección B</option>
                    <option value="1er-año C">1er año - Sección C</option>
                    <option value="2do-año A">2do año - Sección A</option>
                    <option value="2do-año B">2do año - Sección B</option>
                    <option value="2do-año C">2do año - Sección C</option>
                    <option value="3er-año A">3er año - Sección A</option>
                    <option value="3er-año B">3er año - Sección B</option>
                    <option value="3er-año C">3er año - Sección C</option>
                    <option value="4to-año A">4to año - Sección A</option>
                    <option value="4to-año B">4to año - Sección B</option>
                    <option value="4to-año C">4to año - Sección C</option>
                    <option value="5to-año A">5to año - Sección A</option>
                    <option value="5to-año B">5to año - Sección B</option>
                    <option value="5to-año C">5to año - Sección C</option>
                </optgroup>
            </select>
        </div>
        <button type="button" class="btn btn-danger" onclick="this.parentElement.remove()">
            <i>Eliminar</i>
        </button>
    `;
    estudiantesDiv.appendChild(nuevoEstudianteDiv);
}

function guardarRegistro() {
    const datosRepresentante = {
        nombre: document.getElementById('nombre').value,
        apellido: document.getElementById('apellido').value,
        cedula: document.getElementById('cedula').value,
        telefono: document.getElementById('telefono').value,
        correo: document.getElementById('correo').value,
        genero: document.getElementById('genero').value,
        direccion: document.getElementById('direccion').value,
        parentesco: document.getElementById('parentesco').value,
    };

    const estudiantes = [];
    const estudiantesElements = document.querySelectorAll('#estudiantes .estudiante');
    estudiantesElements.forEach(estudiante => {
        const datosEstudiante = {
            cedula: estudiante.querySelector('input[name="cedula_estudiante[]"]').value,
            nombre: estudiante.querySelector('input[name="nombre_estudiante[]"]').value,
            apellido: estudiante.querySelector('input[name="apellido_estudiante[]"]').value,
            grado: estudiante.querySelector('select[name="grado_estudiante[]"]').value,
            sexo: estudiante.querySelector('select[name="sexo_estudiante[]"]').value,
        };
        estudiantes.push(datosEstudiante);
    });

    console.log('Datos del Representante:', datosRepresentante);
    console.log('Datos de los Estudiantes:', estudiantes);
}
