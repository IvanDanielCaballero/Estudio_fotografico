<?php
require '../gestion/utilidades_gestion.php';
header('Content-Type: application/json');

$ftp_server = "217.160.114.39";
$ftp_username = "usuarioftp";
$ftp_userpass = "vML0TF1hCW7IIxA5HKjW";
$image_path = urldecode($_GET['image']);


$conn_id = ftp_connect($ftp_server);
if (@ftp_login($conn_id, $ftp_username, $ftp_userpass)) {
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

