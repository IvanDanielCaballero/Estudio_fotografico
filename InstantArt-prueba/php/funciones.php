<?php

function conexion(){
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $bd;
}


