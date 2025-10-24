<?php
include('conexion.php');


if (isset($_POST['editar_representante'])) {
    $id         = $_POST['editarId'] ?? null;
    $nombre     = $_POST['editarNombre'] ?? null;
    $apellido   = $_POST['editarApellido'] ?? null;
    $telefono   = $_POST['editarTelefono'] ?? null;
    $correo     = $_POST['editarCorreo'] ?? null;
    $direccion  = $_POST['editarDireccion'] ?? null;
    $cedula     = $_POST['editarCedula'] ?? null;


    if ($id && $nombre && $apellido && $telefono && $correo && $direccion && $cedula) {
        $id         = mysqli_real_escape_string($enlace, $id);
        $nombre     = mysqli_real_escape_string($enlace, $nombre);
        $apellido   = mysqli_real_escape_string($enlace, $apellido);
        $telefono   = mysqli_real_escape_string($enlace, $telefono);
        $correo     = mysqli_real_escape_string($enlace, $correo);
        $direccion  = mysqli_real_escape_string($enlace, $direccion);
        $cedula     = mysqli_real_escape_string($enlace, $cedula);

        $query = "UPDATE representantes SET 
                    nombre = '$nombre', 
                    apellido = '$apellido', 
                    telefono = '$telefono', 
                    correo = '$correo', 
                    direccion = '$direccion', 
                    cedula = '$cedula' 
                    WHERE id = $id";

        if (mysqli_query($enlace, $query)) {
            echo "<script>alert('Representante actualizado exitosamente.'); window.location.href = 'gestion.php';</script>";
            exit;
        } else {
            echo "Error al actualizar el representante: " . mysqli_error($enlace);
        }
    } else {
        echo "Todos los campos son obligatorios.";
    }
}
?>