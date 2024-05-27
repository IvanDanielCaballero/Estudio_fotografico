<?php
require 'utilidades_gestion.php';

session_start();

if (isset($_GET['id_cliente'])) {
    $id_cliente = intval($_GET['id_cliente']);
    echo cliente_id($id_cliente);
}
