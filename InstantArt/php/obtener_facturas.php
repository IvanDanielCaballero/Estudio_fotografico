<?php
session_start();

require '../php/funciones.php';
$bd = conexion();

// Preparar la consulta SQL para obtener los presupuesto del cliente
$sql = "SELECT * FROM estado_factura 
        JOIN factura  ON factura.id_estado_factura = estado_factura.id_estado_factura 
        JOIN evento on factura.id_evento=evento.id_evento
        WHERE factura.id_cliente = :id_cliente";
$stmt = $bd->prepare($sql);
$stmt->execute(['id_cliente' => $_SESSION['id_cliente']]);

// Obtener todos los resultados
$facturas = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($facturas);
?>
