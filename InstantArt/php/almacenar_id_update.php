<?php
session_start();
// se llama a traves de ayax para almacenar el id de usuario a actualizar
$id = $_POST['id'];


$_SESSION['id_update'] = $id;

echo $_SESSION['id_update'];
