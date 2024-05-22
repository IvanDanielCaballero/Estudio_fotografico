<?php
session_start();
require_once "funciones.php";
$id = $_POST['id'];
try {
    $bd = conexion();
    $sql = "DELETE FROM cliente WHERE id_cliente = $id";
    $query = $bd->query($sql);


    if ($bd->query($sql) === TRUE) {
        echo "success";
    } else {
      
        echo "Error al eliminar usuario: " . $conn->error;
    }

    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
