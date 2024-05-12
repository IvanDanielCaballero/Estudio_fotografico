<?php
session_start();

$id = $_POST['id'];


$_SESSION['id_update'] = $id;

echo $_SESSION['id_update'];
