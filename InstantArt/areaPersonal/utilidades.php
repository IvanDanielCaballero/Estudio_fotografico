<?php
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

// Función para borrar un directorio en el servidor FTP junto con todo su contenido
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


function eventos_cliente($id_cliente)
{
    $bd = conexion_bd2();


    // Preparar la consulta SQL para obtener los eventos del cliente
    $sql = "
    SELECT evento.id_evento, empleado.id_empleado,
    CONCAT(tipo_evento.nombre, ' el ', evento.fecha, ' en ', evento.localidad, ' a las ', evento.hora) AS evento
    FROM evento
    JOIN tipo_evento ON evento.id_tipo_evento = tipo_evento.id_tipo_evento
    JOIN equipo ON evento.id_equipo = equipo.id_equipo
    JOIN evento_empleado ON evento.id_evento = evento_empleado.id_evento
    JOIN empleado ON evento_empleado.id_empleado = empleado.id_empleado
    WHERE evento.id_cliente = ?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$id_cliente]);

    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cerrar la conexión
    $stmt->closeCursor();
    $bd = null;

    // Devolver los resultados en formato JSON
    return json_encode($result);
}

function conexion_bd2()
{
    // Configuración de la conexión a la base de datos
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    try {
        // Crear una conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
}