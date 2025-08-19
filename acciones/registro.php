<?php
    include("conexion.php");

    if (isset($_POST['registrar_todo'])) {
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $genero = $_POST['genero'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $parentesco = $_POST['parentesco'];

        if (empty($cedula) || empty($nombre) || empty($apellido) || empty($telefono) || empty($parentesco)) {
            echo "<script>alert('Por favor, complete todos los campos requeridos del representante'.)</script>";
        } else {
            $verificar = "SELECT * FROM representantes WHERE cedula='$cedula'";
            $resultado = mysqli_query($enlace, $verificar);

            if (mysqli_num_rows($resultado) > 0) {
                echo "<script>alert('La cédula del representante ya está registrada.')</script>";
            } else {
                $query = "INSERT INTO representantes (cedula, nombre, apellido, telefono, correo, genero, direccion, parentesco) VALUES ('$cedula', '$nombre', '$apellido', '$telefono', '$correo', '$genero', '$direccion', '$parentesco')";

                if (mysqli_query($enlace, $query)) {
                    $id_representante = mysqli_insert_id($enlace);

                    if (isset($_POST['cedula_estudiante']) && is_array($_POST['cedula_estudiante']) && count($_POST['cedula_estudiante']) > 0) {
                        $cedulas_est = $_POST['cedula_estudiante'];
                        $nombres_est = $_POST['nombre_estudiante'];
                        $apellidos_est = $_POST['apellido_estudiante'];
                        $grados_est = $_POST['grado_estudiante'];
                        $sexos_est = $_POST['sexo_estudiante'];
                        $fecha_est = $_POST['fecha_estudiante'];


                        $errores_estudiantes = 0;
                        for ($i = 0; $i < count($cedulas_est); $i++) {
                            $ced_est = $cedulas_est[$i];
                            $nom_est = $nombres_est[$i];
                            $ape_est = $apellidos_est[$i];
                            $gra_est = $grados_est[$i];
                            $sex_est = $sexos_est[$i];
                            $fech_est = $fecha_est[$i];
                            
                            if (empty($ced_est) || empty($nom_est) || empty($ape_est) || empty($gra_est)) {
                                $errores_estudiantes++;
                                continue;
                            }

                            $query_est = "INSERT INTO estudiantes (cedula, nombre, apellido, genero, grado_session, Fecha_nacimiento, id_representante) VALUES ('$ced_est', '$nom_est', '$ape_est', '$sex_est', '$gra_est', '$fech_est', '$id_representante')";
                            
                            mysqli_query($enlace, $query_est);
                        }
                    }

                    if ($errores_estudiantes > 0) {
                        echo "<script>alert('Registro exitoso, pero algunos estudiantes no se guardaron por campos incompletos.')</script>";
                    } else {
                        echo "<script>alert('Registro exitoso de representante y estudiantes.')</script>";
                    }
                } else {
                    echo "<script>alert('Error al registrar representante: ')" . mysqli_error($enlace) . "</script>";
                }
            }
        }
    }
?>
