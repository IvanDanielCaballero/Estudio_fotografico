<?php
//elimina un empledo de la base de datos
session_start();
require_once "funciones.php";
$id = $_POST['id'];
try {
    $bd = conexion();
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
