<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Presupuestos</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport"
    content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Work+Sans:300,700,800%7CIBM+Plex+Sans:200,300,400,400i,600,700">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../css/style.css">
  <script src="../php/comprobar_login.php"></script>

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

    #mensaje_contenedor {
      display: flex;
      justify-content: center;
      align-items: center;
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

  if (!isset($_SESSION['id_cliente'])) {
    header("Location: ../index.php");
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


  ?>

  <div class="ie-panel"></div>
  <div class="page">
    <!-- Page Header-->
    <header class="section page-header">
      <!-- RD Navbar-->
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-minimal" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
          data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
          data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
          data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
          data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px"
          data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <!-- RD Navbar Panel-->
              <div class="rd-navbar-panel">
                <!-- RD Navbar Toggle-->
                <button class="rd-navbar-toggle" data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                <!-- RD Navbar Brand-->
                <a class="rd-navbar-brand" href="index.html"><img src="../images/logo.png" alt="" width="400"
                    height="200" srcset="../images/logo.png" /></a>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../index.php">Inicio</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../sobre_nosotros.html">Sobre Nosotros</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../servicios.html">Servicios</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../contactanos.php">Contactanos</a></li>
                    <li class="rd-nav-item" id="usuarios" style="display: none;"><a class="rd-nav-link"
                        href="../usuarios.php">Usuarios</a></li>
                    <!--Area personal, para descargar proyectos-->
                    <li class="rd-nav-item active" id="area_personal" style="display: none;"><a class="rd-nav-link"
                        href="areaPersonal.php">Area Personal</a></li>
                    <!--Area de gestion de clientes-->
                    <li class="rd-nav-item" id="gestion_proyectos" style="display: none;"><a class="rd-nav-link"
                        href="../gestion/gestion_proyectos.php">Gestion de proyectos</a></li>
                    <!--Tabla para ver los trabajos pendientes de un empleado-->
                    <li class="rd-nav-item" id="proyectos_empleado" style="display: none;"><a class="rd-nav-link"
                        href="../gestion/proyecto_empleado.php">Evento empleado</a></li>
                    <li class="rd-nav-item" id="inicio_sesion"><a class="rd-nav-link ml-5" href="../login.php">Iniciar
                        Sesion</a></li>
                    <li class="rd-nav-item " id="cerrar_sesion" style="display: none;"><a class="rd-nav-link"
                        href="../logout.php">Cerrar Sesion</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>

      </div>
    </header>

    <!-- Breadcrumbs-->
    <section class="breadcrumbs-custom bg-image context-dark"
      style="background-image: url(../images/pexels-pixabay-53621.jpg);">
      <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
          <div class="breadcrumbs-custom-main">
            <h6 class="breadcrumbs-custom-subtitle title-decorated">Presupuestos</h6>
            <h1 class="breadcrumbs-custom-title">Presupuestos</h1>
          </div>
          <ul class="breadcrumbs-custom-path">
            <li><a href="../index.html">Inicio</a></li>
            <li>Presupuestos</li>
            <li class="active">Tabla</li>
          </ul>
        </div>
      </div>
    </section>

    <section id="tabla_eventos" class="section section-sm">
      <div class="container">
        <div class="table-responsive">
          <h5>Estos son tus presupuestos: <span id="cliente-id"></span></h5>

          <table class="table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">id_evento</th>
                <th scope="col">descripcion_detallada</th>
                <th scope="col">fecha creacion</th>
                <th scope="col">fecha vencimiento</th>
                <th scope="col">precio</th>
                <th scope="col">ver</th>
                <th scope="col">estado</th>


              </tr>
            </thead>
            <tbody id="presupuesto-table-body">
            </tbody>
          </table>
        </div>
      </div>
    </section>


    <!-- Page Footer-->
    <footer class="section footer-standard bg-gray-700">
      <div class="footer-standard-main">
        <div class="container">
          <div class="row row-50">
            <div class="col-lg-4">
              <div class="inset-right-1">
                <h4>About Me</h4>
                <p>My name is Jonathan Davis and I’m professional photographer and retoucher. I’m offering my services
                  to individual and corporate clients throughout the USA. Make your favorite life moment or event last
                  and remain in your memory!</p>
              </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4">
              <div class="box-1">
                <h4>Contact Information</h4>
                <ul class="list-sm">
                  <li class="object-inline"><span class="icon icon-md mdi mdi-map-marker text-gray-700"></span><a
                      class="link-default" href="#">2130 Fulton Street <br> San Diego, CA 94117-1080 USA</a></li>
                  <li class="object-inline"><span class="icon icon-md mdi mdi-phone text-gray-700"></span><a
                      class="link-default" href="tel:#">1-800-1234-678</a></li>
                  <li class="object-inline"><span class="icon icon-md mdi mdi-email text-gray-700"></span><a
                      class="link-default" href="mailto:#">info@demolink.org</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-7 col-lg-4">
              <h4>Newsletter</h4>
              <p>Sign up to my newsletter and be the first to know about the latest news, special offers, events, and
                discounts.</p>
              <!-- RD Mailform-->
              <a href="contactanos.php">
                <form class="rd-form rd-mailform form-inline" data-form-output="form-output-global"
                  data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                  <div class="form-wrap">
                    <input class="form-input" id="subscribe-form-2-email" type="email" name="email">
                    <label class="form-label" for="subscribe-form-2-email">E-mail</label>
                  </div>

                  <div class="form-button">

                    <div class="button button-primary button-icon button-icon-only button-winona" aria-label="submit">
                      <span class="icon mdi mdi-email-outline"></span>
                    </div>

                  </div>
                </form>
              </a>
            </div>
          </div>
        </div>
      </div>

    </footer>
  </div>

  <script src="../js/core.min.js"></script>
  <script src="../js/script.js"></script>
  <script>
    $(document).ready(function () {
      $.ajax({
        url: '../php/obtener_presupuestos.php',
        method: 'GET',
        dataType: 'json',
        success: function (data) {
          let tableBody = $('#presupuesto-table-body');
          tableBody.empty();
          data.forEach(function (presupuesto, index) {
            let row = `<tr>
                          <td>${presupuesto.id_presupuesto}</td>
                          <td>${presupuesto.id_evento}</td>
                          <td>${presupuesto.descripcion_detallada}</td>
                          <td>${presupuesto.fecha_creacion}</td>
                          <td>${presupuesto.fecha_vencimiento}</td>
                          <td>${presupuesto.precio}</td>
                       
                          <td>
                            <a href="../eventos/generar_presupuesto.php?id=${presupuesto.id_presupuesto}">
                              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-up-square-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11" />
                              </svg>
                            </a>
                          </td>`;

            if (presupuesto.nombre === 'pendiente') {
              row += `<td>
                        <form action="../php/procesar_estado.php" method="POST">
                          <input type="hidden" name="id_presupuesto" value="${presupuesto.id_presupuesto}">
                          <input type="radio" id="aprobado_${presupuesto.id_presupuesto}" name="estado" value="1">
                          <label for="aprobado_${presupuesto.id_presupuesto}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg></label>
<br>
                          <input type="radio" id="rechazado_${presupuesto.id_presupuesto}" name="estado" value="3">
                          <label for="rechazado_${presupuesto.id_presupuesto}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293z"/>
</svg></label>
                          <button type="submit">Enviar</button>
                        </form>
                      </td>`;
            } else {
              row += `<td>${presupuesto.nombre}</td>`;

            }

            row += `</tr>`;
            tableBody.append(row);
          });
        },
        error: function (error) {
          console.error('Error al obtener los presupuestos:', error);
        }
      });
    });
  </script>

</body>

</html>