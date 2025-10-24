<?php
function contarRegistros($enlace, $tabla) {
    $tabla_segura = $enlace->real_escape_string($tabla);
    
    $sql = "SELECT COUNT(*) AS total FROM $tabla_segura";
    $resultado = $enlace->query($sql);

    if ($resultado && $fila = $resultado->fetch_assoc()) {
        $conteo = (int)$fila['total'];
        $resultado->free();
        return $conteo;
    }

    return 0;
}

$totalrepresentantes = contarRegistros($enlace, 'representantes');
?>
