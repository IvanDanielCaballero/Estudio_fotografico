<?php
 session_start();
 require "funciones.php";
 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $telefono = $_POST['telefono'];
    $fecha = $_POST['fecha'];
    $contraseña = $_POST['password'];
    $email = $_POST['email'];


    try {
        $bd = conexion();
        $sql = "INSERT INTO cliente (nombre, apellidos, email, fecha_nacimiento, contraseña, telefono) VALUES ('$nombre', '$apellido', '$email', '$fecha', '$contraseña', '$telefono')";
        $query = $bd->query($sql);

        //Añadir carpeta que almacenara los distintos proyectos (Miguel);
        $sql2 = "SELECT id_cliente FROM cliente  WHERE nombre = '$nombre' AND contraseña = '$contraseña'";
        $query2 = $bd->query($sql2);
        $dir = $query2->fetch(PDO::FETCH_ASSOC);
        $dir = $dir['id_cliente'];
        $conn_id= conexion_ftp();

        if($conn_id){
            crearDirectorioFTP($conn_id, $dir);
            ftp_close($conn_id);
            echo "Directorio creado";
        }else{
            echo "Nose ha podido crear el directorio";
        }

        header('Location: ../usuarios.php');

    } catch (PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
    }
} else {
    // Si no se ha enviado el formulario de manera POST, muestra un mensaje de error
    echo "El formulario no ha sido enviado correctamente.";
}