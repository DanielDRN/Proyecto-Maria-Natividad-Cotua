<?php
// Habilitar la visualización de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Establecer el encabezado para que la respuesta sea JSON
header('Content-Type: application/json');

// Conexión a la base de datos
$enlace = mysqli_connect('localhost:3307', 'root', '', 'cotua');

// Verificar la conexión
if (!$enlace) {
    echo json_encode(['error' => 'Error de conexión: ' . mysqli_connect_error()]);
    exit;
}

// Verificar si el parámetro 'id' está presente
if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'Falta el parámetro id del representante']);
    exit;
}

$id_representante = intval($_GET['id']);

// Consulta para obtener los estudiantes asociados al representante
$res = mysqli_query($enlace, "SELECT * FROM estudiantes WHERE id_representante = $id_representante");

if (!$res) {
    echo json_encode(['error' => 'Error en consulta: ' . mysqli_error($enlace)]);
    exit;
}

$estudiantes = [];
while ($row = mysqli_fetch_assoc($res)) {
    $estudiantes[] = $row;
}

// Devolver los datos de los estudiantes en formato JSON
echo json_encode($estudiantes);

// Cerrar la conexión
mysqli_close($enlace);

?>
