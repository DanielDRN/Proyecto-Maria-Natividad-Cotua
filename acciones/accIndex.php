<?php
session_start();
    if(isset($_POST['registro'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];
        $clave_hash = password_hash($clave, PASSWORD_DEFAULT);

        $insertarDatos = "INSERT INTO acceso (usuario, clave_hash) VALUES ('$usuario', '$clave_hash')";

        if (mysqli_query($enlace, $insertarDatos)) {
            echo "<script>alert('Registro exitoso');</script>";
        } else {
            echo "<script>mostrarModal('Error: " . mysqli_error($enlace) . "');</script>";
        }
    }
    if(isset($_POST['login'])) {
        $usuario = $_POST['usuario'];
        $clave = $_POST['clave'];

        $consulta = "SELECT * FROM acceso WHERE usuario='$usuario'";
        $resultado = mysqli_query($enlace, $consulta);

        if($fila = mysqli_fetch_assoc($resultado)) {
            if(password_verify($clave, $fila['clave_hash'])) {
                $_SESSION['usuario'] = $usuario;
                header("Location: http://localhost/proyecto/registro_gestion.php");
                exit();
            } else {
            }
        } else {
            
            echo "<script>mostrarModal('Usuario no encontrado o clave incorrecta');</script>";
        }
    }
?>