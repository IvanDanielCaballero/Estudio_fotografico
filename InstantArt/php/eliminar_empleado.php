<?php
session_start();

$id = $_POST['id'];

$servername = "217.160.114.39";
$username = "jose";
$password = "56lf2G9BnTez";
$dbname = "fotografia";



try {
    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Establecer el modo de error PDO a excepción
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "DELETE FROM empleado WHERE id_empleado = $id";
    $query = $bd->query($sql);


    if ($bd->query($sql) === TRUE) {
        echo "success";
    } else {
      
        echo "Error al eliminar usuario: " . $conn->error;
    }

    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
