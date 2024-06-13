<?php
if (isset($_SESSION['usuario'])) {
    echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
  }

  // Verifica si la sesión de usuario no está establecida
  if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
  }

  if (!isset($_SESSION['id_cliente'])) {
    header("Location: ../index.php");
  }