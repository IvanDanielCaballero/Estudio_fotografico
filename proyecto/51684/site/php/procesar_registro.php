<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pdf";


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];
echo $usuario;
echo $contraseña;

try {
    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT Nombre, Password FROM Usuarios WHERE nombre='$usuario' AND Password='$contraseña';";
    $sql2 = "SELECT Nombre FROM Usuarios WHERE nombre='$usuario' AND Password='$contraseña' AND Rol='Administrador'; ";


    $query = $bd->query($sql2);

    if ($query->rowCount() > 0) {
        $_SESSION['rol'] = "admin";

    }else{
        $_SESSION['rol'] = "usuario";
    }

    $query = $bd->query($sql);
    if ($query->rowCount() > 0) {
        $_SESSION['usuario'] = $_POST['usuario'];
       
        header("location: ../index.php");
    } else {
        header("location: ../registrarse.html");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}

/* este seria con sql injection
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
        // Consulta preparada para verificar el rol del usuario
        $sql2 = "SELECT Nombre FROM Usuarios WHERE nombre=:usuario AND Password=:contraseña AND Rol='Administrador'";
        $stmt2 = $bd->prepare($sql2);
        $stmt2->bindParam(':usuario', $usuario);
        $stmt2->bindParam(':contraseña', $contraseña);
        $stmt2->execute();

        // Verificar si el usuario es administrador
        if ($stmt2->rowCount() > 0) {
            $_SESSION['rol'] = "admin";
        } else {
            $_SESSION['rol'] = "usuario";
        }

        // Establecer sesión de usuario y redirigir al index.php
        $_SESSION['usuario'] = $usuario;
        header("location: ../index.php");
    } else {
        // Redirigir al registrarse.html si no se encontraron resultados
        header("location: ../registrarse.html");
    }
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>



*/