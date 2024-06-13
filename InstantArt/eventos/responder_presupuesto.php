<?php
session_start();

require '../php/funciones.php';
$bd = conexion();

// Preparar la consulta SQL para obtener los presupuesto del cliente
$sql = "SELECT * FROM presupuesto join estado_presupuesto on presupuesto.id_estado=estado_presupuesto.id_estado  WHERE id_cliente = :id_cliente";
$stmt = $bd->prepare($sql);
$stmt->execute(['id_cliente' => $_SESSION['id_cliente']]);

// Obtener todos los resultados
$presupuesto = $stmt->fetchAll(PDO::FETCH_ASSOC);




if (empty($presupuesto)) {

  header('Location: NO_eventos.html');
  exit();  // Es buena práctica agregar exit() después de una redirección
}



?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Presupuestos</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport"
    content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Work+Sans:300,700,800%7CIBM+Plex+Sans:200,300,400,400i,600,700">
  <link rel="stylesheet" href="../css/bootstrap.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/recopilar.css">
  <style>
    #section_insertar_presupuesto {
      display: none;
    }



    td,
    th {
      text-align: center;
    }

    .id_cliente {
      margin-left: 50px;
    }
  </style>
</head>

<body>
  <div class="page">
    <!-- Page Header-->
    <header class="section page-header">
      <div class="rd-navbar-wrap">
        <nav class="rd-navbar rd-navbar-minimal" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
          data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed" data-lg-layout="rd-navbar-static"
          data-lg-device-layout="rd-navbar-fixed" data-xl-layout="rd-navbar-static"
          data-xl-device-layout="rd-navbar-static" data-xxl-layout="rd-navbar-static"
          data-xxl-device-layout="rd-navbar-static" data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px"
          data-xxl-stick-up-offset="46px" data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
          <div class="rd-navbar-main-outer">
            <div class="rd-navbar-main">
              <div class="rd-navbar-panel">
                <button class="rd-navbar-toggle" data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                <a class="rd-navbar-brand" href="index.php"><img src="../images/logo.png" alt="" width="400"
                    height="200" srcset="logo.png" /></a>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item active"><a class="rd-nav-link" href="../index.php">Inicio</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../about-me.html">Sobre Nosotros</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="proyectos_empleado"
                        href="proyecto_empleado.php">Evento empleado</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="usuarios" href="../usuarios.php"
                        style="display: none;">Usuarios</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link ml-5" id="inicio_sesion" href="../login.php"
                        style="margin-left: 40px;">Iniciar Sesion</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="cerrar_sesion" href="../logout.php"
                        style="display: none;">Cerrar Sesion</a></li>
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
        <h5>Estos son tus presupuestos: <?php echo htmlspecialchars($_SESSION['id_cliente']); ?></h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">id_evento</th>
              <th scope="col">descripcion_detallada</th>
              <th scope="col">fecha creacion</th>
              <th scope="col">fecha vencimiento</th>
              <th scope="col">precio</th>
              <th scope="col">id_estado</th>
              <th scope="col">ver</th>


            </tr>
          </thead>
          <tbody>
            <?php foreach ($presupuesto as $presu): ?>
              <tr>
                <th scope="row"><?php echo htmlspecialchars($presu['id_presupuesto']); ?></th>
                <td><?php echo htmlspecialchars($presu['id_evento']); ?></td>
                <td><?php echo htmlspecialchars($presu['descripcion_detallada']); ?></td>
                <td><?php echo htmlspecialchars($presu['fecha_creacion']); ?></td>
                <td><?php echo htmlspecialchars($presu['fecha_vencimiento']); ?></td>
                <td><?php echo htmlspecialchars($presu['precio']); ?></td>
                <td><?php echo htmlspecialchars($presu['nombre']); ?></td>


                <td>
                  <button id="NuevoPresupuesto_<?php echo htmlspecialchars($presu['id_presupuesto']); ?>" type="button"
                    class="btn btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-caret-up-square-fill" viewBox="0 0 16 16">
                      <path
                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11" />
                    </svg>
                  </button>
                </td>
                <!-- <td>
                  <button id="NuevoFactura_<?php echo htmlspecialchars($evento['id_evento']); ?>" type="button"
                    class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-caret-up-square-fill" viewBox="0 0 16 16">
                      <path
                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11" />
                    </svg>
                  </button>
                </td> -->


              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </section>







    <section class="section section-sm">
      <div class="container">

        <div class="col-lg-10 col-xl-8">
          <h2>HTML Text Elements</h2>
          <p><a href="#">Text Link</a><a class="link-hover" href="#">Hover link</a><strong>Bold text</strong>
            <mark>This is a highlighted text</mark><span class="tooltip-custom" data-toggle="tooltip"
              data-placement="top" title="Tooltips text">Tooltips</span><span>Welcome to our wonderful world. We
              sincerely hope that each and every user entering our website will find exactly what he/she is
              looking
              for</span><span>With advanced features of activating account and new login widgets, you will
              definitely
              have a great experience of using our web page.</span><span class="text-strike">This is a
              strickethrough
              text</span><span class="text-underline">This is an underlined text.</span>
          </p>
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
      <div class="container">
        <div class="footer-standard-aside"><a class="brand" href="index.html"><img
              src="../images/logo-inverse-176x28.png" alt="" width="176" height="28"
              srcset="../images/logo-inverse-352x56.png" /></a>
          <!-- Rights-->
          <p class="rights"><span>&copy;&nbsp;</span><span class="copyright-year"></span><span>&nbsp;</span><span>All
              Rights Reserved.</span><span>&nbsp;</span><br class="d-sm-none" />Design&nbsp;by&nbsp;<a
              href="https://www.templatemonster.com/">Templatemonster</a></p>
        </div>
      </div>
    </footer>
  </div>
  <div class="preloader">
    <div class="preloader-logo"><img src="../images/logo-inverse-176x28.png" alt="" width="176" height="28"
        srcset="images/logo-default-352x56.png 2x" />
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

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../js/core.min.js"></script>
<script src="../js/script.js"></script>

<script>
  var id_presupuesto;

  document.addEventListener('DOMContentLoaded', function() {
  /*  function volver_pagina(e) {
     window.location.reload();
 
   } */

  let botones_presupuesto = document.getElementsByClassName('btn btn-warning');
  /*  let botones_factura = document.getElementsByClassName('btn btn-dark');
  */
  console.log(botones_presupuesto)
  function generar_presupuesto(e) {
    let id_boton = e.target.getAttribute("id");
    id_presupuesto = id_boton.split("_")[1]

    window.location.href = 'generar_presupuesto.php?id=' + id_presupuesto;
  }

  for (let btn of botones_presupuesto) {
    btn.addEventListener('click', generar_presupuesto)
  }
});



</script>

</html>