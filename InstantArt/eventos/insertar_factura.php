<?php
require '../php/funciones.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_cliente = $_POST['id_cliente'];
    $id_empleado = $_POST['empleado'];
    $id_evento = $_POST['id_evento'];
    $id_estado_factura = $_POST['estado'];
    $IVA = $_POST['IVA'];
    $importe = $_POST['precio'];
    $fecha_emision = $_POST['fecha_emision'];

    // Validar datos del formulario
    if (empty($id_cliente) || empty($id_empleado) || empty($id_evento) || empty($id_estado_factura) || empty($IVA) || empty($importe) || empty($fecha_emision)) {
        echo "Todos los campos son obligatorios.";
        exit();
    }

    try {
        // Conectar a la base de datos
        $pdo = conexion();

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO presupuesto (id_estado, id_cliente, id_evento, descripcion_detallada, fecha_creacion, fecha_vencimiento, precio) 
                VALUES (:id_estado_factura, :id_cliente, :id_evento, :descripcion_detallada, :fecha_creacion, :fecha_vencimiento, :importe)";

        $stmt = $pdo->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':id_estado_factura', $id_estado_factura, PDO::PARAM_INT);
        $stmt->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt->bindParam(':id_evento', $id_evento, PDO::PARAM_INT);
        $stmt->bindParam(':descripcion_detallada', $descripcion_detallada, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_creacion', $fecha_creacion, PDO::PARAM_STR);
        $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento, PDO::PARAM_STR);
        $stmt->bindParam(':importe', $importe, PDO::PARAM_STR);

        // Ejecutar la consulta
        $stmt->execute();
        $lastInsertedId = $pdo->lastInsertId();

        header("Location: generar_factura.php?id=" . $lastInsertedId.'&importe='.$importe.'&evento='.$id_evento);
        exit();

    } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
