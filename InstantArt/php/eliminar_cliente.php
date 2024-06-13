<?php
session_start();
require_once "funciones.php";
$id = $_POST['id'];

echo "el id es".$id;


try {
    $bd = conexion();
    $sql = "DELETE FROM cliente WHERE id_cliente = $id";
    $query = $bd->query($sql);

    $conn_id = conexion_ftp();
    borrarDirectorios($conn_id, $id);


    if ($bd->query($sql) === TRUE) {
        echo "success";
    } else {
      
        echo "Error al eliminar usuario: ";
    }

    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
