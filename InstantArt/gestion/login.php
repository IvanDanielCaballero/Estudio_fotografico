<?php
if (isset($_SESSION['usuario'])) {
    echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
}

if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
    echo '<script>var admin=true;</script>';
} else {
    header("Location: ../index.php");
}