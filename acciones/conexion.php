<?php
$servidor = 'localhost:3307';
$usuario = 'root';
$clave = '';
$baseDeDatos = 'cotua';


$enlace = mysqli_connect($servidor, $usuario, $clave, $baseDeDatos);
if (!$enlace) {
    die("Error de conexión: " . mysqli_connect_error());
}
mysqli_set_charset($enlace, "utf8mb4");
return $enlace;
?>