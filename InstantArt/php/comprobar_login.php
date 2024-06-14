<?php
//esto es un fichero al que se puede llamar desde un html poniendo la etiqueta script 
//que comprueba si estan logeado,si eres admin etc para saber que vas a mostrar o no.
session_start();
$inicio = isset($_SESSION['usuario']);
$admin = $inicio && isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin';

header('Content-Type: application/javascript');
?>
document.addEventListener("DOMContentLoaded", function() {
    if (<?php echo $inicio ? 'true' : 'false'; ?>) {
        document.getElementById("inicio_sesion").style.display = "none";
        document.getElementById("cerrar_sesion").style.display = "inline-block";
        document.getElementById("area_personal").style.display = "inline-block";
        console.log("Inicio sesión");
    }

    if (<?php echo $admin ? 'true' : 'false'; ?>) {
        console.log("Admin");
        document.getElementById("usuarios").style.display = "inline-block";
        document.getElementById("gestion_proyectos").style.display = "inline-block";
        document.getElementById("proyectos_empleado").style.display = "inline-block";
        document.getElementById("area_personal").style.display = "none";
    }
});
    