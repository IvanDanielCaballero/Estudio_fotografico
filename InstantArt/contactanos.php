<?php
$message = isset($_GET['message']) ? $_GET['message'] : '';
$messageClass = isset($_GET['type']) ? $_GET['type'] : '';
?>
<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Contactanos</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
        content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <!-- Stylesheets-->
    <link rel="stylesheet" type="text/css"
        href="//fonts.googleapis.com/css?family=Work+Sans:300,700,800%7CIBM+Plex+Sans:200,300,400,400i,600,700">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/fonts.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="php/comprobar_login.php"></script>
    <style>
        #div_formulario {
            padding: 40px;
        }

        #map {
            height: 400px;
            width: 100%;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 10px;
            padding-left: 2em;
            padding-right: 2em;
            padding-bottom: 0.4em;
            background-color: black;
            border-radius: 25px;
            transition: 0.4s ease-in-out;
            color: #d3d3d3;
            height: 100%;
            padding: 8px;


        }


        @media screen and (max-width: 492px) {
            #contenedor_recapt {
                transform: scale(0.75);
            }
        }

        #contenedor_recapt {
            display: flex;
            justify-content: center;
        }

        .card {
            background-image: linear-gradient(163deg, red 50%, #ebb85e 75%);
            height: 80%;
            border-radius: 22px;
            transition: all 0.3s;
        }

        .card2 {
            border-radius: 0;
            height: 100%;

            transition: all 0.2s;

        }

        .card2:hover {
            transform: scale(0.98);
            border-radius: 20px;
        }

        .card:hover {
            box-shadow: 0px 0px 20px 1px #ebb85e;
        }

        #heading {
            text-align: center;
            margin: 2em;
            color: rgb(255, 255, 255);
            font-size: 1.2em;
        }

        .field {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5em;
            border-radius: 25px;
            padding: 0.6em;
            border: none;
            outline: none;
            color: white;
            background-color: #171717;
            box-shadow: inset 2px 5px 10px rgb(5, 5, 5);
        }

        .input-icon {
            height: 1.3em;
            width: 1.3em;
            fill: white;
        }

        .input-field {
            background: none;
            border: none;
            outline: none;
            width: 100%;
            color: #d3d3d3;
        }

        .form .btn {
            display: flex;
            justify-content: center;
            flex-direction: row;
            margin-top: 2.5em;
        }

        .button1 {
            padding: 0.5em;
            padding-left: 1.1em;
            padding-right: 1.1em;
            border-radius: 5px;
            margin-right: 0.5em;
            border: none;
            outline: none;
            transition: 0.4s ease-in-out;
            background-color: #252525;
            color: white;
        }

        .button1:hover {
            background-color: black;
            color: white;
        }

        .error {
            color: red;
            font-size: 1.4em;
            text-align: center;
        }

        .button2 {
            padding: 0.5em;
            padding-left: 2.3em;
            padding-right: 2.3em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: 0.4s ease-in-out;
            background-color: #252525;
            color: white;
        }

        .button2:hover {
            background-color: black;
            color: white;
        }

        .button3 {
            margin-bottom: 3em;
            padding: 0.5em;
            border-radius: 5px;
            border: none;
            outline: none;
            transition: 0.4s ease-in-out;
            background-color: #252525;
            color: white;
        }

        .button3:hover {
            background-color: #ebb85e;
            color: black;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />

    <!-- Incluyendo Leaflet JavaScript -->
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
</head>

<body>
    <div class="page">
        <!-- Page Header-->
        <!-- Page Header-->
        <header class="section page-header">
            <!-- RD Navbar-->
            <div class="rd-navbar-wrap">
                <nav class="rd-navbar rd-navbar-minimal" data-layout="rd-navbar-fixed" data-sm-layout="rd-navbar-fixed"
                    data-md-layout="rd-navbar-fixed" data-md-device-layout="rd-navbar-fixed"
                    data-lg-layout="rd-navbar-static" data-lg-device-layout="rd-navbar-fixed"
                    data-xl-layout="rd-navbar-static" data-xl-device-layout="rd-navbar-static"
                    data-xxl-layout="rd-navbar-static" data-xxl-device-layout="rd-navbar-static"
                    data-lg-stick-up-offset="46px" data-xl-stick-up-offset="46px" data-xxl-stick-up-offset="46px"
                    data-lg-stick-up="true" data-xl-stick-up="true" data-xxl-stick-up="true">
                    <div class="rd-navbar-main-outer">
                        <div class="rd-navbar-main">
                            <!-- RD Navbar Panel-->
                            <div class="rd-navbar-panel">
                                <!-- RD Navbar Toggle-->
                                <button class="rd-navbar-toggle"
                                    data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                                <!-- RD Navbar Brand-->
                                <a class="rd-navbar-brand" href="index.html"><img src="images/logo.png" alt=""
                                        width="400" height="200" srcset="images/logo.png" /></a>
                            </div>
                            <div class="rd-navbar-main-element">
                                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                                    <!-- RD Navbar Nav-->
                                    <ul class="rd-navbar-nav">
                                        <li class="rd-nav-item"><a class="rd-nav-link" href="index.php">Inicio</a>
                                        </li>
                                        <li class="rd-nav-item"><a class="rd-nav-link" href="sobre_nosotros.html">Sobre
                                                Nosotros</a>
                                        </li>
                                        <li class="rd-nav-item"><a class="rd-nav-link"
                                                href="servicios.html">Servicios</a>
                                        </li>
                                        <li class="rd-nav-item active"><a class="rd-nav-link"
                                                href="contactanos.html">Contactanos</a>
                                        </li>

                                        <li class="rd-nav-item" id="usuarios" style="display: none;"><a
                                                class="rd-nav-link" href="usuarios.php">Usuarios</a>
                                        </li>
                                        <!--Area personal, para descargar proyectos-->
                                        <li class="rd-nav-item" id="area_personal" style="display: none;"><a
                                                class="rd-nav-link" href="areaPersonal/areaPersonal.php">Area
                                                Personal</a>
                                        </li>
                                        <!--Area de gestion de clientes-->
                                        <li class="rd-nav-item" id="gestion_proyectos" style="display: none;"><a
                                                class="rd-nav-link" href="gestion/gestion_proyectos.php">Gestion de
                                                proyectos</a>
                                        </li>
                                        <!--Tabla para ver los trabajos pendientes de un empleado-->
                                        <li class="rd-nav-item" id="proyectos_empleado" style="display: none;"><a
                                                class="rd-nav-link" href="gestion/proyecto_empleado.php">Evento
                                                empleado</a>
                                        </li>
                                        <li class="rd-nav-item" id="inicio_sesion"><a class="rd-nav-link ml-5"
                                                href="login.php">Iniciar Sesion</a>
                                        </li>
                                        <li class="rd-nav-item " id="cerrar_sesion" style="display: none;"><a
                                                class="rd-nav-link" href="logout.php">Cerrar Sesion</a>
                                        </li>

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
            style="background-image: url(images/pexels-markusspiske-4201333);">
            <div class="breadcrumbs-custom-inner">
                <div class="container breadcrumbs-custom-container">
                    <div class="breadcrumbs-custom-main">
                        <h6 class="breadcrumbs-custom-subtitle title-decorated">CONTACTANOS</h6>
                        <h1 class="breadcrumbs-custom-title">Contactanos</h1>
                    </div>
                    <ul class="breadcrumbs-custom-path">
                        <li><a href="index.html">Inicio</a></li>
                        <li class="active">Contactanos</li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- Base typography  -->
        <section class="section section-sm section-first">
            <div class="container">
                <div class="row row-50">


                    <div id="div_formulario" class="col-xl-7 col-12">

                        <h1>Rellene este formulario</h1>
                        <?php if ($message): ?>
                            <p class="<?php echo htmlspecialchars($messageClass); ?>">
                                <?php echo htmlspecialchars($message); ?>
                            </p>
                        <?php endif; ?>
                        <div class="card">

                            <div class="card2">

                                <form class="form" action="php/enviar_email.php" method="POST">
                                    <label for="nombre" class="pt-3">Ingresa tu nombre:</label>
                                    <div class="field mb-3">
                                        <input type="text" class="input-field" placeholder="Nombre" autocomplete="off"
                                            name="nombre" />
                                        <div id="nombre_Help" class="form-text">Queremos saber como te llamas.</div>
                                    </div>




                                    <label for="apellidos">Ingresa tus apellidos:</label>
                                    <div class="field mb-3">
                                        <input type="text" class="input-field" placeholder="apellidos"
                                            name="apellidos" />
                                    </div>

                                    <label for="telefono">Ingresa tu telefono:</label>
                                    <div class="field mb-3">
                                        <input type="tel" class="input-field" placeholder="Número de Teléfono"
                                            name="telefono" />
                                    </div>


                                    <label for="email">Ingresa tu Email:</label>
                                    <div class="field mb-3">
                                        <input type="email" class="input-field" placeholder="Correo Electrónico"
                                            name="email" />
                                        <div id="emailHelp" class="form-text">nos pondremos en contacto contigo por
                                            email.</div>
                                    </div>
                                    <div id="contenedor_recapt">
                                        <div class="g-recaptcha" data-sitekey="6Lc-ht4pAAAAAFD-hRTNCi5373mfYayLpmz_B-FE"
                                            data-theme="dark">
                                        </div>
                                    </div><br>
                                    <hr>
                                    <label for="username">Ingresa tu dudas:</label>

                                    <div class="field">
                                        <textarea class="input-field" placeholder="Escribe aquí tu duda"
                                            name="duda"></textarea>
                                    </div>

                                    <button class="button3">Enviar</button>
                                </form>
                            </div>
                        </div>

                        <p>Estamos aquí para proporcionarte el mejor servicio fotográfico. Contáctanos hoy mismo para reservar tu sesión o para discutir tus necesidades específicas. ¡Esperamos trabajar contigo para capturar momentos inolvidables!</p>



                    </div>
                    <div class="col-xl-5 col-12">
                        <ul class="list-xl">
                            <li>
                                <h2>Información de Contacto</h2>
                                <p>Estamos aquí para capturar tus momentos especiales con nuestra experiencia en
                                    sesiones fotográficas. Contáctanos para reservar tu sesión o para cualquier consulta
                                    que tengas.</p>
                            </li>
                            <li>
                                <h4>Servicios Personalizados</h4>
                                <p>Nuestro equipo ofrece servicios adaptados a tus necesidades específicas. Desde
                                    retratos individuales hasta eventos corporativos, estamos listos para capturar cada
                                    detalle de manera profesional.</p>
                            </li>
                            <li>
                                <h5>Colaboraciones Creativas</h5>
                                <p>Explora nuevas ideas con nosotros para proyectos creativos. Nos especializamos en
                                    colaboraciones que traen innovación y frescura a cada imagen que capturamos.</p>
                            </li>
                        
                        </ul>
                    </div>

                </div>
                <div class="col-xl-12 col-12 mt-5">
                    <ul class="list-xl">
                        <li>
                            <h2>Encuéntranos en el Mapa</h2>
                            <p>Visítanos en nuestra ubicación para discutir tus necesidades fotográficas o para obtener
                                más información sobre nuestros servicios. Estamos aquí para ayudarte a capturar momentos
                                memorables.</p>
                        </li>
                    </ul>
                    <div id="map"></div>
                </div>

            </div>
        </section>
        <!-- Blockquote-->
        <section class="section section-sm">
            <div class="container">
                <div class="row row-50">
                    <div class="col-lg-10 col-xl-8">
                        <h6>Ansel Adamse</h6>
                        <!-- Quote Light-->
                        <blockquote class="quote-light">
                            <svg class="quote-light-mark" x="0px" y="0px" width="35px" height="25px"
                                viewbox="0 0 35 25">
                                <path
                                    d="M27.461,10.206h7.5v15h-15v-15L25,0.127h7.5L27.461,10.206z M7.539,10.206h7.5v15h-15v-15L4.961,0.127h7.5                L7.539,10.206z">
                                </path>
                            </svg>
                            <div class="quote-light-text">
                                <p>No haces una fotografía solo con una cámara. Traes al acto de la fotografía todas las
                                    imágenes que has visto, los libros que has leído, la música que has escuchado, las
                                    personas que has amado.</p>
                                <svg class="quote-light-mark" x="0px" y="0px" width="35px" height="25px"
                                    viewbox="0 0 35 25">
                                    <path
                                        d="M27.461,10.206h7.5v15h-15v-15L25,0.127h7.5L27.461,10.206z M7.539,10.206h7.5v15h-15v-15L4.961,0.127h7.5                L7.539,10.206z">
                                    </path>
                                </svg>
                            </div>

                        </blockquote>
                    </div>
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
                <h4>Mas información</h4>
                <p>Nos llamamos InstantArt, donde cada clic captura la esencia de la vida, convirtiendo momentos
                  ordinarios en extraordinarias obras maestras visuales. </p>
              </div>
            </div>
            <div class="col-sm-6 col-md-5 col-lg-4">
              <div class="box-1">
                <h4>Información de contacto</h4>
                <ul class="list-sm">
                  <li class="object-inline"><span class="icon icon-md mdi mdi-map-marker text-gray-700"></span><a
                      class="link-default" href="#">Calle San José <br> Puerta 3, Piso 2, Número 123.</a></li>
                  <li class="object-inline"><span class="icon icon-md mdi mdi-phone text-gray-700"></span><a
                      class="link-default" href="tel:#">675456345</a></li>
                  <li class="object-inline"><span class="icon icon-md mdi mdi-email text-gray-700"></span><a
                      class="link-default" href="mailto:#">InstantArt@gmail.com</a></li>
                </ul>
              </div>
            </div>
            <div class="col-sm-6 col-md-7 col-lg-4">
              <h4>Contacto</h4>
              <p>Pon tu email para consultar lo que quieras</p>
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
                      <span class="icon mdi mdi-email-outline"></span></div>

                  </div>
                </form>
              </a>
            </div>
          </div>
        </div>
      </div>

    </footer>
    </div>
    <div class="preloader">
        <div class="preloader-logo"><img src="images/logo-default-176x28.png" alt="" width="176" height="28"
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
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>

</body>
<script>
    // Coordenadas proporcionadas
    var coordenadas = [38.60758446483935, -1.1082502039179802];

    // Creación del mapa y configuración inicial
    var map = L.map('map').setView(coordenadas, 15);

    // Añadir capa de mapa (OpenStreetMap en este caso)
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Añadir marcador en las coordenadas
    L.marker(coordenadas).addTo(map)
        .bindPopup('InstantArt')
        .openPopup();
</script>

</html>