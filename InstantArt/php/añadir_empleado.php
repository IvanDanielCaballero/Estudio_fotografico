<?php
 session_start();
 require "funciones.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //se almacenan los datos del post en variables
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo'];
    $contraseña = $_POST['password'];
    $dni = $_POST['dni'];
    $salario = $_POST['salario'];
    //se comprueba si es admin
    if($tipo=='Administrador' | $tipo =='administrador'){
        $tipo2=1;
    }else{
        $tipo2=2;
    }


    try {
        //se hace un insert para los empleados
        $bd = conexion();
        $sql = "INSERT INTO empleado (nombre, apellidos, telefono, id_tipo_empleado, contraseña, dni, salario_mes) VALUES ('$nombre', '$apellido', '$telefono', '$tipo2', '$contraseña', '$dni','$salario')";
        $query = $bd->query($sql);

        header('Location: ../usuarios.php');

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario de manera POST, muestra un mensaje de error
    echo "El formulario no ha sido enviado correctamente.";
}