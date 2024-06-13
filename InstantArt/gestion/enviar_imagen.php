<?php
require 'utilidades_gestion.php';

$ftp_server = "217.160.114.39";
$ftp_username = "usuarioftp";
$ftp_userpass = "vML0TF1hCW7IIxA5HKjW";
$image_path = $_GET['image'];

// Obtiene la ruta de la imagen desde el parámetro URL
$conn_id = ftp_connect($ftp_server);

// Verifica si la conexión y el inicio de sesión son exitosos
if (@ftp_login($conn_id, $ftp_username, $ftp_userpass)) {
    header('Content-Type: image/jpeg');
    $temp = fopen('php://temp', 'r+');

     // Descarga el archivo de imagen desde el servidor FTP al recurso
    ftp_fget($conn_id, $temp, $image_path, FTP_BINARY, 0);
    rewind($temp);
    // Envía el contenido del recurso de flujo temporal al navegador
    fpassthru($temp);
    // Cierra el recurso de flujo temporal
    fclose($temp);
} else {
    echo "No se pudo iniciar sesión o descargar la imagen.";
}

ftp_close($conn_id);

