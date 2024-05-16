<?php
$rutaImagen = '/miguel/Trabajo1/hola.jpg';

// Separar la ruta de la imagen por el caracter "/"
$partesRuta = explode('/', $rutaImagen);


$partesRuta=array_slice($partesRuta,-2);
var_dump($partesRuta);
$nombre= implode('_',$partesRuta);

echo $nombre;
return $nombre;