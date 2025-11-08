<?php
session_start();
include_once('acciones/conexion.php');

if (empty($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}

// Obtener role desde la sesión o desde la BD si no está establecido
if (empty($_SESSION['role']) && !empty($_SESSION['usuario'])) {
    $sql_role = "SELECT role FROM acceso WHERE usuario = ?";
    if ($stmt = mysqli_prepare($enlace, $sql_role)) {
        mysqli_stmt_bind_param($stmt, "s", $_SESSION['usuario']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $role_from_db);
        mysqli_stmt_fetch($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $role_from_db = null;
    }

    if (!empty($role_from_db)) {
        $_SESSION['role'] = $role_from_db;
    } else {
        $res = mysqli_query($enlace, "SELECT COUNT(*) FROM acceso");
        $cnt = $res ? mysqli_fetch_row($res)[0] : 0;
        $_SESSION['role'] = ($cnt <= 1) ? 'admin' : 'registrar';
    }
}
$error_message = '';
$mostrarDatosRegistrados = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_todo'])) {

    $rep_fields = ['nombre','apellido','cedula','telefono','correo','genero','direccion','parentesco','registrar_todo'];

    function has_non_empty_student_fields($arr, $exclude_keys) {
        foreach ($arr as $k => $v) {
            if (in_array($k, $exclude_keys, true)) continue;
            if (is_array($v)) {
                $iterator = new RecursiveIteratorIterator(new RecursiveArrayIterator($v));
                foreach ($iterator as $leaf) {
                    if (trim((string)$leaf) !== '') return true;
                }
            } else {
                if (trim((string)$v) !== '') return true;
            }
        }
        return false;
    }

    if (!has_non_empty_student_fields($_POST, $rep_fields)) {
        $error_message = 'Debe agregar al menos un estudiante antes de registrar el representante.';
    } else {
        
        include('acciones/registro.php');
        if (!empty($_SESSION['registro_status'])) {
            if ($_SESSION['registro_status'] === 'duplicate') {
                $error_message = 'La cédula ya está registrada. Verifique los datos.';
                $mostrarDatosRegistrados = false;
            } elseif ($_SESSION['registro_status'] === 'success') {
                $mostrarDatosRegistrados = true;
            } else {
                $error_message = 'No se pudo completar el registro. Intente nuevamente.';
                $mostrarDatosRegistrados = false;
            }


            unset($_SESSION['registro_status']);
            if (!empty($_SESSION['datos_registrados'])) {
                $mostrarDatosRegistrados = true;
                unset($_SESSION['datos_registrados']);
            } else {
                $mostrarDatosRegistrados = false;
            }
        }
    }
}

// Limpiar indicadores en GET/recargas para evitar mostrar modal persistente
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    unset($_SESSION['datos_registrados']);
    unset($_SESSION['registro_status']);
}

$mostrarModal = false;
if (empty($_SESSION['bienvenida_mostrada'])) {
    $mostrarModal = true;
    $_SESSION['bienvenida_mostrada'] = true;
}

