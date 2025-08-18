document.addEventListener("DOMContentLoaded", function () {
  // Toggle sidebar
  const toggleSidebar = document.getElementById("toggleSidebar");
  const sidebar = document.querySelector(".sidebar");

  if (toggleSidebar && sidebar) {
    toggleSidebar.addEventListener("click", function () {
      sidebar.classList.toggle("collapsed");
      // Guardar el estado en localStorage
      const isCollapsed = sidebar.classList.contains("collapsed");
      localStorage.setItem("sidebarCollapsed", isCollapsed);
    });

    // Verificar el estado guardado al cargar la página
    if (localStorage.getItem("sidebarCollapsed") === "true") {
      sidebar.classList.add("collapsed");
    }
  }

  // Función para agregar estudiante
  window.agregarEstudiante = function () {
    var div = document.createElement('div');
    div.className = 'estudiante';
    div.innerHTML = `
      <input type="text" name="cedula_estudiante[]" placeholder="Cédula" required>
      <input type="text" name="nombre_estudiante[]" placeholder="Nombre" required>
      <input type="text" name="apellido_estudiante[]" placeholder="Apellido" required>
      <input type="text" class="form-control" placeholder="direccion" name="direccion_estudiante[]" required>
      <select name="grado_estudiante[]" required>
        <option value="">Seleccione</option>
        <option value="1er año Seccion A">1er Año Seccion A</option>
        <option value="1er año Seccion B">1er Año Seccion B</option>
        <option value="1er año Seccion C">1er Año Seccion C</option>
        <option value="2er año Seccion A">2er Año Seccion A</option>
        <option value="2er año Seccion C">2er Año Seccion C</option>
        <option value="2er año Seccion B">2er Año Seccion A</option>
        <option value="3er año Seccion A">3er Año Seccion A</option>
        <option value="3er año Seccion B">3er Año Seccion B</option>
        <option value="3er año Seccion C">3er Año Seccion C</option>
        <option value="4to año Seccion A">4to Año Seccion A</option>
        <option value="4to año Seccion B">4to Año Seccion B</option>
        <option value="4to año Seccion C">4to Año Seccion C</option>
        <option value="5to año Seccion A">5to Año Seccion A</option>
        <option value="5to año Seccion B">5to Año Seccion B</option>
        <option value="5to año Seccion C">5to Año Seccion C</option>
      </select>
      <button type="button" onclick="eliminarEstudiante(this)">Eliminar</button>
    `;
    document.getElementById('estudiantes').appendChild(div);
  };

  // Función para eliminar estudiante
  window.eliminarEstudiante = function (btn) {
    var estudiantes = document.getElementById('estudiantes');
    if (estudiantes.children.length > 1) {
      btn.parentNode.remove();
    } else {
      alert('Debe haber al menos un estudiante.');
    }
  };
});


