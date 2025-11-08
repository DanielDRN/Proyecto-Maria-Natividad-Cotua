<?php
    if(isset($_POST['editar_estudiante'])) {
        $id_estudiante = $_POST['id_estudiante'];
        $cedula_estudiante = $_POST['editarCedulaEstudiante'];
        $nombre_estudiante = $_POST['editarNombreEstudiante'];
        $apellido_estudiante = $_POST['editarApellidoEstudiante'];
        $grado_estudiante = $_POST['editarGradoEstudiante'];
        $sexo_estudiante = $_POST['editarSexo'];
        $fecha_nacimiento = $_POST['editarFechaNacimiento'];

            if (mysqli_num_rows($resultado) > 0) {
                echo "<script>alert('La cédula del estudiante ya está registrada.')</script>";
            } else {
                $query = "UPDATE estudiantes SET cedula='$cedula_estudiante', nombre='$nombre_estudiante', apellido='$apellido_estudiante', genero='$sexo_estudiante', grado_session='$grado_estudiante', Fecha_nacimiento='$fecha_nacimiento' WHERE id='$id_estudiante'";

                if (mysqli_query($enlace, $query)) {
                    echo "<script>alert('Estudiante actualizado exitosamente.')</script>";
                } else {
                    echo "<script>alert('Error al actualizar el estudiante.')</script>";
                }
            }
        }

        mysqli_close($enlace);
?>