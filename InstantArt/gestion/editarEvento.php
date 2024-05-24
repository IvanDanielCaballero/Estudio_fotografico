<?php
require 'utilidades_gestion.php';

session_start();
if (isset($_SESSION['usuario'])) {
    echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
}

if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
    echo '<script>var admin=true;</script>';
} else {
    header("Location: index.php");
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_evento = intval($_POST['evento']);
    $tipo_evento = intval($_POST['tipo_evento']);
    $equipo = intval($_POST['equipo']);
    $descripcion = $_POST['descripcion'];
    $estado = $_POST['estado'];
    $hora = $_POST['hora'];
    $localidad = $_POST['localidad'];
    $fecha = $_POST['fecha'];
    $empleado = intval($_POST['empleado']);


    $bd = conexion_bd2();

    $sql = "
        UPDATE evento
        SET id_tipo_evento = ?, descripcion = ?, estado = ?, hora = ?, localidad = ?, fecha = ?, id_equipo = ?
        WHERE id_evento = ?
    ";

    $stmt = $bd->prepare($sql);
    $result = $stmt->execute([$tipo_evento, $descripcion, $estado, $hora, $localidad, $fecha, $equipo, $id_evento]);

    if ($result) {
        // Actualizar el empleado asociado al evento
        $sqlEmpleado = "UPDATE evento_empleado SET id_empleado = ? WHERE id_evento = ?";
        $stmtEmpleado = $bd->prepare($sqlEmpleado);
        $resultEmpleado = $stmtEmpleado->execute([$empleado, $id_evento]);

        if ($resultEmpleado) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Error al actualizar el empleado']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error al actualizar el evento']);
    }

    // Cerrar la conexión
    $stmt->closeCursor();
    $bd = null;

    header('Location: gestion_proyectos.php');
}

