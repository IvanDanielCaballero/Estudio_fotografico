<?php


function conexion_bd2() {
    // Configuración de la conexión a la base de datos
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    try {
        // Crear una conexión PDO
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    } catch(PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
}


function conexion_bd(){

    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";


    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    return $conn;

}

function eventos_bd(){

         $conn = conexion_bd();

        $sql = "SELECT nombre, id_tipo_evento FROM tipo_evento";
        $result = $conn->query($sql);

        $events = [];
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                $events[] = $row;
         }
        }

    // Cerrar la conexión
    $conn->close();

    // Convertir los resultados a JSON
    return json_encode($events);
}

function equipos_bd(){

    $conn = conexion_bd();

   $sql = "SELECT nombre, id_equipo FROM equipo";
   $result = $conn->query($sql);

   $events = [];
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
           $events[] = $row;
    }
   }

// Cerrar la conexión
$conn->close();

// Convertir los resultados a JSON
return json_encode($events);
}

function empleados_bd(){

    $conn = conexion_bd();

    $sql = "SELECT id_empleado, CONCAT(nombre, ' ', apellidos) AS nombre FROM empleado";
   $result = $conn->query($sql);

   $events = [];
       if ($result->num_rows > 0) {
           while ($row = $result->fetch_assoc()) {
           $nombre[] = $row;
    }
   }

// Cerrar la conexión
$conn->close();

// Convertir los resultados a JSON
return json_encode($nombre);
}
