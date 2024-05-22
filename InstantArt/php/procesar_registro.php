<?php
require_once "funciones.php";
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
