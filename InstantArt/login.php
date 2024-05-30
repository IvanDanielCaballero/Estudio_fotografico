<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/form.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" crossorigin="anonymous"></script>

</head>

<body>
    <div class="container contenedor">
        <section>
            <form action="php/procesar_login.php" method="POST">
                <h1>Iniciar Sesion</h1>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="text" name="usuario" required autocomplete="off">
                    <label for="">Usuario</label>
                </div>

                <div class="inputbox">
                    <ion-icon name="lock-closed-outline"></ion-icon>
                    <input type="password" name="contraseña" required autocomplete="off">
                    <label for="">Contraseña</label>
                </div>

                <div class="forget">
                    <label for=""> <input type="checkbox">Recordar</label>
                    <a href="#">Olvidé la Contraseña</a>

                </div>

                <button class="rounded-pill boton">Login</button>

                <div class="Register">
                    <br>
                    <p>No tengo una cuenta <a href="registrarse.html">Registrarse</a></p>
                </div>
            </form>
        </section>
    </div>

    <?php
    session_start();

    session_destroy();
    
    exit;
    ?>

</body>

</html>