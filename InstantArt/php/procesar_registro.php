<?php
require_once "funciones.php";
require "../areaPersonal/utilidades.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $contraseña = $_POST['contraseña'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];


    try {
        $bd = conexion();
        // Preparar la consulta SQL para insertar un nuevo registro
        $sql = "INSERT INTO cliente (contraseña, nombre, apellidos, email, fecha_nacimiento, telefono)
        VALUES ('$contraseña', '$nombre', '$apellidos', '$correo', '$fecha','$telefono');";
        $query = $bd->query($sql);

        if ($query->rowCount() > 0) {
            $_SESSION['usuario'] = $_POST['nombre'];
            $_SESSION['tiempo'] = time();
            $_SESSION['id_cliente'] = $bd->lastInsertId();

            //Añadir carpeta que almacenara los distintos proyectos (Miguel);
            $sql2 = "SELECT id_cliente FROM cliente  WHERE nombre = '$nombre' AND contraseña = '$contraseña'";
            $query2 = $bd->query($sql2);
            $dir = $query2->fetch(PDO::FETCH_ASSOC);
            $dir = $dir['id_cliente'];
            $conn_id = conexion_ftp();

            if ($conn_id) {
                crearDirectorioFTP($conn_id, $dir);
                ftp_close($conn_id);
                echo "Directorio creado";
            } else {
                echo "Nose ha podido crear el directorio";
            }



             header("location: ../index.php"); 
        } else {
            header("location: ../registrarse.html");
        }
    } catch (PDOException $e) {
        // Mostrar mensaje de error en caso de excepción
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario de manera POST, muestra un mensaje de error
    echo "El formulario no ha sido enviado correctamente.";
}
