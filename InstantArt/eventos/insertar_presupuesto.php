<?php
require '../php/funciones.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $id_cliente=$_POST['id_cliente'];
    $id_evento =$_POST['id_evento_presupuesto'];

    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $estado = $_POST['estado'];
    $fecha_vencimiento = $_POST['fecha_vencimiento'];
    $fecha_creacion = $_POST['fecha_creacion'];

    

/*     MIRAR QUE NUMERO LLEVAN EL APROBADO , PENDIENTE ETC PARA PONER EN EL FORMULARIO EL VALOR */

    try {
        // Conectar a la base de datos
        $pdo = conexion();

        // Preparar la consulta SQL para insertar los datos
        $sql = "INSERT INTO presupuesto (id_estado, id_cliente, id_evento, descripcion_detallada, fecha_creacion , fecha_vencimiento, precio) 
                VALUES (:estado, :id_cliente, :id_evento, :descripcion, :fecha_creacion, :fecha_vencimiento, :precio)";

        $stmt = $pdo->prepare($sql);

        // Vincular los parámetros
        $stmt->bindParam(':id_cliente', $id_cliente);
        $stmt->bindParam(':id_evento', $id_evento);
        $stmt->bindParam(':descripcion', $descripcion);
        $stmt->bindParam(':precio', $precio);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':fecha_vencimiento', $fecha_vencimiento);
        $stmt->bindParam(':fecha_creacion', $fecha_creacion);

        // Ejecutar la consulta
        $stmt->execute();
        $lastInsertedId = $pdo->lastInsertId();

        header("Location: generar_presupuesto.php?id=". $lastInsertedId);

    } catch (PDOException $e) {
        echo 'Error en la conexión: ' . $e->getMessage();
    }
} else {
    echo "Método no permitido.";
}
?>
