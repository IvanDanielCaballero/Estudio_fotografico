<?php

function conexion_bd2()
{
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
    } catch (PDOException $e) {
        echo "Error al conectar a la base de datos: " . $e->getMessage();
    }
}


function conexion_bd()
{

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

function eventos_bd()
{

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

function equipos_bd()
{

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

function empleados_bd()
{

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


function cliente_id($id_cliente)
{

    $bd = conexion_bd2();

    // Preparar la consulta SQL para insertar los datos en la tabla evento
    $sql = "SELECT CONCAT(nombre, ' ', apellidos) AS nombre FROM cliente WHERE id_cliente = ?";
    $stmt = $bd->prepare($sql);
    $result = $stmt->execute([$id_cliente]);

    // Obtener el resultado
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Cerrar la conexión
    $stmt->closeCursor();
    $bd = null;

    // Devolver el resultado en formato JSON
    return json_encode($result['nombre']);
}


function eventos_cliente($id_cliente)
{
    $bd = conexion_bd2();


    // Preparar la consulta SQL para obtener los eventos del cliente
    $sql = "
    SELECT evento.id_evento,
    CONCAT(tipo_evento.nombre,' ', evento.descripcion, ' el ', evento.fecha, ' en ', evento.localidad,'  a las ', evento.hora,'  ', 'con el ',equipo.nombre, ' por el  empleado ',empleado.nombre) AS evento
    FROM evento
    JOIN tipo_evento ON evento.id_tipo_evento = tipo_evento.id_tipo_evento
    JOIN equipo ON evento.id_equipo = equipo.id_equipo
    JOIN evento_empleado ON evento.id_evento = evento_empleado.id_evento
    JOIN empleado ON evento_empleado.id_empleado = empleado.id_empleado
    WHERE evento.id_cliente = ?";
    $stmt = $bd->prepare($sql);
    $stmt->execute([$id_cliente]);

    // Obtener todos los resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Cerrar la conexión
    $stmt->closeCursor();
    $bd = null;

    // Devolver los resultados en formato JSON
    return json_encode($result);
}