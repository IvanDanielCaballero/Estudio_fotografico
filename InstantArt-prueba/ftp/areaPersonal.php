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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style_old.css">
  <link rel="stylesheet" href="../css/css_ulia.css">
  <link rel="stylesheet" href="../css/fonts.css">

</head>
<style>
  
  .b-6 {
      max-width: 257.7px !important;
      max-height: 386.65 !important;
      overflow: hidden;

    }

    .b-5 {
      max-width: 424.8px !important;
      max-height: 386.65px !important;
      overflow: hidden;

    }

    .b-2 {
      max-width: 439.217px !important;
      max-height: 538.73px !important;
      overflow: hidden;

    }



    .b-3 {
      max-width: 702.65px !important;
      max-height: 230.4px !important;
      overflow: hidden;


    }

    .b-4 {
      max-width: 702.65px !important;
      max-height: 215.6px !important;
      overflow: hidden;


    }

    .b-1 {
      max-width: 439.217px !important;
      max-height: 313.95px !important;
      overflow: hidden;
    }

    i.fas.fa-download {
      font-size: 24px;
      margin-left: 10px;
      /* Cambia el tamaño de la fuente del icono a 24px */
    }

    .see_btn {
      text-align: center;
    }



    @keyframes aparecer {
      from {
        opacity: 0;
        /* Inicia con opacidad 0 */
      }

      to {
        opacity: 1;
        /* Termina con opacidad 1 */
      }
    }
</style>

<body>


  <?php
  
  session_start();
  require_once "ruebaimagenesftp.php";
  if (isset($_SESSION['usuario'])) {
    echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
  }

  // Verifica si la sesión de usuario no está establecida
  if (!isset($_SESSION['usuario'])) {
    header("Location: ../login.php");
  }
  // Configuración de la conexión a la base de datosFi
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

  $sql2 = "SELECT concat(nombre, ' ', apellidos) from cliente where id_cliente =" . $_SESSION['id_cliente'] . "";
  $result2 = $conn->query($sql2)->fetch_column();
  echo '<script>var nombre = "' . $result2 . '"</script>';
  echo '<script>var id_cliente = "' . $_SESSION['id_cliente'] . '"</script>';
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
                <a class="rd-navbar-brand" href="index.html"><img src="../images/logo.png" alt="no se ha cargado el logo" width="400" height="200" srcset="../images/logo.png" /></a>
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
                    <li class="rd-nav-item"><a class="rd-nav-link" id="usuarios" href="../usuarios.php" style="display: none;">Usuarios</a>
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

    <section class="about_section layout_padding6">
      <div class="container">
        <div class="heading_container">
          <h3 style="text-align: center; margin-bottom: 50px !important;">
            Galería de Proyectos de Clientes
          </h3>
        </div>
        <div class="box">
          <div class="img-box">
            <img src="../images/about-img.jpg" alt="">
            <div class="about_img-bg">
              <img src="../images/about-img-bg.png" alt="">
            </div>
          </div>
          <div class="detail-box" style="margin-top: 100px;">
            <p>
              Bienvenidos a nuestra galería de proyectos, donde nos enorgullece presentar las fotografías personalizadas
              que hemos creado para nuestros valiosos clientes. Cada imagen es el resultado de una colaboración única,
              capturando momentos especiales y recuerdos duraderos. Nos esforzamos por reflejar la visión y las emociones
              de cada cliente en nuestras fotos, asegurando que cada proyecto sea tan único como las personas que están en él
            </p>
            <div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <div class="col-6 mb-3 mt-3" style="margin: 0 auto; display: none;">
      <h4 id="cliente"></h4>
      <h3>Selecciona la galeria:</h3>

      <div id="fotos"></div>
    </div>




    <section class="portfolio_section layout_padding">
      <div class="container">
        <div class="heading_container">
          <h3 class="mb-3">
            Selecciona la galeria
          </h3>
          <label for="evento" class="form-label mb-3">Seleccionar Evento:</label>
          <select id="evento2" class="form-control" name="evento" style="text-align: center;">
            <!-- Aquí se llenará dinámicamente con los eventos -->
          </select>

          <a href="#fotografia" onclick="MostrarFotos()" class="mismo_color mt-5">
            Mostrar fotografias
          </a>
        </div>
        <div class="portfolio_container layout_padding2 " id="fotografia">
          <div class="box-1">
            <div class="img-box b-1 prueba" style="display: none;">

              <div class="btn-box">
                <a href="#evento2" id="icono1"></a>
              </div>
              <img src="../images/p-1.jpg" alt="" id="imagen1">
            </div>
            <div class="img-box b-2 prueba" style="display: none;">
              <img src="../images/fondo.jpg" alt="" id="imagen2">
              <div class="btn-box">
                <a href="#evento2" id="icono2">

                </a>
              </div>
            </div>
          </div>
          <div class="box-2">
            <div class="box-2-top">
              <div class="img-box b-3 prueba" style="display: none;">
                <img src="../images/p-3.jpg" alt="" id="imagen3">
                <div class="btn-box">
                  <a href="#evento2" id="icono3">

                  </a>
                </div>
              </div>
            </div>
            <div class="box-2-top2">
              <div class="img-box b-4 prueba" style="display: none;">
                <img src="../images/p-4.jpg" alt="" id="imagen4">
                <div class="btn-box">
                  <a href="#evento2" id="icono4">

                  </a>
                </div>
              </div>
            </div>
            <div class="box-2-btm">
              <div class="img-box b-5 prueba" style="display: none;">
                <img src="../images/p-5.jpg" alt="" id="imagen5">
                <div class="btn-box">
                  <a href="#imagen1" id="icono5">

                  </a>
                </div>
              </div>
              <div class="img-box b-6 prueba" style="display: none;">
                <img src="../images/galeria-2.jpg" alt="" id="imagen6">
                <div class="btn-box">
                  <a href="#imagen1" id="icono6">

                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="see_btn" style="display: none;">
          <?php 
          if (file_exists($zip_filename)) : ?>
            <a href="<?php echo $zip_filename;?>" download>Descargar Imágenes</a>
            
          <?php endif; ?>
          
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
    <div class="preloader-logo"><img src="../images/logo.png " class="imagen" alt="" width="176" height="28" srcset="../images/logo.png 2x" />
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
  <script>
    function MostrarFotos() {
      const fotos = document.getElementsByClassName("prueba");
      for (let i = 0; i < fotos.length; i++) {
        fotos[i].style.display = "block";
      }
      document.getElementsByClassName("see_btn")[0].style.display = "block";
    }
  </script>
  <script src="../js/core.min.js"></script>
  <script src="../js/script.js"></script>
  <script src="funciones.js"></script>
</body>

</html>