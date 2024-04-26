<?php


 session_start();
 /*
if (!isset($_SESSION['usuario'])) {
    header("location: login.php");
}  */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $contraseña = $_POST['password'];
    $email = $_POST['email'];


    try {
        $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error PDO a excepción
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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