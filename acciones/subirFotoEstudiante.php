<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

$enlace = mysqli_connect('localhost:3307', 'root', '', 'cotua');

if (!$enlace) {
    echo json_encode(['error' => 'Error de conexión a la base de datos.']);
    exit;
}

if (!isset($_POST['id_estudiante']) || !isset($_FILES['foto'])) {
    echo json_encode(['error' => 'Parámetros faltantes: ID del estudiante o archivo de foto.']);
    exit;
}

$id_estudiante = intval($_POST['id_estudiante']);
$foto = $_FILES['foto'];
$directorio_subidas = '../img/estudiantes/';

if (!is_dir($directorio_subidas)) {
    mkdir($directorio_subidas, 0777, true);
}

$nombre_archivo = uniqid('foto_', true) . '.' . pathinfo($foto['name'], PATHINFO_EXTENSION);
$ruta_destino = $directorio_subidas . $nombre_archivo;

if (move_uploaded_file($foto['tmp_name'], $ruta_destino)) {
    $ruta_para_navegador = 'img/estudiantes/' . $nombre_archivo;
    
    $query = "UPDATE estudiantes SET foto = ? WHERE id = ?";
    $stmt = mysqli_prepare($enlace, $query);
    mysqli_stmt_bind_param($stmt, 'si', $ruta_para_navegador, $id_estudiante);
    
    if (mysqli_stmt_execute($stmt)) {
        echo json_encode(['success' => 'Foto subida y actualizada con éxito.', 'foto_nueva' => $ruta_para_navegador]);
    } else {
        unlink($ruta_destino);
        echo json_encode(['error' => 'Error al actualizar la base de datos: ' . mysqli_error($enlace)]);
    }
    mysqli_stmt_close($stmt);
} else {
    echo json_encode(['error' => 'Error al mover el archivo subido.']);
}

mysqli_close($enlace);

?>
