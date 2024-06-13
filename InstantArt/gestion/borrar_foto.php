<?php
require 'utilidades_gestion.php';
header('Content-Type: application/json');

$ftp_server = "217.160.114.39";
$ftp_username = "usuarioftp";
$ftp_userpass = "vML0TF1hCW7IIxA5HKjW";
// Decodifica la ruta de la imagen obtenida del parámetro URL
$image_path = urldecode($_GET['image']);


$conn_id = ftp_connect($ftp_server);
// Verifica si la conexión y el inicio de sesión son exitosos
if (@ftp_login($conn_id, $ftp_username, $ftp_userpass)) {

    // Intenta borrar el archivo en la ruta especificada
    if (ftp_delete($conn_id, $image_path)) {
        echo json_encode(['success' => true]);
        borrarFotoPorURL($image_path); //Borro la imagen de la base de datos
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al borrar la imagen.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'No se pudo conectar al servidor FTP.']);
}


ftp_close($conn_id);

