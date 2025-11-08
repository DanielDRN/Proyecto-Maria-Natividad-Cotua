<?php
if(isset($_POST['registro'])) {
    $usuario = $_POST['usuario'];
    $clave = $_POST['clave'];


    $sql_check = "SELECT COUNT(*) FROM acceso WHERE usuario = ?";
    $stmt_check = mysqli_prepare($enlace, $sql_check);
    mysqli_stmt_bind_param($stmt_check, "s", $usuario);
    mysqli_stmt_execute($stmt_check);
    mysqli_stmt_bind_result($stmt_check, $conteo);
    mysqli_stmt_fetch($stmt_check);
    mysqli_stmt_close($stmt_check);
    if ($conteo > 0) {
        echo "<script>alert('El usuario " . htmlspecialchars($usuario, ENT_QUOTES, 'UTF-8') . " ya existe. Por favor, elige otro.');</script>";
        return; 
    }
    
    $clave_hash = password_hash($clave, PASSWORD_DEFAULT);
    $insertarDatos = "INSERT INTO acceso (usuario, clave_hash) VALUES (?, ?)";

    $stmt_insert = mysqli_prepare($enlace, $insertarDatos);
    mysqli_stmt_bind_param($stmt_insert, "ss", $usuario, $clave_hash);

    if (mysqli_stmt_execute($stmt_insert)) {
        echo "<script>alert('Registro exitoso');</script>";
        header("Location: http://localhost/proyecto/index.php"); 
        exit();
    } else {
        echo "<script>alert('Error al registrar: " . mysqli_error($enlace) . "');</script>";
    }
    mysqli_stmt_close($stmt_insert);
}

