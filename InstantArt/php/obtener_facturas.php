<?php
session_start();

require '../php/funciones.php';
$bd = conexion();

// Preparar la consulta SQL para obtener los presupuesto del cliente
$sql = "SELECT * FROM factura 
        JOIN estado_presupuesto ON presupuesto.id_estado = estado_presupuesto.id_estado 
        WHERE id_cliente = :id_cliente";
$stmt = $bd->prepare($sql);
$stmt->execute(['id_cliente' => $_SESSION['id_cliente']]);

// Obtener todos los resultados
$presupuesto = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($presupuesto);
?>
