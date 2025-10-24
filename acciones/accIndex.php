<?php
session_start();


if(isset($_POST['login'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];

    $consulta = "SELECT clave_hash FROM acceso WHERE usuario = ?";
    
    $stmt_login = mysqli_prepare($enlace, $consulta);
    mysqli_stmt_bind_param($stmt_login, "s", $usuario);
    mysqli_stmt_execute($stmt_login);
    mysqli_stmt_bind_result($stmt_login, $clave_hash_db);
    if(mysqli_stmt_fetch($stmt_login)) {
        if(password_verify($clave, $clave_hash_db)) {
            $_SESSION['usuario'] = $usuario;
            header("Location: http://localhost/proyectotest/registro_gestion.php");
            exit();
        } else {
            echo "<script>alert('Clave incorrecta');</script>";
        }
    } else {
        echo "<script>alert('Usuario no encontrado');</script>";
    }
    mysqli_stmt_close($stmt_login);
}
?>