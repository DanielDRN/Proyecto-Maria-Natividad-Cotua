<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$enlace = mysqli_connect('localhost:3307', 'root', '', 'cotua');
if (!$enlace) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Error de conexión: ' . mysqli_connect_error()]);
    exit;
}

if (!isset($_GET['id'])) {
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Falta el parámetro id']);
    exit;
}

$id = intval($_GET['id']);
$res = mysqli_query($enlace, "SELECT cedula, nombre, apellido, grado_session FROM estudiantes WHERE id_representante = $id");
if (!$res) {
    "<button class='btn-info-estudiante'>Ver Informacion</button>";
    header('Content-Type: application/json');
    echo json_encode(['error' => 'Error en consulta: ' . mysqli_error($enlace)]);
    exit;
}
$datos = [];
while($row = mysqli_fetch_assoc($res)) {
    $datos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($datos);