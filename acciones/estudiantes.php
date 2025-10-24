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
    echo json_encode(['error' => 'Falta el parámetro id del representante']);
    exit;
}

$id_representante = intval($_GET['id']);


$res = mysqli_query($enlace, "SELECT * FROM estudiantes WHERE id_representante = $id_representante");

if (!$res) {
    echo json_encode(['error' => 'Error en consulta: ' . mysqli_error($enlace)]);
    exit;
}

$estudiantes = [];
while ($row = mysqli_fetch_assoc($res)) {
    $estudiantes[] = $row;
}

echo json_encode($estudiantes);


mysqli_close($enlace);

?>
