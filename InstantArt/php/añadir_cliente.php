<?php
 session_start();
 require "funciones.php";
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $contraseña = $_POST['password'];
    $email = $_POST['email'];


    try {
        $bd = conexion();
        $sql = "INSERT INTO cliente (nombre, apellidos, email, fecha_nacimiento, contraseña, telefono) VALUES ('$nombre', '$apellido', '$email', '$fecha', '$contraseña', '$telefono')";
        $query = $bd->query($sql);

        header('Location: ../usuarios.php');

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario de manera POST, muestra un mensaje de error
    echo "El formulario no ha sido enviado correctamente.";
}