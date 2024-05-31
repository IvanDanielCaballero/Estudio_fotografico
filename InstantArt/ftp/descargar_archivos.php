<?php

if (isset($_GET['carpeta'])) {

    $rutaCarpeta = $_GET['carpeta'];

    $ftp_server = "217.160.114.39";
    $ftp_username = "usuarioftp";
    $ftp_userpass = "vML0TF1hCW7IIxA5HKjW";

    $conexion_ftp = ftp_connect($ftp_server);

    if ($conexion_ftp) {

        $login_ftp = ftp_login($conexion_ftp, $ftp_username, $ftp_userpass);


        if ($login_ftp) {

            if (ftp_chdir($conexion_ftp, $rutaCarpeta)) {

                $archivos = ftp_nlist($conexion_ftp, '.');

                $zip = new ZipArchive();
                $zip_nombre = 'Fotografias.zip';
                if ($zip->open($zip_nombre, ZipArchive::CREATE) === TRUE) {

                    header('Content-Type: MIME');
                    header('Content-Disposition: attachment; filename="' . $zip_nombre . '"');

                    foreach ($archivos as $archivo) {

                        $zip->addFromString(basename($archivo), ftp_get($conexion_ftp, 'php://output', $archivo, FTP_BINARY));
                    }
                    $zip->close();


                    readfile($zip_nombre);


                    unlink($zip_nombre);
                } else {
                    echo 'No se pudo crear el archivo ZIP.';
                }
            } else {
                echo 'No se pudo cambiar al directorio ' . $rutaCarpeta . ' en el servidor FTP.';
            }
        } else {
            echo 'No se pudo iniciar sesión en el servidor FTP.';
        }


        ftp_close($conexion_ftp);
    } else {
        echo 'No se pudo conectar al servidor FTP.';
    }
} else {
    echo 'Ruta de carpeta no especificada.';
}
