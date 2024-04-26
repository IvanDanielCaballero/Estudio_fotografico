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

    $id=$_SESSION['id_update'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $tipo = $_POST['tipo'];
    $contraseña = $_POST['password'];
    $dni = $_POST['dni'];
    $salario = $_POST['salario'];

    if($tipo=='Administrador' | $tipo =='administrador'){
        $tipo2=1;
    }else{
        $tipo2=2;
    }



    try {
        $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Establecer el modo de error PDO a excepción
        $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
