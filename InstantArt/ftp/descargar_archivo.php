<?php


    // Ruta completa de la carpeta en el servidor FTP


   // function descargar($ruta_local,$nombre_archivo){

         // Configuración de conexión FTP
    $ftp_server = "217.160.114.39";
    $ftp_user = "usuarioftp";
    $ftp_pass = "vML0TF1hCW7IIxA5HKjW";
    $ftp_file= $_GET['url'];

    // Nombre sugerido para la descarga
$download_filename =  obtenerNombre($ftp_file);

// Establecer conexión FTP
$conn_id = ftp_connect($ftp_server);
if (!$conn_id) {
    die('Error al conectar al servidor FTP');
}

// Iniciar sesión en el servidor FTP
$login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);
if (!$login_result) {
    die('Error al iniciar sesión en el servidor FTP');
}

// Abrir archivo en modo binario para transferencia
$temp_file = tempnam(sys_get_temp_dir(), 'ftp_');
if (!$temp_file) {
    die('Error al crear archivo temporal');
}

$file_handle = fopen($temp_file, 'wb');
if (!$file_handle) {
    die('Error al abrir archivo temporal');
}

// Descargar archivo desde el servidor FTP
if (!ftp_fget($conn_id, $file_handle, $ftp_file, FTP_BINARY)) {
    fclose($file_handle);
    unlink($temp_file);
    die('Error al descargar archivo desde el servidor FTP'.$ftp_file);
}

// Cerrar conexión FTP
ftp_close($conn_id);

// Configurar cabeceras para indicar descarga de archivo
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $download_filename . '"');
header('Content-Length: ' . filesize($temp_file));

// Enviar contenido del archivo al navegador
readfile($temp_file);

// Eliminar archivo temporal después de enviarlo
fclose($file_handle);
unlink($temp_file);

function obtenerNombre($rutaImagen) {

// Separar la ruta de la imagen por el caracter "/"
$partesRuta = explode('/', $rutaImagen);


$partesRuta=array_slice($partesRuta,-2);
var_dump($partesRuta);
$nombre= implode('_',$partesRuta);

echo $nombre;
return $nombre;
}