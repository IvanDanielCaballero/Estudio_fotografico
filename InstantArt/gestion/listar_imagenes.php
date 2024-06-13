<?php

session_start();

$ftp_server = "217.160.114.39";
$ftp_username = "usuarioftp";
$ftp_userpass = "vML0TF1hCW7IIxA5HKjW";
$ftp_path = $_GET['carpeta']; 


$conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server");
if (!@ftp_login($conn_id, $ftp_username, $ftp_userpass)) {
    die("No se pudo iniciar sesión.");
}

$files = ftp_nlist($conn_id, $ftp_path);
$image_urls = [];

foreach ($files as $file) {
    if (preg_match('/\.(jpg|jpeg|png|gif)$/', $file)) { //Comprobamos que los archivos sean imagenes
        $image_urls[] = "enviar_imagen.php?image=" . urlencode($file);
    }
}

ftp_close($conn_id);

header('Content-Type: application/json');
echo json_encode($image_urls);