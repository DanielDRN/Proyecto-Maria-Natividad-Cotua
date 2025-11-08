<?php

    if (isset($_POST['registrar_todo'])) {
        
        $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : '';
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
        $apellido = isset($_POST['apellido']) ? trim($_POST['apellido']) : '';
        $telefono = isset($_POST['telefono']) ? trim($_POST['telefono']) : '';
        $genero = isset($_POST['genero']) ? trim($_POST['genero']) : '';
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
        $correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
        $parentesco = isset($_POST['parentesco']) ? trim($_POST['parentesco']) : '';

        if (empty($cedula) || empty($nombre) || empty($apellido) || empty($telefono) || empty($parentesco)) {
            echo "<script>alert('Por favor, complete todos los campos requeridos del representante');</script>";
        } else {
            $verificar_sql = "SELECT id FROM representantes WHERE cedula = ?";
            $stmt_ver = mysqli_prepare($enlace, $verificar_sql);
            mysqli_stmt_bind_param($stmt_ver, "s", $cedula);
            mysqli_stmt_execute($stmt_ver);
            mysqli_stmt_store_result($stmt_ver);
            $exists = mysqli_stmt_num_rows($stmt_ver) > 0;
            mysqli_stmt_close($stmt_ver);

            if ($exists) {
                echo "<script>alert('La cédula del representante ya está registrada.');</script>";
            } else {
                $insert_rep = "INSERT INTO representantes (cedula, nombre, apellido, telefono, correo, genero, direccion, parentesco) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                $stmt_ins = mysqli_prepare($enlace, $insert_rep);
                mysqli_stmt_bind_param($stmt_ins, "ssssssss", $cedula, $nombre, $apellido, $telefono, $correo, $genero, $direccion, $parentesco);

                if (mysqli_stmt_execute($stmt_ins)) {
                    $id_representante = mysqli_insert_id($enlace);
                    mysqli_stmt_close($stmt_ins);

                    if (isset($_POST['cedula_estudiante']) && is_array($_POST['cedula_estudiante']) && count($_POST['cedula_estudiante']) > 0) {
                        $cedulas_est = $_POST['cedula_estudiante'];
                        $nombres_est = isset($_POST['nombre_estudiante']) ? $_POST['nombre_estudiante'] : [];
                        $apellidos_est = isset($_POST['apellido_estudiante']) ? $_POST['apellido_estudiante'] : [];
                        $grados_est = isset($_POST['grado_estudiante']) ? $_POST['grado_estudiante'] : [];
                        $sexos_est = isset($_POST['sexo_estudiante']) ? $_POST['sexo_estudiante'] : [];
                        $fecha_est = isset($_POST['fecha_estudiante']) ? $_POST['fecha_estudiante'] : [];
                        $lugar_nac_est = isset($_POST['lugar_nacimiento']) ? $_POST['lugar_nacimiento'] : [];
                        $camisa_est = isset($_POST['talla_camisa']) ? $_POST['talla_camisa'] : [];
                        $zapato_est = isset($_POST['talla_zapato']) ? $_POST['talla_zapato'] : [];
                        $pantalon_est = isset($_POST['talla_pantalon']) ? $_POST['talla_pantalon'] : [];

                        $query_est = "INSERT INTO estudiantes (cedula, nombre, apellido, genero, grado_session, Fecha_nacimiento,lug_nacimiento,TC,TZ,id_representante) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                        $stmt_est = mysqli_prepare($enlace, $query_est);

                        for ($i = 0; $i < count($cedulas_est); $i++) {
                            $ced_est = isset($cedulas_est[$i]) ? trim($cedulas_est[$i]) : '';
                            $nom_est = isset($nombres_est[$i]) ? trim($nombres_est[$i]) : '';
                            $ape_est = isset($apellidos_est[$i]) ? trim($apellidos_est[$i]) : '';
                            $gra_est = isset($grados_est[$i]) ? trim($grados_est[$i]) : '';
                            $sex_est = isset($sexos_est[$i]) ? trim($sexos_est[$i]) : '';
                            $fech_est = isset($fecha_est[$i]) ? trim($fecha_est[$i]) : '';
                            $lugar_nac_est_val = isset($lugar_nac_est[$i]) ? trim($lugar_nac_est[$i]) : '';
                            $camisa_est_val = isset($camisa_est[$i]) ? trim($camisa_est[$i]) : '';
                            $zapato_est_val = isset($zapato_est[$i]) ? trim($zapato_est[$i]) : '';
                            
                            if (empty($ced_est) || empty($nom_est) || empty($ape_est) || empty($gra_est)) {
                                continue;
                            }

                            mysqli_stmt_bind_param(
                                $stmt_est, 
                                "sssssssssi",
                                $ced_est, 
                                $nom_est, 
                                $ape_est, 
                                $sex_est, 
                                $gra_est, 
                                $fech_est, 
                                $lugar_nac_est_val, 
                                $camisa_est_val, 
                                $zapato_est_val, 
                                $id_representante
                            );
                            mysqli_stmt_execute($stmt_est);
                        }

                        mysqli_stmt_close($stmt_est);
                    }

                } else {
                    $err = mysqli_error($enlace);
                    mysqli_stmt_close($stmt_ins);
                    echo "<script>alert('Error al registrar el representante: " . addslashes($err) . "');</script>";
                }
            }
        }
    }
?>