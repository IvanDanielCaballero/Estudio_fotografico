<?php
require 'utilidades.php';
session_start();


if (isset($_GET['id_cliente'])) {
    $id_cliente = intval($_GET['id_cliente']);
    echo eventos_cliente($id_cliente);
}

