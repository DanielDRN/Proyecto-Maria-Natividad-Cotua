<?php
include('conexion.php');
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');
if (!$enlace) {
    echo json_encode(['error' => 'Error de conexión: ' . mysqli_connect_error()]);
    exit;
}

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Falta el parámetro id']);
    exit;
}

$id = intval($_GET['id']);

$res = mysqli_query($enlace, "
    SELECT 
        e.*, 
        r.nombre AS nombre_representante, 
        r.apellido AS apellido_representante,
        e.foto AS foto_estudiante
    FROM 
        estudiantes e
    JOIN 
        representantes r ON e.id_representante = r.id
    WHERE 
        e.id = $id
");

if (!$res) {
    echo json_encode(['error' => 'Error en consulta: ' . mysqli_error($enlace)]);
    exit;
}

$datos = mysqli_fetch_assoc($res);

if (!$datos) {
    echo json_encode(['error' => 'No se encontró el estudiante con el ID proporcionado.']);
    exit;
}

$datos['nombre_representante'] = $datos['nombre_representante'] . ' ' . $datos['apellido_representante'];

echo json_encode($datos);

mysqli_close($enlace);

?>
