<?php
session_start();
function downloadZipFromFTP() {
    $ftp_server = "217.160.114.39";
    $ftp_username = "usuarioftp";
    $ftp_password = "vML0TF1hCW7IIxA5HKjW";
    $ftp_directory = "$_SESSION[id_cliente]/$_SESSION[id_evento]";
    $zip_filename = 'imagenes.zip';

    // Conectar al servidor FTP
    $conn_id = ftp_connect($ftp_server);

    if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
        ftp_pasv($conn_id, true);
        $files = ftp_nlist($conn_id, $ftp_directory);
        $image_files = array_filter($files, function($file) {
            return preg_match('/\.(jpg|jpeg|png|gif)$/i', $file);
        });
        ftp_close($conn_id);
        
        if (!empty($image_files)) {
            $zip = new ZipArchive();
            if ($zip->open($zip_filename, ZipArchive::CREATE) === TRUE) {
                foreach ($image_files as $file) {
                    $conn_id = ftp_connect($ftp_server);
                    ftp_login($conn_id, $ftp_username, $ftp_password);
                    ftp_pasv($conn_id, true);
                    $local_file = tempnam(sys_get_temp_dir(), 'ftp');
                    if (ftp_get($conn_id, $local_file, $file, FTP_BINARY)) {
                        $zip->addFile($local_file, basename($file));
                    }
                    ftp_close($conn_id);
                }
                $zip->close();

                // Forzar la descarga del archivo ZIP
                header('Content-Type: application/zip');
                header('Content-Disposition: attachment; filename="' . $zip_filename . '"');
                header('Content-Length: ' . filesize($zip_filename));
                readfile($zip_filename);
                
                // Eliminar el archivo ZIP temporal
                unlink($zip_filename);
                exit;
            } else {
                die("Error al crear el archivo ZIP");
            }
        } else {
            die("No se encontraron archivos de imagen en el directorio FTP");
        }

        header("Location areaPersonal.php");
    } else {
        die("Error de conexión FTP");
    }
}

// Llamada a la función para descargar el archivo ZIP
downloadZipFromFTP();
?>
