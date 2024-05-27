<?php
session_start();
require '../ftp/utilidades.php';
require_once "funciones.php";
$id = $_POST['id'];


try {
    $bd = conexion();
    $sql = "DELETE FROM cliente WHERE id_cliente = $id";
    $query = $bd->query($sql);

    $conn_id = conexion_ftp();
    borrarDirectorios($conn_id,'$id');


    if ($bd->query($sql) === TRUE) {
        echo "success";
    } else {
      
        echo "Error al eliminar usuario: " . $conn->error;
    }

    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
