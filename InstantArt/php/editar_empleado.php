<?php
session_start();
require_once "funciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //se almacenan los datos del post en variables
    $id = $_SESSION['id_update'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo'];
    $contraseña = $_POST['password'];
    $dni = $_POST['dni'];
    $salario = $_POST['salario'];

    //comprueba si es administrador
    if ($tipo == 'Administrador' | $tipo == 'administrador') {
        $tipo2 = 1;
    } else {
        $tipo2 = 2;
    }

    try {
        $bd = conexion();
        //se hace un update del empledo seleccionado
        $sql = "UPDATE empleado SET nombre='$nombre', apellidos='$apellido', salario_mes='$salario' ,id_tipo_empleado='$tipo2', contraseña='$contraseña',telefono='$telefono' WHERE id_empleado=$id";
        $query = $bd->query($sql);

        header('Location: ../usuarios.php');
    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario de manera POST, muestra un mensaje de error
    echo "El formulario no ha sido enviado correctamente.";
}
