<?php
require '../gestion/utilidades_gestion.php';
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
$cliente = $_POST['id_cliente'];
$tipo = $_POST['tipo_evento'];
$equipo = $_POST['equipo'];
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$estado = $_POST['estado'];
$localidad = $_POST['localidad'];
$empleado = $_POST['empleado'];
$hora = $_POST['hora'];


try {
    $bd = conexion_bd2();

    // Preparar la consulta SQL para insertar los datos en la tabla evento
    $sql = "INSERT INTO evento (id_tipo_evento, id_equipo, descripcion, fecha, localidad, hora, estado, id_cliente) VALUES (?, ?, ?, ?, ?, ?, ?,?)";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$tipo, $equipo, $descripcion, $fecha, $localidad, $hora, $estado, $cliente]);

    $id_evento = $bd->lastInsertId();
    echo $id_evento;

    $sql2 = "INSERT INTO evento_empleado (id_empleado, id_evento) VALUES (?, ?)";
    $stmt2 = $bd->prepare($sql2);
    $stmt2->execute([$empleado, $id_evento]);

    // Seleccionar el id_cliente del evento recién creado
    $sql3 = "SELECT id_cliente FROM evento WHERE id_evento = ?";
    $stmt3 = $bd->prepare($sql3);
    $stmt3->execute([$id_evento]);
    $id_cliente = $stmt3->fetchColumn();

    // Conectar al servidor FTP y crear el directorio correspondiente
    $conn_id = conexion_ftp();
    crearDirectorioFTP($conn_id, $id_cliente . '/' . $id_evento);
    header('Location: gestion_proyectos.php');

} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
