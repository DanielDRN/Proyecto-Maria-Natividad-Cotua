<?php

if (isset($_POST['registrar_estudiante']) && !empty($_POST['cedula_estudiante'])) {
    $id_representante = isset($_POST['id_representante']) ? intval($_POST['id_representante']) : 0;
    $ced_est   = trim($_POST['cedula_estudiante']);
    $nom_est   = trim($_POST['nombre_estudiante']);
    $ape_est   = trim($_POST['apellido_estudiante']);
    $gra_est   = trim($_POST['grado_estudiante']);
    $sex_est   = trim($_POST['sexo_estudiante']);
    $fech_est  = trim($_POST['fecha_estudiante']);
    $lug_nac   = trim($_POST['lugar_nacimiento']);
    $camisa_t  = trim($_POST['talla_camisa']);
    $zapato_t  = trim($_POST['talla_zapato']);
    $pantalon_est = trim($_POST['talla_pantalon']);

    if (empty($ced_est) || empty($nom_est) || empty($ape_est) || empty($gra_est) || empty($id_representante)) {
        echo "<script>alert('Error: Faltan campos obligatorios o el ID del representante.'); window.history.back();</script>";
        exit;
    }

    $query_est = "INSERT INTO estudiantes (cedula, nombre, apellido, genero, grado_session, Fecha_nacimiento, lug_nacimiento, TC, TZ, TP, id_representante) 
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt_est = mysqli_prepare($enlace, $query_est)) {
        
        mysqli_stmt_bind_param($stmt_est, "ssssssssssi", 
            $ced_est, 
            $nom_est, 
            $ape_est, 
            $sex_est, 
            $gra_est, 
            $fech_est, 
            $lug_nac, 
            $camisa_t, 
            $zapato_t,
            $pantalon_est, 
            $id_representante 
        );

        if (mysqli_stmt_execute($stmt_est)) {
            echo "<script>alert('Estudiante registrado exitosamente.'); window.location.href='gestion.php';</script>";
        } else {
            $err = mysqli_error($enlace);
            echo "<script>alert('Error al registrar el estudiante: " . addslashes($err) . "'); window.history.back();</script>";
        }
        mysqli_stmt_close($stmt_est);
        
    } else {
        $err = mysqli_error($enlace);
        echo "<script>alert('Error al preparar la consulta de estudiante: " . addslashes($err) . "'); window.history.back();</script>";
    }

} else if (isset($_POST['registrar_estudiante'])) {
    echo "<script>alert('Error: Datos incompletos del formulario.'); window.history.back();</script>";
}
?>