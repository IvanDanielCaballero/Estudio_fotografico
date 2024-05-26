<?php
require 'utilidades_gestion.php';

if (isset($_GET['id_evento'])) {
    $id_evento = intval($_GET['id_evento']);
    echo obtener_fotos($id_evento);
}

function obtener_fotos($id_evento) {
    $bd = conexion_bd2();

    // Preparar la consulta SQL para obtener las fotos del evento
    $sql = "SELECT ruta_ftp FROM fotos_ftp WHERE id_evento = ?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$id_evento]);

    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cerrar la conexión
    $stmt->closeCursor();
    $bd = null;

    // Devolver los resultados en formato JSON
    return json_encode($result);
}
