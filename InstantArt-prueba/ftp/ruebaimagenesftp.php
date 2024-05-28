<?php
$ftp_server = "217.160.114.39";
$ftp_username = "usuarioftp";
$ftp_password = "vML0TF1hCW7IIxA5HKjW";
$ftp_directory = "18/4";
$zip_filename = 'imagenes.zip';
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
        } else {
            die("Error al crear el archivo ZIP");
        }
    }
} else {
    die("Error de conexión FTP");
}



