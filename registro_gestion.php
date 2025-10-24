<?php
session_start();

include('acciones/registro.php');
if (empty($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

$mostrarModal = false;
if (empty($_SESSION['bienvenida_mostrada'])) {
    $mostrarModal = true;
    $_SESSION['bienvenida_mostrada'] = true;
}


$mostrarDatosRegistrados = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_todo'])) {
    $mostrarDatosRegistrados = true;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>REGISTRO DE REPRESENTANTES</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/style2.css">
</head>
<body>

<div class="datos-registrados" id="modalDatosRegistrados">
    <div class="contenido-datos-registrados">
        <span class="cerrar-registro" id="btnCerrarModalEstudiantes" onclick="ModalManager.cerrarModal('modalDatosRegistrados')">&times;</span>
        <h3>DATOS ENVIADOS A LA BASE DE DATOS</h3>
        <p>Consulte el apartado de gestion para confirmar que los datos han sido registrados correctamente.</p>
    </div>
</div>


<?php if ($mostrarModal): ?>
<div class="modal-bienvenida" id="modalBienvenida">
        <div class="modal-contenido-bienvenida">
            <span class="cerrar-bienvenida" id="btnCerrarModalEstudiantes" onclick="ModalManager.cerrarModal('modalBienvenida')">&times;</span>
            <h2>¡Bienvenido, Usuario: <?php echo htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
            <p>Has accedido al sistema de registro de representantes.</p>
            <p>Cualquier duda consulte el Manual de usuario <a class="enlace-manual" href="#">aquí</a>.</p>
        </div>
</div>
<?php endif; ?>

    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip">Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="gestion.php">Gestion</a>
            <a download="ManualdeUsuario.pdf" href="#">User Manual</a>
            <a href="acciones/logout.php">Cerrar Session</a>
            <a class="usuario">Usuario: <?php echo $_SESSION['usuario']; ?></a>
        </div>
    </nav>

    <main class="main-content">
        <div class="header">
            <h1 class="page-title">Registro de Representantes</h1>
        </div>

        <form action="" method="POST">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Datos del Representante</h2>
                </div>
                <div class="card-body">
                    <div class="registroCompleto">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label">Nombre del Representante</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del representante" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="form-label">Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido del representante" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
                            </div>
                            <div class="form-group">
                                <label for="cedula" class="form-label">Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula de identidad" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="telefono" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Número de teléfono" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                            </div>
                            <div class="form-group">
                                <label for="correo" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                                <label for="genero" class="form-label">Género</label>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="direccion" class="form-label">Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección de residencia">
                            </div>
                            <div class="form-group">
                                <label for="parentesco" class="form-label">Parentesco</label>
                                <select name="parentesco" id="parentesco" class="form-control">
                                    <option value="" require>Selecione...</option>
                                    <option value="Padre">Padre</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Tio">Tio</option>
                                    <option value="Tia">Tia</option>
                                    <option value="Abuelo">Abuelo</option>
                                    <option value="Abuela">Abuela</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <h2 class="card-title">Datos del Estudiante</h2>
                    <button type="button" class="btn btn-primary" onclick="agregarEstudiante()">
                        <i class="fa-solid fa-plus"></i>
                        Añadir Estudiante
                    </button>
                </div>
                <div class="card-body">
                    <div id="estudiantes">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-secondary" name="registrar_todo">Registrar Representante</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
    
    <script src="js/app.js"></script>
    <script src="js/Modal_Manager.js"></script>

<?php if ($mostrarDatosRegistrados): ?>
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        var id = 'modalDatosRegistrados';
        // Intentar usar ModalManager si existe, si no, fallback a mostrar el elemento directamente
        if (typeof ModalManager !== 'undefined' && typeof ModalManager.abrirModal === 'function') {
            ModalManager.abrirModal(id);
        } else {
            var el = document.getElementById(id);
            if (el) el.style.display = 'block';
        }
    });
    </script>
<?php endif; ?>

    <footer>
        © 2025. Software de Registro y Gestión de Representantes. Diseñado y desarrollado por los estudiantes de la Universidad Francisco Tamayo. Todos los derechos reservados.
    </footer>
</body>
</html>
