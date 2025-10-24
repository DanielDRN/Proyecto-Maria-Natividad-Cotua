<?php
include("conexion.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['eliminar_id'])) {
    $id = intval($_POST['eliminar_id']);
    mysqli_query($enlace, "DELETE FROM representantes WHERE id = $id");
    header("Location: gestion.php");
    exit;
}

$result = mysqli_query($enlace, "SELECT * FROM representantes");
?>