$mostrarDatosRegistrados = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['registrar_todo'])) {
    $mostrarDatosRegistrados = true;
}else{
    $mostrarDatosRegistrados = false;
    unset($_SESSION['datos_registrados']);
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="datos-registrados" id="modalDatosRegistrados">
    <div class="contenido-datos-registrados">
        <span class="cerrar-registro" id="btnCerrarModalEstudiantes">&times;</span>
        <h3><i class="fas fa-database"></i> DATOS ENVIADOS A LA BASE DE DATOS</h3>
        <p><i class="fas fa-check-circle"></i> Consulte el apartado de **gestión** para confirmar que los datos han sido registrados correctamente.</p>
    </div>
</div>


<?php if ($mostrarModal): ?>
<div class="modal-bienvenida" id="modalBienvenida">
    <div class="modal-contenido-bienvenida">
        <span class="cerrar-bienvenida" id="btnCerrarModalEstudiantes">&times;</span>
        <h2><i class="fas fa-hand-sparkles"></i> ¡Bienvenido, Usuario: <?php echo htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8'); ?>!</h2>
        <p><i class="fas fa-info-circle"></i> Has accedido al sistema de registro de representantes.</p>
        <p><i class="fas fa-book-open"></i> Cualquier duda consulte el Manual de usuario <a class="enlace-manual" href="user-manual.php">aquí</a>.</p>
    </div>
</div>
<?php endif; ?>

    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip"><i class="fas fa-history"></i> Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="gestion.php"><i class="fas fa-cogs"></i> Gestion</a>
            <a href="user-manual.php"><i class="fas fa-book"></i> User Manual</a>
            <a href="acciones/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Session</a>
            <a class="usuario"><i class="fas fa-user-circle"></i> Usuario: <?php echo htmlspecialchars($_SESSION['usuario'], ENT_QUOTES, 'UTF-8'); ?></a>
        </div>
    </nav>

    <main class="main-content">
        <div class="header">
            <h1 class="page-title"><i class="fas fa-pen-to-square"></i> Registro de Representantes</h1>
        </div>
            <?php if (!empty($error_message)): ?>
            <div> 
                <div class="error-message" id="errorMessage" style="background:#ffe5e5;border:1px solid #ffb3b3;padding:12px;margin-top:12px;border-radius:4px;color:#a70000;">
                    <i class="fas fa-exclamation-triangle"></i>
                    <?php echo htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8'); ?>
                </div>
            </div>
            <?php endif; ?>
        <form action="" method="POST" id="formRegistro">
            <div class="card">
                <div class="card-header">
                    <h2 class="card-title"><i class="fas fa-user-tie"></i> Datos del Representante</h2>
                </div>
                <div class="card-body">
                    <div class="registroCompleto">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="nombre" class="form-label"><i class="fas fa-signature"></i> Nombre del Representante</label>
                                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del representante" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
                            </div>
                            <div class="form-group">
                                <label for="apellido" class="form-label"><i class="fas fa-signature"></i> Apellido</label>
                                <input type="text" class="form-control" id="apellido" name="apellido" placeholder="Apellido del representante" onkeypress="return (event.charCode < 48 || event.charCode > 57)">
                            </div>
                            <div class="form-group">
                                <label for="cedula" class="form-label"><i class="fas fa-id-card"></i> Cédula</label>
                                <input type="text" class="form-control" id="cedula" name="cedula" placeholder="Cédula de identidad" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="telefono" class="form-label"><i class="fas fa-phone"></i> Teléfono</label>
                                <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Número de teléfono" onkeypress="return (event.charCode >= 48 && event.charCode <= 57)">
                            </div>
                            <div class="form-group">
                                <label for="correo" class="form-label"><i class="fas fa-envelope"></i> Correo Electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo electrónico">
                            </div>
                            <div class="form-group">
                                <label for="genero" class="form-label"><i class="fas fa-venus-mars"></i> Género</label>
                                <select class="form-control" id="genero" name="genero">
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="direccion" class="form-label"><i class="fas fa-map-marker-alt"></i> Dirección</label>
                                <input type="text" class="form-control" id="direccion" name="direccion" placeholder="Dirección de residencia">
                            </div>
                            <div class="form-group">
                                <label for="parentesco" class="form-label"><i class="fas fa-user-friends"></i> Parentesco</label>
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
                    <h2 class="card-title"><i class="fas fa-child"></i> Datos del Estudiante</h2>
                    <button type="button" class="btn btn-primary" onclick="agregarEstudiante()">
                        <i class="fas fa-plus-circle"></i>
                        Añadir Estudiante
                    </button>
                </div>
                <div class="card-body">
                    <div id="estudiantes">
                    </div>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-secondary" name="registrar_todo"><i class="fas fa-save"></i> Registrar Representante</button>
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
    if (typeof ModalManager !== 'undefined' && typeof ModalManager.abrirModal === 'function') {
        ModalManager.abrirModal(id);
    } else {
        var el = document.getElementById(id);
        if (el) el.style.display = 'block';
    }
});
</script>
<?php endif; ?>

    <script>
    (function(){
        var role = <?php echo json_encode(isset($_SESSION['role']) ? $_SESSION['role'] : ''); ?>;
        if (role !== 'admin') {
            // ocultar elementos que requieren admin
            document.addEventListener('DOMContentLoaded', function(){
                document.querySelectorAll('.admin-only').forEach(function(el){
                    el.style.display = 'none';
                });
            });
        }
    })();
    </script>

    <!-- Validación cliente: impedir submit si no hay estudiantes añadidos -->
    <script>
    document.addEventListener('DOMContentLoaded', function(){
        var form = document.getElementById('formRegistro');
        if (!form) return;
        form.addEventListener('submit', function(e){
            var estudiantesContainer = document.getElementById('estudiantes');
            var inputs = estudiantesContainer ? estudiantesContainer.querySelectorAll('input, select, textarea') : [];
            var hasValue = false;
            for (var i = 0; i < inputs.length; i++) {
                var inp = inputs[i];
                if (inp.type === 'button' || inp.type === 'submit') continue;
                if (inp.value && inp.value.toString().trim() !== '') { hasValue = true; break; }
            }
            if (!hasValue) {
                e.preventDefault();
                var err = document.getElementById('errorMessage');
                if (!err) {
                    err = document.createElement('div');
                    err.id = 'errorMessage';
                    err.className = 'error-message';
                    err.style = 'background:#ffe5e5;border:1px solid #ffb3b3;padding:12px;margin-top:12px;border-radius:4px;color:#a70000;';
                    err.innerHTML = '<i class="fas fa-exclamation-triangle"></i> Debe agregar al menos un estudiante antes de registrar el representante.';
                    // insertar debajo del H1 si existe
                    var header = document.querySelector('.header');
                    if (header) {
                        header.appendChild(err);
                    } else {
                        var main = document.querySelector('.main-content') || document.body;
                        main.insertBefore(err, main.firstChild);
                    }
                } else {
                    err.style.display = 'block';
                }
                window.scrollTo(0,0);
            }
        });
    });
    </script>

    <footer>
        <i class="fas fa-copyright"></i> 2025. Software de Registro y Gestión de Representantes. Diseñado y desarrollado por los estudiantes de la Universidad Francisco Tamayo. Todos los derechos reservados.
    </footer>
</body>
</html>