<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Home</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Work+Sans:300,700,800%7CIBM+Plex+Sans:200,300,400,400i,600,700">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/style.css">
  <style>
    .ie-panel {
      display: none;
      background: #212121;
      padding: 10px 0;
      box-shadow: 3px 3px 5px 0 rgba(0, 0, 0, .3);
      clear: both;
      text-align: center;
      position: relative;
      z-index: 1;
    }

    html.ie-10 .ie-panel,
    html.lt-ie-10 .ie-panel {
      display: block;
    }

    img:hover{
    width: 100%;
    transform: scale(1.4);
    transition: all 0.6s;
}
  </style>
</head>

<body>


  <?php
  session_start();
  if (isset($_SESSION['usuario'])) {
    echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
  } 

// Verifica si la sesión de usuario no está establecida
if (!isset($_SESSION['usuario'])) {
  header("Location: ../login.php");
}
        // Configuración de la conexión a la base de datos
        $servername = "217.160.114.39";
        $username = "jose";
        $password = "56lf2G9BnTez";
        $dbname = "fotografia";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Error en la conexión: " . $conn->connect_error);
        }

        // Consulta SQL para obtener los eventos

        $sql2 = "SELECT concat(nombre, ' ', apellidos) from cliente where id_cliente =".$_SESSION['id_cliente']."";
        $result2 = $conn->query($sql2)->fetch_column();
        echo '<script>var nombre = "' . $result2 .'"</script>';
        echo '<script>var id_cliente = "' .$_SESSION['id_cliente'].'"</script>';
        echo '<script> document.getElementById("cliente").innerText=nombre;</script>';

?>


  <div class="ie-panel"></div>
  <div class="page"></a>
    <!-- Page Header-->
    <header class="section page-header">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-minimal" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed" data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                <!-- RD Navbar Brand-->
                <a class="rd-navbar-brand" href="index.html"><img src="../images/logo.png" alt="" width="400" height="200" srcset="images/logo.png" /></a>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="../index.html">Inicio</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../about-me.html">Sobre Nosotros</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../servicios.html">Servicios</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../contacts.html">Contactanos</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="usuarios"  href="../usuarios.php" style="display: none;">Usuarios</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link ml-5" id="inicio_sesion" href="../login.php">Iniciar Sesion</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="cerrar_sesion" href="../logout.php" style="display: none;">Cerrar Sesion</a>
                    </li>
                  </ul>
                </div>
                <!-- RD Navbar Search-->

              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Overlapping Screen-->
    <section class="section section-overlap bg-decorate">
      <div class="section-overlap-image" style="background-image: url(../images/fotografia_principal2.jpg)"></div>
      <div class="section-overlap-content">
        <div class="container">
          <div class="row">
            <div class="col-md-8 col-lg-7 col-xl-6">
              <h1 class="wow-outer"><span class="font-weight-bold wow-outer"><span class="wow slideInUp">Area Personal</span></span></h1>
              <h4 id="cliente"></h4>
            </div>
            <div class="col-6 mb-3 mt-3">
                <h3>Selecciona la galeria:</h3>
                <label for="evento" class="form-label">Seleccionar Evento:</label>
                <select id="evento2" class="form-control" name="evento">
                    <!-- Aquí se llenará dinámicamente con los eventos -->
                </select>
            <div id="fotos"></div>
          </div>
        </div>
      </div>
    </section>


    <!--Footer-->
    <footer class="section footer-standard bg-gray-700">
      <div class="footer-standard-main">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-4">
              <div class="inset-right-1">
                <h4>Mas información</h4>
                <p>Nos llamamos InstantArt, donde cada clic captura la esencia de la vida, convirtiendo momentos ordinarios en extraordinarias obras maestras visuales. </p>
              </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4">
              <div class="box-1">
                <h4>Información de contacto</h4>
                <ul class="list-sm">
                  <li class="object-inline"><span class="icon icon-md mdi mdi-map-marker text-gray-700"></span><a class="link-default" href="#">Calle San José <br> Puerta 3, Piso 2, Número 123.</a></li>
                  <li class="object-inline"><span class="icon icon-md mdi mdi-phone text-gray-700"></span><a class="link-default" href="tel:#">675456345</a></li>
                  <li class="object-inline"><span class="icon icon-md mdi mdi-email text-gray-700"></span><a class="link-default" href="mailto:#">InstantArt@gmail.com</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-7 col-lg-4">
              <h4>Contacto</h4>
              <p>Pon tu email para consultar lo que quieras</p>
              <!-- RD Mailform-->
              <form class="rd-form rd-mailform form-inline" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                <div class="form-wrap">
                  <input class="form-input" id="subscribe-form-2-email" type="email" name="email" data-constraints="@Email @Required">
                  <label class="form-label" for="subscribe-form-2-email">E-mail</label>
                </div>
                <div class="form-button">
                  <button class="button button-primary button-icon button-icon-only button-winona" type="submit" aria-label="submit"><span class="icon mdi mdi-email-outline"></span></button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

    </footer>
  </div>
  <div class="preloader">
    <div class="preloader-logo"><img src="images/logo.png" alt="" width="176" height="28" srcset="images/logo.png 2x" />
    </div>
    <div class="preloader-body">
      <div id="loadingProgressG">
        <div class="loadingProgressG" id="loadingProgressG_1"></div>
      </div>
    </div>
  </div>
  <!-- Global Mailform Output-->
  <div class="snackbars" id="form-output-global"></div>
  <!-- Javascript-->
  <script src="../js/core.min.js"></script>
  <script src="../js/script.js"></script>
  <script src="funciones.js"></script>
</body>

</html>