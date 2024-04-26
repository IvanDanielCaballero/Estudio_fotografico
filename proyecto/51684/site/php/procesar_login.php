<?php
session_start();
$servername = "217.160.114.39";
$username = "jose";
$password = "56lf2G9BnTez";
$dbname = "fotografia";


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
echo $usuario;
echo $contraseña;

try {
    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT nombre, contraseña FROM cliente WHERE nombre='$usuario' AND contraseña='$contraseña';";


    $sql2 = "SELECT nombre,contraseña,tipo FROM empleado
    JOIN tipo_empleado ON empleado.id_tipo_empleado=tipo_empleado.id_tipo_empleado WHERE nombre='$usuario' AND contraseña='$contraseña' AND tipo='Administrador'";

    $sql3 = "SELECT nombre,contraseña,tipo FROM empleado
    JOIN tipo_empleado ON empleado.id_tipo_empleado=tipo_empleado.id_tipo_empleado WHERE nombre='$usuario' AND contraseña='$contraseña' AND tipo='Empleado'";
    
    $query = $bd->query($sql);
    $query2 = $bd->query($sql2);
    $query3 = $bd->query($sql3);

    if ($query->rowCount() > 0) {
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['tiempo'] = time();
        $_SESSION['rol'] = 'cliente';


        header("location: ../index.php");
    }elseif($query2->rowCount()>0){
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['tiempo'] = time();
        $_SESSION['rol'] = 'admin';
        header("location: ../index.php");
    }elseif($query3->rowCount()>0){
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['tiempo'] = time();
        $_SESSION['rol'] = 'empleado';
        header("location: ../index.php");

    }else{
        header("location: ../login.php");
    }

    
    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
