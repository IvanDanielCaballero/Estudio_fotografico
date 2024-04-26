<?php

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $fecha = $_POST['fecha'];
    $contraseña = $_POST['contraseña'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];


    try {
        $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error PDO a excepción
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "hola";
        // Preparar la consulta SQL para insertar un nuevo registro
        $sql = "INSERT INTO cliente (contraseña, nombre, apellidos, email, fecha_nacimiento, telefono)
        VALUES ('$contraseña', '$nombre', '$apellidos', '$correo', '$fecha','$telefono');";
echo "hola";
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
