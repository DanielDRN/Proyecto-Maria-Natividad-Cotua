<?php
include ('acciones/gestionEstudiantes.php');
session_start();
if (empty($_SESSION['usuario'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Representantes Registrados</title>
    <link rel="stylesheet" href="style/style3.css">
</head>
<body>
    <nav>
        <div class="logo-container">
            <a href="docs/Reseña Histórica del Liceo Privado.docx" download="Reseña_Histórica_Maria_Natividad_Cotua.word">
                <img src="img/logo.png" alt="Logo" class="logo">
                <span class="logo-tooltip">Reseña Histórica (Descargar Documento Word)</span>
            </a>
        </div>
        <div class="nav-links">
            <a href="registro_gestion.php">Registro</a>
            <a download="ManualdeUsuario.pdf">User Manual</a>
            <a href="acciones/logout.php">Cerrar Session</a>
        </div>
    </nav>
    <h1>Representantes Registrados</h1>
    <input class="input-busqueda" oninput="this.value = this.value.replace(/[^0-9]/g, '')" type="text" id="buscador" placeholder="Buscar...">
    <table>
        <tr>
            <th>Nombre</th>
            <th>Cédula</th>
            <th>Teléfono</th>
            <th>Genero</th>
            <th>Direccion</th>
            <th>correo</th>
            <th>Ver estudiantes</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)): ?>
        <tr>
            <td><?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']); ?></td>
            <td><?php echo htmlspecialchars($row['cedula']); ?></td>
            <td><?php echo htmlspecialchars($row['telefono']); ?></td>
            <td><?php echo htmlspecialchars($row['genero'])?></td>
            <td><?php echo htmlspecialchars($row['direccion'])?></td>
            <td><?php echo htmlspecialchars($row['correo'])?></td>
            <td>
                <button class="ver-estudiantes-btn" data-id="<?php echo $row['id']; ?>" data-nombre="<?php echo htmlspecialchars($row['nombre'] . " " . $row['apellido']); ?>">
                    Ver estudiantes
                </button>
                <form method="post" style="display:inline;">
                    <input type="hidden" name="eliminar_id" value="<?php echo $row['id']; ?>">
                    <button type="submit" class="eliminar-representante-btn" onclick="return confirm('¿Seguro que deseas eliminar este representante?')">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <script src="js/gestion.js"></script>
    <script src="js/Modal_Manager.js"></script>
</body>
</html>

<?php
    include("mod/modal_estudiantes.html");
    include('mod/modal_detallada.html')
?>