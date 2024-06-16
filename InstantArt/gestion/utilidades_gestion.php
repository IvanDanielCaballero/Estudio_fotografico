<?php


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


function conexion_bd()
{

    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;

}

function eventos_bd()
{

    $conn = conexion_bd();

    $sql = "SELECT nombre, id_tipo_evento FROM tipo_evento";
    $result = $conn->query($sql);

    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    // Cerrar la conexión
    $conn->close();

    // Convertir los resultados a JSON
    return json_encode($events);
}

function equipos_bd()
{

    $conn = conexion_bd();

    $sql = "SELECT nombre, id_equipo FROM equipo";
    $result = $conn->query($sql);

    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $events[] = $row;
        }
    }

    // Cerrar la conexión
    $conn->close();

    // Convertir los resultados a JSON
    return json_encode($events);
}

function empleados_bd()
{

    $conn = conexion_bd();

    $sql = "SELECT id_empleado, CONCAT(nombre, ' ', apellidos) AS nombre FROM empleado";
    $result = $conn->query($sql);

    $events = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $nombre[] = $row;
        }
    }

    // Cerrar la conexión
    $conn->close();

    // Convertir los resultados a JSON
    return json_encode($nombre);
}


function cliente_id($id_cliente)
{

    $bd = conexion_bd2();

    // Preparar la consulta SQL para insertar los datos en la tabla evento
    $sql = "SELECT CONCAT(nombre, ' ', apellidos) AS nombre FROM cliente WHERE id_cliente = ?";
    $stmt = $bd->prepare($sql);
    $result = $stmt->execute([$id_cliente]);

    // Obtener el resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cerrar la conexión
    $stmt->closeCursor();
    $bd = null;

    // Devolver el resultado en formato JSON
    return json_encode($result['nombre']);
}


function eventos_cliente($id_cliente)
{
    $bd = conexion_bd2();

    // Preparar la consulta SQL para obtener los eventos del cliente
    $sql = "
    SELECT evento.id_evento, empleado.id_empleado,
    CONCAT(tipo_evento.nombre,' ', evento.descripcion, ' el ', evento.fecha, ' en ', evento.localidad,'  a las ', evento.hora,'  ', 'con el ',equipo.nombre, ' por el  empleado ',empleado.nombre) AS evento
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

function subirImagenes($id_cliente, $id_evento, $imagenes) {


    // Conectar y hacer login al servidor FTP

    $ftp_server = "217.160.114.39";
    $ftp_user = "usuarioftp";
    $ftp_pass = "vML0TF1hCW7IIxA5HKjW";
    $uploadDir = '/'.$id_cliente.'/'.$id_evento.'/';
  //  echo $uploadDir;

    // Conexión al servidor FTP
    $conn_id = ftp_connect($ftp_server) or die("No se pudo conectar a $ftp_server");

    // Autenticación con el servidor FTP
    $login = ftp_login($conn_id, $ftp_user, $ftp_pass);

    // Comprobar si la autenticación fue exitosa
    if ($login) {
        echo "Conectado a $ftp_server\n";
    } else {
        echo "No se pudo autenticar en $ftp_server\n";
        ftp_close($conn_id);
        return false;
    }

    // Establecer modo pasivo
    ftp_pasv($conn_id, true);

    $uploadedFiles = [];

    foreach ($imagenes['name'] as $key => $name) {
        $tmpName = $imagenes['tmp_name'][$key];
        $error = $imagenes['error'][$key];
        $size = $imagenes['size'][$key];

        // Verificar que no haya errores en la subida de archivos
        if ($error === UPLOAD_ERR_OK) {
            // Crear un nombre único para el archivo
            $uniqueName = uniqid('img_', true) . '.' . pathinfo($name, PATHINFO_EXTENSION);;
            $remoteFile = $uploadDir . $uniqueName;

            // Subir el archivo al servidor FTP
            if (ftp_put($conn_id, $remoteFile, $tmpName, FTP_BINARY)) {
                $uploadedFiles[] = $uniqueName;

                $bd = conexion_bd2();

                // Consultar para obtener el id_empleado
                $sql2 = "SELECT id_empleado FROM evento_empleado WHERE id_evento = ?";
                $stmtEmpleado = $bd->prepare($sql2);
                $stmtEmpleado->execute([$id_evento]);
                $id_empleado = $stmtEmpleado->fetchColumn();
                $stmtEmpleado->closeCursor();

                $fecha_creacion = date('Y-m-d H:i:s');

                // Guardar la información del archivo en la base de datos
                $sql = "INSERT INTO fotos_ftp (id_evento, nombre_archivo, ruta_ftp, id_empleado, fecha_creacion) VALUES (?, ?, ?, ?,?)";
                $stmt = $bd->prepare($sql);
                $stmt->execute([$id_evento, $name, $remoteFile, $id_empleado,$fecha_creacion]);
                $stmt->closeCursor();
                $bd = null;

            } else {
                echo json_encode(['success' => false, 'message' => "Error al subir el archivo $name a FTP"]);
                return;
            }
        } else {
            echo json_encode(['success' => false, 'message' => "Error en el archivo $name: $error"]);
            return;
        }
    }

    // Cerrar la conexión FTP
    ftp_close($conn_id);

    echo json_encode(['success' => true, 'files' => $uploadedFiles]);
}

function borrarFotoPorURL($url) {
    $bd = conexion_bd2();
    if ($bd) {
        try {
            // Preparar la consulta SQL para eliminar la foto por su URL
            $sql = 'DELETE FROM fotos_ftp WHERE ruta_ftp = ?';
            $stmt = $bd->prepare($sql);
            $stmt->execute([$url]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => true, 'message' => 'Foto borrada correctamente']);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se encontró la foto con esa URL']);
            }
        } catch (PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Error al borrar la foto: ' . $e->getMessage()]);
        } finally {
            // Cerrar la conexión
            $bd = null;
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    }
}

// Función para eliminar una carpeta y su contenido en el servidor FTP
function borrarDirectorios($conn_id, $dir) {
    // Obtener una lista de archivos en el directorio
    $files = ftp_nlist($conn_id, $dir);
    if ($files !== false) {
        // Recorrer la lista de archivos y eliminar cada uno
        foreach ($files as $file) {
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
        } else {
            echo "No se pudo eliminar el directorio $dir\n";
        }
    } else {
        echo "No se pudo obtener la lista de archivos para $dir\n";
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