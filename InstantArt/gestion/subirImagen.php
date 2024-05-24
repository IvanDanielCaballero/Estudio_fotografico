<?php
require 'utilidades_gestion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_cliente = intval($_POST['id_cliente']);
    $id_evento = intval($_POST['evento']);
    $imagenes = $_FILES['imagenes'];

    subirImagenes($id_cliente, $id_evento, $imagenes,);
}

