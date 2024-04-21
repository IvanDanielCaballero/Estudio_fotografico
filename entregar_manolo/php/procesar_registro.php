<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdf";


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
echo $usuario;
echo $contraseña;

try {
    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT Nombre, Password FROM Usuarios WHERE nombre='$usuario' AND Password='$contraseña';";
    $sql2 = "SELECT Nombre FROM Usuarios WHERE nombre='$usuario' AND Password='$contraseña' AND Rol='Administrador'; ";


    $query = $bd->query($sql2);

    if ($query->rowCount() > 0) {
        $_SESSION['rol'] = "admin";

    }else{
        $_SESSION['rol'] = "usuario";
    }

    $query = $bd->query($sql);
    if ($query->rowCount() > 0) {
        $_SESSION['usuario'] = $_POST['usuario'];
       
        header("location: ../index.php");
    } else {
        header("location: ../registrarse.html");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
