<?php
//se llama a este fichero cuando el usuario le da a cerrar sesion.
session_start();


session_destroy();

//y redirige al index
header("Location: index.html"); 
exit(); 
?>
