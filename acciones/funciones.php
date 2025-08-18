<?php
require_once __DIR__ . '/conexion.php';

function obtenerEstudiantes($idRepresentante = null) {
    if (!isset($GLOBALS['pdo'])) {
        throw new Exception("No hay conexión a la base de datos");
    }
    
    $pdo = $GLOBALS['pdo'];
    
    try {
        if ($idRepresentante) {
            $stmt = $pdo->prepare("SELECT id, nombre, apellido, grado_session FROM estudiantes WHERE id_representante = ?");
            $stmt->execute([$idRepresentante]);
        } else {
            $stmt = $pdo->query("SELECT id, nombre, apellido, grado_session FROM estudiantes");
        }
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log("Error al obtener estudiantes: " . $e->getMessage());
        return [];
    }
}