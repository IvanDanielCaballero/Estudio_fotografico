<?php

session_start();
$_SESSION["id_evento"] = $_POST["id_evento"];
echo $_SESSION["id_evento"];
