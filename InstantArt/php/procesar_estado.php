<?php
require '../php/funciones.php';
$bd = conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_presupuesto = $_POST['id_presupuesto'];
  $estado = $_POST['estado'];

  // Actualizar el estado del presupuesto en la base de datos
  $sql = "UPDATE presupuesto SET id_estado = :estado WHERE id_presupuesto = :id_presupuesto";
  $stmt = $bd->prepare($sql);
  $stmt->execute(['estado' => $estado, 'id_presupuesto' => $id_presupuesto]);

  // Redirigir de vuelta a la página de presupuestos
  header('Location: ../eventos/prueba.html');
  exit();
}
?>
