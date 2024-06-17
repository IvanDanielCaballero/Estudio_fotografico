<?php

if ($_SESSION['rol'] != 'admin' && $_SESSION['rol'] != 'empleado') {
    header("Location: ../index.php");
    exit(); 
}
