<?php

session_start();

// Establecer la conexión FTP
$ftp_server = "217.160.114.39";
$ftp_name = "usuarioftp";
$ftp_pass = "vML0TF1hCW7IIxA5HKjW";
$ftp_conn = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server");
$ftp_path = "/".'18';

// Iniciar sesión FTP
if (@ftp_login($ftp_conn, $ftp_name, $ftp_pass)) {
    // Obtener lista de carpetas
    $carpetas = ftp_nlist($ftp_conn, $ftp_path);
    // Cerrar conexión FTP
    ftp_close($ftp_conn);
    // Devolver la lista de carpetas como respuesta JSON
    echo json_encode($carpetas);
} else {
    echo json_encode(array()); // Si falla la autenticación, devolver un array vacío
}

