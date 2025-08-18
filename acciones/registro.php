<?php
    include("conexion.php");
    
    if (isset($_POST['registrar_todo'])) {
        // Datos del representante
        $cedula = $_POST['cedula'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $telefono = $_POST['telefono'];
        $genero = $_POST['genero'];
        $direccion = $_POST['direccion'];
        $correo = $_POST['correo'];
        $parentesco = $_POST['parentesco'];

        // Validación básica
        if(empty($cedula) || empty($nombre) || empty($apellido) || empty($telefono) || empty($parentesco)) {
            echo "<script>alert('Por favor, complete todos los campos requeridos del representante.');</script>";
        } else {
            // Verificar si la cédula ya existe
            $verificar = "SELECT * FROM representantes WHERE cedula='$cedula'";
            $resultado = mysqli_query($enlace, $verificar);
            if(mysqli_num_rows($resultado) > 0) {
                echo "<script>alert('La cédula ya está registrada.');</script>";
            } else {
                $query = "INSERT INTO representantes (cedula, nombre, apellido, telefono, correo, genero, direccion, parentesco) VALUES ('$cedula', '$nombre', '$apellido', '$telefono', '$correo', '$genero', '$direccion', '$parentesco')";
                if(mysqli_query($enlace, $query)) {
                    $id_representante = mysqli_insert_id($enlace);

                    // Procesar estudiantes
                    $cedulas = $_POST['cedula_estudiante'];
                    $nombres = $_POST['nombre_estudiante'];
                    $apellidos = $_POST['apellido_estudiante'];
                    $grados = $_POST['grado_estudiante'];
                    $direccion = $_POST['direccion_estudiante'];

                    $errores_estudiantes = 0;
                    for ($i = 0; $i < count($cedulas); $i++) {
                        $ced_est = $cedulas[$i];
                        $nom_est = $nombres[$i];
                        $ape_est = $apellidos[$i];
                        $gra_est = $grados[$i];
                        $direc_est = $direccion[$i];

                        if(empty($ced_est) || empty($nom_est) || empty($ape_est) || empty($gra_est)) {
                            $errores_estudiantes++;
                            continue;
                        }

                        $query_est = "INSERT INTO estudiantes (cedula, nombre, apellido, grado_session, id_representante)
                                        VALUES ('$ced_est', '$nom_est', '$ape_est', '$direc_est', '$gra_est', '$id_representante')";
                        mysqli_query($enlace, $query_est);
                    }
                    if ($errores_estudiantes > 0) {
                        echo "<script>alert('Registro exitoso, pero algunos estudiantes no se guardaron por campos incompletos.');</script>";
                    } else {
                        echo "<script>alert('Registro exitoso de representante y estudiantes.');</script>";
                    }
                } else {
                    echo "<scrip>alert('Error al registrar representante: " . mysqli_error($enlace) . "');</script>";
                }
            }
        }
    }
?>
