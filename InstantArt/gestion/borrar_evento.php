<?php
session_start();
require 'utilidades_gestion.php';

$id_cliente = isset($_POST['id_cliente']) ? $_POST['id_cliente'] : '';
$evento = isset($_POST['evento']) ? $_POST['evento'] : '';

// Construir la URL de la carpeta del evento
$url = '/' . $id_cliente . '/' . $evento;

// Conectar al servidor FTP
$conn_id = conexion_ftp();
$login_result = ftp_login($conn_id, $ftp_username, $ftp_userpass);

// Eliminar la carpeta del evento en el servidor FTP
borrarDirectorios($conn_id, $url);

// Cerrar la conexión FTP
ftp_close($conn_id);

try {
    // Conectar a la base de datos
    $bd = conexion_bd2();

    // Eliminar los registros de fotos de la base de datos
    $sql = "DELETE FROM fotos_ftp WHERE id_evento = ?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$evento]);

    // Verificar si se eliminaron registros de fotos
    $fotosBorradas = $stmt->rowCount() > 0;

     // Eliminar el registro de la tabla evento empleado
    $sql = "DELETE FROM evento_empleado WHERE id_evento = ?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$evento]);

    // Eliminar el evento de la base de datos
    $sql = "DELETE FROM evento WHERE id_evento = ?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$evento]);

    // Verificar si se eliminó el evento
    $eventoBorrado = $stmt->rowCount() > 0;

    if ($fotosBorradas || $eventoBorrado) {
        echo json_encode(['success' => true, 'message' => 'Evento y sus fotos borrados correctamente']);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron fotos o eventos para borrar']);
    }

} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Error al borrar fotos o evento: ' . $e->getMessage()]);
} finally {
    // Cerrar la conexión a la base de datos
    $bd = null;
}

