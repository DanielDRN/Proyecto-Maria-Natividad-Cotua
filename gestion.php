<?php
session_start();

$isAdmin = false;
if (!empty($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $isAdmin = true;
} elseif (!empty($_SESSION['usuario']) && $_SESSION['usuario'] === 'admin') {
    $isAdmin = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar_id']) && !$isAdmin) {
        echo "<script>alert('No tienes permiso para eliminar.');</script>";
        unset($_POST['eliminar_id']);
    }
    if ((isset($_POST['editar_id']) || isset($_POST['actualizar_estudiante'])) && !$isAdmin) {
        echo "<script>alert('No tienes permiso para editar.');</script>";
        unset($_POST['editar_id']);
        unset($_POST['actualizar_estudiante']);
    }
}
include('acciones/conexion.php');
include('acciones/editar_estudiante.php');
include ('acciones/gestionEstudiantes.php');
include ('acciones/editar_representante.php');
include('acciones/contar.php');
include('acciones/agregarEstudiante.php');


if (empty($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Representantes Registrados</title>
    <link rel="icon" type="image/png" href="img/logo.png">
    <link rel="stylesheet" href="style/style3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="js/gestion.js"></script>
</head>
<body>
    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip"><i class="fas fa-history"></i> Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="registro_gestion.php"><i class="fas fa-user-plus"></i> Registro</a>
            <a href="user-manual.php"><i class="fas fa-book"></i> User Manual</a>
            <a href="acciones/logout.php"><i class="fas fa-sign-out-alt"></i> Cerrar Session</a>
            <a class="usuario"><i class="fas fa-user-circle"></i> Usuario: <?php echo htmlspecialchars($_SESSION['usuario']); ?></a>
        </div>
    </nav>
    <h1><i class="fas fa-users"></i> Representantes Registrados</h1>
    <input class="input-busqueda" oninput="this.value = this.value.replace(/[^0-9]/g, '')" type="text" id="buscador" placeholder="&#xf002; Buscar por Cédula..." style="font-family: Arial, 'Font Awesome 6 Free'">
    <div class="totals-container">
        <p class="total-representantes">
            <i class="fas fa-chart-bar"></i> Total Representantes: <?php echo htmlspecialchars($totalrepresentantes); ?>
        </p>
        <p class="total-estudiantes">
            <i class="fas fa-chart-bar"></i> Total Estudiantes: <?php echo htmlspecialchars($totalEstudiantes); ?>
        </p>
    </div>
    <div id="contenedor-principal">
    <table>
        <thead id="tablaEncabezado">
        <tr>
            <th><i class="fas fa-signature"></i> Nombre</th>
            <th><i class="fas fa-id-card"></i> Cédula</th>
            <th><i class="fas fa-phone"></i> Teléfono</th>
            <th><i class="fas fa-venus-mars"></i> Genero</th>
            <th><i class="fas fa-map-marker-alt"></i> Direccion</th>
            <th><i class="fas fa-envelope"></i> correo</th>
            <th><i class="fas fa-cogs"></i> Acciones</th>
        </tr>
        </thead>
        <tbody id="tabla">
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']);  ?></td>
            <td><?php echo htmlspecialchars($row['cedula']) ?></td>
            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
            <td><?php echo htmlspecialchars($row['genero']); ?></td>
            <td><?php echo htmlspecialchars($row['direccion'])?></td>
            <td><?php echo htmlspecialchars($row['correo'])?></td>
            <td>
                <button class="ver-estudiantes-btn" data-id="<?php echo htmlspecialchars($row['id']); ?>" data-nombre="<?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']); ?>">
                    <i class="fas fa-child"></i> Ver estudiantes
                </button>

                <?php if ($isAdmin): ?>
                    <button class="editar-btn" onclick="abrirModalEditar(
                            '<?php echo htmlspecialchars($row['id']); ?>',
                            '<?php echo addslashes(htmlspecialchars($row['nombre'])); ?>',
                            '<?php echo addslashes(htmlspecialchars($row['apellido'])); ?>',
                            '<?php echo htmlspecialchars($row['telefono']); ?>',
                            '<?php echo addslashes(htmlspecialchars($row['correo'])); ?>',
                            '<?php echo addslashes(htmlspecialchars($row['direccion'])); ?>',
                            '<?php echo htmlspecialchars($row['cedula']); ?>'
                        )"><i class="fas fa-edit"></i> Editar
                    </button>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="eliminar_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <button type="submit" class="eliminar-representante-btn" onclick="return confirm('¿Seguro que deseas eliminar este representante?')">
                            <i class="fas fa-trash-alt"></i> Eliminar
                        </button>
                    </form>
                    
                    <button 
                        data-id="<?php echo htmlspecialchars($row['id']); ?>" 
                        class="btn-custom btn-agregar-estudiante-a-rep"> 
                        <i class="fas fa-plus"></i>Add Estudiante
                    </button>
                    <?php else: ?>
                    <span class="sin-permiso" title="No tienes permiso para editar o eliminar"><i class="fas fa-ban"></i> Sin permisos</span>
                <?php endif; ?>
            </td>
        </tr>
        </tbody>
        <?php endwhile; ?>
    </table>
    </div>
    <footer id="footer">
        <i class="fas fa-copyright"></i> 2025. Software de Registro y Gestión de Representantes. Diseñado y desarrollado por los estudiantes de la Universidad Francisco Tamayo. Todos los derechos reservados.
    </footer>
</body>
</html>

<?php
    include("mod/modal_agregar_estudiante.php");
    include("mod/modal_editar.html");
    include("mod/modal_estudiantes.html");
    include('mod/modal_detallada.html');
    include("mod/modal_editar_estudiante.html");
?>