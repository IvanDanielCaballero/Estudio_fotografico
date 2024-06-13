<?php
require 'utilidades_gestion.php';


$ftp_server = "217.160.114.39";
$ftp_username = "usuarioftp";
$ftp_userpass = "vML0TF1hCW7IIxA5HKjW";
$image_path = $_GET['image'];

$conn_id = ftp_connect($ftp_server);
if (@ftp_login($conn_id, $ftp_username, $ftp_userpass)) {
    header('Content-Type: image/jpeg');
    $temp = fopen('php://temp', 'r+');
    ftp_fget($conn_id, $temp, $image_path, FTP_BINARY, 0);
    rewind($temp);
    fpassthru($temp);
    fclose($temp);
} else {
    echo "No se pudo iniciar sesión o descargar la imagen.";
}

ftp_close($conn_id);

