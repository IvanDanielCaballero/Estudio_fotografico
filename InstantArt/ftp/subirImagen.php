<?php
include 'ftp.php'; // Asegúrate de incluir tu archivo con las funciones FTP

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_cliente = $_POST['id_cliente'];
    $id_evento = $_POST['id_evento'];

    // Verificar si se ha subido algún archivo
    if (isset($_FILES['imagenes']) && count($_FILES['imagenes']['name']) > 0) {
        $conn_id = conexion_ftp();

        // Crear directorio si no existe
        $directorio = "$id_cliente/$id_evento";
        crearDirectorioFTP($conn_id, $directorio);

        foreach ($_FILES['imagenes']['tmp_name'] as $key => $tmp_name) {
            $file_name = $_FILES['imagenes']['name'][$key];
            $file_tmp = $_FILES['imagenes']['tmp_name'][$key];

            // Subir archivo al servidor FTP
            $remote_file = $directorio . '/' . $file_name;
            if (ftp_put($conn_id, $remote_file, $file_tmp, FTP_BINARY)) {
                echo "Archivo $file_name subido exitosamente.";
            } else {
                echo "Error al subir el archivo $file_name.";
            }
        }

        // Cerrar conexión FTP
        ftp_close($conn_id);
    } else {
        echo "No se seleccionaron archivos.";
    }
}
?>
