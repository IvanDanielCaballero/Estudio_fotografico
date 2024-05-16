<?php

if (isset($_GET['carpeta'])) {
    // Ruta completa de la carpeta en el servidor FTP
    $rutaCarpeta = $_GET['carpeta'];

    // Configuración de conexión FTP
    $ftp_server = "217.160.114.39";
    $ftp_username = "usuarioftp";
    $ftp_userpass = "vML0TF1hCW7IIxA5HKjW";

    // Establece una conexión FTP
    $conexion_ftp = ftp_connect($ftp_server);

    // Verifica si la conexión FTP fue exitosa
    if ($conexion_ftp) {
        // Inicia sesión en el servidor FTP
        $login_ftp = ftp_login($conexion_ftp, $ftp_username, $ftp_userpass);

        // Verifica si se pudo iniciar sesión en el servidor FTP
        if ($login_ftp) {
            // Cambia al directorio de la carpeta en el servidor FTP
            if (ftp_chdir($conexion_ftp, $rutaCarpeta)) {
                // Obtiene el listado de archivos en el directorio actual
                $archivos = ftp_nlist($conexion_ftp, '.');

                // Inicializa el buffer de salida
               // ob_start();

                // Comprime los archivos en un archivo ZIP
                $zip = new ZipArchive();
                $zip_nombre = 'archivos.zip'; // Nombre del archivo ZIP
                if ($zip->open($zip_nombre, ZipArchive::CREATE) === TRUE) {

                    header('Content-Type: MIME');
                    header('Content-Disposition: attachment; filename="' .$zip_nombre.'"');

                    foreach ($archivos as $archivo) {
                        // Agrega cada archivo al archivo ZIP
                        $zip->addFromString(basename($archivo), ftp_get($conexion_ftp, 'php://output', $archivo, FTP_BINARY));
                    }
                    $zip->close();

                    // Descarga el archivo ZIP
                    readfile($zip_nombre);

                    // Elimina el archivo ZIP temporal
                    unlink($zip_nombre);
                } else {
                    echo 'No se pudo crear el archivo ZIP.';
                }

                // Limpia el buffer de salida
               // ob_end_flush();
            } else {
                echo 'No se pudo cambiar al directorio ' . $rutaCarpeta . ' en el servidor FTP.';
            }
        } else {
            echo 'No se pudo iniciar sesión en el servidor FTP.';
        }

        // Cierra la conexión FTP
        ftp_close($conexion_ftp);
    } else {
        echo 'No se pudo conectar al servidor FTP.';
    }
} else {
    echo 'Ruta de carpeta no especificada.';
}

