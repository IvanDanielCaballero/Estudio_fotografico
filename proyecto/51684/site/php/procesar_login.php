<?php
session_start();
$servername = "217.160.114.39";
$username = "jose";
$password = "56lf2G9BnTez";
$dbname = "fotografia";


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
echo $usuario;
echo $contraseña;

try {
    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT nombre, contraseña FROM cliente WHERE nombre='$usuario' AND contraseña='$contraseña';";


    $sql2 = "SELECT nombre,contraseña,tipo FROM empleado
    JOIN tipo_empleado ON empleado.id_tipo_empleado=tipo_empleado.id_tipo_empleado WHERE nombre='$usuario' AND contraseña='$contraseña' AND tipo='Administrador'";

    $sql3 = "SELECT nombre,contraseña,tipo FROM empleado
    JOIN tipo_empleado ON empleado.id_tipo_empleado=tipo_empleado.id_tipo_empleado WHERE nombre='$usuario' AND contraseña='$contraseña' AND tipo='Empleado'";
    
    $query = $bd->query($sql);
    $query2 = $bd->query($sql2);
    $query3 = $bd->query($sql3);

    if ($query->rowCount() > 0) {
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['tiempo'] = time();
        $_SESSION['rol'] = 'cliente';


        header("location: ../index.php");
    }elseif($query2->rowCount()>0){
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['tiempo'] = time();
        $_SESSION['rol'] = 'admin';
        header("location: ../index.php");
    }elseif($query3->rowCount()>0){
        $_SESSION['usuario'] = $_POST['usuario'];
        $_SESSION['tiempo'] = time();
        $_SESSION['rol'] = 'empleado';
        header("location: ../index.php");

    }else{
        header("location: ../login.php");
    }

    
    
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}


/* este seria el codigo si incluimos que evitamos el SQL INJECTION:
<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdf";

// Obtener los valores del formulario y limpiarlos
$usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_STRING);
$contraseña = filter_input(INPUT_POST, 'contraseña', FILTER_SANITIZE_STRING);

try {
    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Consulta preparada para evitar la inyección SQL
    $sql = "SELECT Nombre, Password FROM Usuarios WHERE nombre=:usuario AND Password=:contraseña";
    $stmt = $bd->prepare($sql);
    $stmt->bindParam(':usuario', $usuario);
    $stmt->bindParam(':contraseña', $contraseña);
    $stmt->execute();

    // Verificar si se encontraron resultados
    if ($stmt->rowCount() > 0) {
        // Obtener el rol del usuario
        $rol_sql = "SELECT Rol FROM Usuarios WHERE nombre=:usuario AND Password=:contraseña";
        $rol_stmt = $bd->prepare($rol_sql);
        $rol_stmt->bindParam(':usuario', $usuario);
        $rol_stmt->bindParam(':contraseña', $contraseña);
        $rol_stmt->execute();

        // Verificar el rol
        $rol = $rol_stmt->fetchColumn();
        if ($rol === 'Administrador') {
            $_SESSION['rol'] = "admin";
        } else {
            $_SESSION['rol'] = "usuario";
        }

        // Establecer sesión de usuario y redirigir al index.php
        $_SESSION['usuario'] = $usuario;
        header("location: ../index.php");
    } else {
        // Redirigir al login.php si no se encontraron resultados
        header("location: ../login.php");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
*/