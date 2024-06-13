<?php

function conexion(){
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $bd;
}


function borrarDirectorios($conn_id, $dir) {
    // Obtener una lista de archivos en el directorio

    $dir= '/'.$dir;
    $files = ftp_nlist($conn_id, $dir);

    if ($files !== false) {
        // Recorrer la lista de archivos y eliminar cada uno
        foreach ($files as $file) {
            // Formar el camino completo del archivo o directorio
            echo $file;

            // Ignorar los directorios . y ..
            if ($file == '.' || $file == '..') {
                continue;
            }

            // Si es un directorio, llamamos recursivamente a borrarDirectorio
            if (ftp_size($conn_id, $file) == -1) {
                borrarDirectorios($conn_id, $file);
            } else {
                ftp_delete($conn_id, $file);
            }
        }
        // Finalmente, eliminar el directorio
        if (ftp_rmdir($conn_id, $dir)) {
            echo "Directorio $dir eliminado exitosamente\n";
            return true;
        } else {
            echo "No se pudo eliminar el directorio $dir\n";
            return false;
        }
    } else {
        echo "No se pudo obtener la lista de archivos para $dir\n";
        return false;
    }
}

function conexion_ftp(){

    $ftp_server = "217.160.114.39";
    $ftp_user = "usuarioftp";
    $ftp_pass = "vML0TF1hCW7IIxA5HKjW";

    // Conexión al servidor FTP
    $conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server");

    // Autenticación con el servidor FTP
    $login_result = ftp_login($conn_id, $ftp_user, $ftp_pass);

    // Comprobar si la autenticación fue exitosa
    if ($login_result) {
        echo "Conectado a $ftp_server\n";
        return $conn_id;
    } else {
        echo "No se pudo autenticar en $ftp_server\n";
        ftp_close($conn_id);
        return false;
    }
}

//Creamos un directorio con el id_cliente, se ejecuta al dar de alta el cliente
function crearDirectorioFTP($conn_id, $dir) {
    $dir= '/'.$dir;
    if (ftp_mkdir($conn_id, $dir)) {
        echo "Directorio $dir creado exitosamente\n";
        return true;
    } else {
        echo "No se pudo crear el directorio $dir\n";
        return false;
    }
}