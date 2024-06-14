<?php
 session_start();
require "funciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //se almacenan los datos del post en variables
    $id=$_SESSION['id_update'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $contraseña = $_POST['password'];
    $email = $_POST['email'];


    try {
        $bd=conexion();
        //se hace un update de los datos del post
        $sql = "UPDATE cliente SET nombre='$nombre', apellidos='$apellido', email='$email', fecha_nacimiento='$fecha', contraseña='$contraseña',telefono='$telefono' WHERE id_cliente='$id'";
        $query = $bd->query($sql);

        header('Location: ../usuarios.php');

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario de manera POST, muestra un mensaje de error
    echo "El formulario no ha sido enviado correctamente.";
}
