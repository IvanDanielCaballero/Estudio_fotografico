<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
  <title>Home</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta charset="utf-8">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Work+Sans:300,700,800%7CIBM+Plex+Sans:200,300,400,400i,600,700">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/fonts.css">
  <link rel="stylesheet" href="css/style.css">
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
    
  </style>
</head>

<body>


  <?php
  session_start();
  if (isset($_SESSION['usuario'])) {
    echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
  }else{
    echo '<script>var inicio=false;</script>';
  }

  if(isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol']=='admin'){
    echo '<script>var admin=true;</script>';
  }else{
    echo '<script>var admin=false;</script>';
  }
  ?>


  <div class="ie-panel"></div>
  <div class="page">
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
                <a class="rd-navbar-brand" href="index.html"><img src="images/logo.png" alt="" width="400" height="200" srcset="images/logo.png" /></a>
              </div>
              <div class="rd-navbar-main-element">
              <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item"><a class="rd-nav-link" href="sobre_nosotros.html">Sobre Nosotros</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="servicios.html">Servicios</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="contactanos.php">Contactanos</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="usuarios"  href="usuarios.php" style="display: none;">Usuarios</a>
                    </li>
                    <!--Area personal, para descargar proyectos-->
                    <li class="rd-nav-item"><a class="rd-nav-link" id="area_personal" href="ftp/areaPersonal.php" style="display:none">Area Personal</a>
                    </li>
                    <!--Area de gestion de clientes-->
                    <li class="rd-nav-item"><a class="rd-nav-link" id="gestion_proyectos" href="gestion/gestion_proyectos.php" style="display:none">Gestion de proyectos</a>
                    </li>
                    <!--Tabla para ver los trabajos pendientes de un empleado-->
                    <li class="rd-nav-item"><a class="rd-nav-link" id="proyectos_empleado" href="gestion/proyecto_empleado.php" style="display:none">Evento empleado</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link ml-5" id="inicio_sesion" href="login.php">Iniciar Sesion</a>
                    </li>
                    <li class="rd-nav-item"><a class="rd-nav-link" id="cerrar_sesion" href="logout.php" style="display: none;">Cerrar Sesion</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- Overlapping Screen-->
    <section class="section section-overlap bg-decorate">
      <div class="section-overlap-image" style="background-image: url(images/fotografia_principal2.jpg)"></div>
      <div class="section-overlap-content">
        <div class="container">
          <div class="row">
            <div class="col-md-6 col-lg-5 col-xl-4">
              <div class="wow-outer">
                <h6 class="font-weight-sbold text-primary wow slideInDown">Estudio Fotográfico</h6>
              </div>
            </div>
            <div class="col-md-8 col-lg-7 col-xl-6">
              <h1 class="wow-outer"><span class="font-weight-bold wow-outer"><span class="wow slideInUp">Fotografía</span></span><span class="font-weight-exlight wow-outer"><span class="wow slideInUp" data-wow-delay=".1s">y Retoques</span></span></h1>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 col-offset-1">
              <div class="wow-outer">
                <h4 class="font-weight-light wow slideInUp" data-wow-delay=".2s">Danos una idea, nosotros hacemos la magia</h4>
              </div>
              <div class="wow-outer button-outer"><a class="button button-lg button-primary button-winona wow slideInUp" href="#" data-wow-delay=".3s">Ver trabajos</a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Projects - Modern Layout-->
    <section class="section section-lg bg-default">
      <div class="container">
        <div class="row row-50">
          <div class="col-12 text-center">
            <h3 class="section-title wow-outer"><span class="wow slideInUp">Trabajos</span></h3>
          </div>
          <div class="col-12 isotope-wrap">
            <div class="isotope offset-top-2" data-isotope-layout="masonry" data-lightgallery="group" data-lg-thumbnail="false">
              <div class="row row-30">
                <div class="col-12 col-sm-6 col-lg-4 isotope-item wow-outer">
                  <!-- Thumbnail Corporate-->
                  <article class="thumbnail-corporate wow slideInDown"><img class="thumbnail-corporate-image" src="images/foto2.jpg" alt="" width="370" height="256" />
                    <div class="thumbnail-corporate-caption">
                      <p class="thumbnail-corporate-title"><a href="#">Mary Williams</a></p>
                      <p>I offer high-quality photography &amp; retouch services to individual and corporate clients all over the US.</p><a class="thumbnail-corporate-link" href="images/foto2.jpg" data-lightgallery="item"><span class="icon mdi mdi-magnify"></span><span class="icon mdi mdi-magnify"></span></a>
                    </div>
                    <div class="thumbnail-corporate-dummy"></div>
                  </article>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 isotope-item wow-outer">
                  <!-- Thumbnail Corporate-->
                  <article class="thumbnail-corporate thumbnail-corporate-lg wow slideInDown"><img class="thumbnail-corporate-image" src="images/foto1.jpg" alt="" width="370" height="464" />
                    <div class="thumbnail-corporate-caption">
                      <p class="thumbnail-corporate-title"><a href="#">YouthWear</a></p>
                      <p>I offer high-quality photography &amp; retouch services to individual and corporate clients all over the US.</p><a class="thumbnail-corporate-link" href="images/foto1.jpg" data-lightgallery="item"><span class="icon mdi mdi-magnify"></span><span class="icon mdi mdi-magnify"></span></a>
                    </div>
                    <div class="thumbnail-corporate-dummy"></div>
                  </article>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 isotope-item wow-outer">
                  <!-- Thumbnail Corporate-->
                  <article class="thumbnail-corporate wow slideInUp"><img class="thumbnail-corporate-image" src="images/foto3.jpg" alt="" width="370" height="256" />
                    <div class="thumbnail-corporate-caption">
                      <p class="thumbnail-corporate-title"><a href="#">Ultra Optix</a></p>
                      <p>I offer high-quality photography &amp; retouch services to individual and corporate clients all over the US.</p><a class="thumbnail-corporate-link" href="images/foto3.jpg" data-lightgallery="item"><span class="icon mdi mdi-magnify"></span><span class="icon mdi mdi-magnify"></span></a>
                    </div>
                    <div class="thumbnail-corporate-dummy"></div>
                  </article>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 isotope-item wow-outer">
                  <!-- Thumbnail Corporate-->
                  <article class="thumbnail-corporate thumbnail-corporate-lg wow slideInUp"><img class="thumbnail-corporate-image" src="images/foto6.jpg" alt="" width="370" height="464" />
                    <div class="thumbnail-corporate-caption">
                      <p class="thumbnail-corporate-title"><a href="#">Accessories Inc.</a></p>
                      <p>I offer high-quality photography &amp; retouch services to individual and corporate clients all over the US.</p><a class="thumbnail-corporate-link" href="images/foto6.jpg" data-lightgallery="item"><span class="icon mdi mdi-magnify"></span><span class="icon mdi mdi-magnify"></span></a>
                    </div>
                    <div class="thumbnail-corporate-dummy"></div>
                  </article>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 isotope-item wow-outer">
                  <!-- Thumbnail Corporate-->
                  <article class="thumbnail-corporate thumbnail-corporate-lg wow slideInDown"><img class="thumbnail-corporate-image" src="images/foto5.jpg" alt="" width="370" height="464" />
                    <div class="thumbnail-corporate-caption">
                      <p class="thumbnail-corporate-title"><a href="#">Dwayne Winston</a></p>
                      <p>I offer high-quality photography &amp; retouch services to individual and corporate clients all over the US.</p><a class="thumbnail-corporate-link" href="images/foto5.jpg" data-lightgallery="item"><span class="icon mdi mdi-magnify"></span><span class="icon mdi mdi-magnify"></span></a>
                    </div>
                    <div class="thumbnail-corporate-dummy"></div>
                  </article>
                </div>
                <div class="col-12 col-sm-6 col-lg-4 isotope-item wow-outer">
                  <!-- Thumbnail Corporate-->
                  <article class="thumbnail-corporate wow slideInDown"><img class="thumbnail-corporate-image" src="images/foto4.jpg" alt="" width="370" height="256" />
                    <div class="thumbnail-corporate-caption">
                      <p class="thumbnail-corporate-title"><a href="#">Sue Peterson</a></p>
                      <p>I offer high-quality photography &amp; retouch services to individual and corporate clients all over the US.</p><a class="thumbnail-corporate-link" href="images/foto4.jpg" data-lightgallery="item"><span class="icon mdi mdi-magnify"></span><span class="icon mdi mdi-magnify"></span></a>
                    </div>
                    <div class="thumbnail-corporate-dummy"></div>
                  </article>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Advantages and Achievements-->
    <section class="section section-lg text-center bg-default">
      <div class="container">
        <h3 class="section-title wow-outer"><span class="wow slideInUp">Sobre nosotros</span></h3>
        <p class="wow-outer"><span class="text-width-1 wow slideInDown">En InstantArt, capturamos momentos con pasión y precisión. Nuestro equipo de fotógrafos expertos se compromete a ofrecerte imágenes de calidad excepcional, que reflejen la esencia y la emoción de cada ocasión.</span></p>
        <div class="row row-50">
          <div class="col-6 col-md-3 wow-outer">
            <!-- Counter Minimal-->
            <article class="counter-minimal wow slideInUp" data-wow-delay=".1s">
              <div class="counter-minimal-icon linearicons-mustache-glasses"></div>
              <div class="counter-minimal-main">
                <div class="counter">22</div>
              </div>
              <h5 class="counter-minimal-title">Premios fotográficos</h5>
            </article>
          </div>
          <div class="col-6 col-md-3 wow-outer">
            <!-- Counter Minimal-->
            <article class="counter-minimal wow slideInUp" data-wow-delay=".1s">
              <div class="counter-minimal-icon linearicons-camera2"></div>
              <div class="counter-minimal-main">
                <div class="counter">156</div>
              </div>
              <h5 class="counter-minimal-title">Sesiones fotográficas</h5>
            </article>
          </div>
          <div class="col-6 col-md-3 wow-outer">
            <!-- Counter Minimal-->
            <article class="counter-minimal wow slideInUp" data-wow-delay=".1s">
              <div class="counter-minimal-icon linearicons-shutter"></div>
              <div class="counter-minimal-main">
                <div class="counter">10</div>
              </div>
              <h5 class="counter-minimal-title">Años de experiencia</h5>
            </article>
          </div>
          <div class="col-6 col-md-3 wow-outer">
            <!-- Counter Minimal -->
            <article class="counter-minimal wow slideInUp" data-wow-delay=".1s">
              <div class="counter-minimal-icon linearicons-picture"></div>
              <div class="counter-minimal-main">
                <div class="counter">392</div>
              </div>
              <h5 class="counter-minimal-title">Clientes anuales</h5>
            </article>
          </div>
        </div>
      </div>
    </section>
    <!-- Testimonials-->
    <section class="section section-lg bg-gray-100 text-center">
      <div class="container">
        <h3 class="section-title">Opiniones</h3>
        <div class="slick-widget-testimonials wow fadeIn">
          <div class="slick-slider carousel-child" id="child-carousel" data-for=".carousel-parent" data-arrows="true" data-loop="true" data-dots="false" data-swipe="true" data-items="1" data-sm-items="3" data-md-items="5" data-lg-items="5" data-xl-items="5" data-center-mode="true" data-slide-to-scroll="1">
            <div class="item wow-outer"><img class="wow slideInLeft" src="images/persona3.jpg" alt="" width="96" height="96" />
            </div>
            <div class="item wow-outer"><img class="wow slideInLeft" src="images/persona1.jpg" alt="" width="96" height="96" />
            </div>
            <div class="item wow-outer"><img class="wow slideInLeft" src="images/persona4.jpg" alt="" width="96" height="96" />
            </div>
            <div class="item wow-outer"><img class="wow slideInLeft" src="images/persona2.jpg" alt="" width="96" height="96" />
            </div>
            <div class="item wow-outer"><img class="wow slideInLeft" src="images/persona5.jpg" alt="" width="96" height="96" />
            </div>
            <div class="item wow-outer"><img class="wow slideInLeft" src="images/persona6.jpg" alt="" width="96" height="96" />
            </div>
          </div>
          <!-- Slick Carousel-->
          <div class="slick-slider carousel-parent" data-arrows="false" data-loop="true" data-dots="false" data-swipe="false" data-items="1" data-fade="true" data-child="#child-carousel" data-for="#child-carousel">
            <div class="item">
              <!-- Quote Light 1-->
              <blockquote class="quote-light">
                <cite class="quote-light-cite">María López</cite>
                <p class="quote-light-caption">Cliente Regular</p><span class="icon quote-light-mark linearicons-quote-open"></span>
                <div class="quote-light-text">
                  <p>Me encantó absolutamente mi sesión y todas las fotos que resultaron de ella. ¡Tienen una pasión clara por lo que hacen y se nota en su trabajo! ¡Recomiendo altamente a InstantArt para cualquier necesidad fotográfica!</p>
                </div>
              </blockquote>
            </div>
            <div class="item">
              <!-- Quote Light 2-->
              <blockquote class="quote-light">
                <cite class="quote-light-cite">Juan Martínez</cite>
                <p class="quote-light-caption">Cliente Regular</p><span class="icon quote-light-mark linearicons-quote-open"></span>
                <div class="quote-light-text">
                  <p>Estaba muy contento con las fotos tomadas por InstantArt. Fueron muy amables y pacientes con mi hijo de dos meses y mis enérgicos niños de 6 años. ¡Voy a InstantArt a partir de ahora!</p>
                </div>
              </blockquote>
            </div>
            <div class="item">
              <!-- Quote Light 3-->
              <blockquote class="quote-light">
                <cite class="quote-light-cite">Sofía García</cite>
                <p class="quote-light-caption">Cliente Regular</p><span class="icon quote-light-mark linearicons-quote-open"></span>
                <div class="quote-light-text">
                  <p>Acabo de recibir mis hermosas fotos hoy de InstantArt y estoy asombrada de lo guapo que se ve mi hijo en las fotos. ¡Muchas gracias por tan buenos recuerdos! Voy a recomendar InstantArt a mis amigos.</p>
                </div>
              </blockquote>
            </div>
            <div class="item">
              <!-- Quote Light 4 -->
              <blockquote class="quote-light">
                <cite class="quote-light-cite">Carlos Sánchez</cite>
                <p class="quote-light-caption">Cliente Regular</p><span class="icon quote-light-mark linearicons-quote-open"></span>
                <div class="quote-light-text">
                  <p>Jose es verdaderamente un fotógrafo excepcional (y una persona maravillosa) con una habilidad casi mística para capturar la verdadera naturaleza de las personas y los eventos. ¡Lo recomiendo a cualquiera!</p>
                </div>
              </blockquote>
            </div>
            <!-- Dos personas más -->
            <div class="item">
              <!-- Quote Light 5 -->
              <blockquote class="quote-light">
                <cite class="quote-light-cite">Laura Pérez</cite>
                <p class="quote-light-caption">Cliente Regular</p><span class="icon quote-light-mark linearicons-quote-open"></span>
                <div class="quote-light-text">
                  <p>Las fotos que recibí de InstantArt son simplemente impresionantes. Capturaron la esencia de nuestro evento de una manera que nunca antes había visto. ¡Altamente recomendado!</p>
                </div>
              </blockquote>
            </div>
            <div class="item">
              <!-- Quote Light 6 -->
              <blockquote class="quote-light">
                <cite class="quote-light-cite">Eduardo Gutiérrez</cite>
                <p class="quote-light-caption">Cliente Regular</p><span class="icon quote-light-mark linearicons-quote-open"></span>
                <div class="quote-light-text">
                  <p>Estoy muy satisfecho con el servicio de InstantArt. Fueron muy profesionales y el resultado final superó mis expectativas. Definitivamente volveré a trabajar con ellos en el futuro.</p>
                </div>
              </blockquote>
            </div>
          </div>


        </div>
      </div>
    </section>
    <section class="section section-lg">
  <div class="container">
    <div class="row row-50 justify-content-lg-between offset-top-1">
      <div class="col-12">
        <h3 class="section-title text-center wow-outer"><span class="wow slideInDown">Preguntas Frecuentes</span></h3>
      </div>
      <div class="col-lg-7 col-xl-6">
        <!-- Bootstrap collapse-->
        <div class="card-group-custom card-group-corporate wow-outer" id="accordion1" role="tablist" aria-multiselectable="false">
          <!-- Bootstrap card-->
          <article class="card card-custom card-corporate wow fadeInDown" data-wow-delay=".05s">
            <div class="card-header" id="accordion1-heading-1" role="tab">
              <div class="card-title"><a role="button" data-toggle="collapse" data-parent="#accordion1" href="#accordion1-collapse-1" aria-controls="accordion1-collapse-1" aria-expanded="true">¿Ofrecen servicios de edición o retoque fotográfico?
             
              <div class="card-arrow"> </div>
                </a></div>
            </div>
            <div class="collapse show" id="accordion1-collapse-1" role="tabpanel" aria-labelledby="accordion1-heading-1">
              <div class="card-body">
                <p>Sí, en InstantArt ofrecemos servicios de edición y retoque fotográfico para mejorar la calidad y el aspecto de tus imágenes. Nuestro equipo de expertos en retoque está dedicado a perfeccionar cada detalle y cumplir con tus expectativas.</p>
              </div>
            </div>
          </article>
          <!-- Bootstrap card-->
          <article class="card card-custom card-corporate wow fadeInDown" data-wow-delay=".1s">
            <div class="card-header" id="accordion1-heading-2" role="tab">
              <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#accordion1-collapse-2" aria-controls="accordion1-collapse-2" aria-expanded="false">¿Puedo solicitar un servicio de fotografía personalizado?
                  <div class="card-arrow"></div>
                </a></div>
            </div>
            <div class="collapse" id="accordion1-collapse-2" role="tabpanel" aria-labelledby="accordion1-heading-2">
              <div class="card-body">
                <p>Absolutamente, en InstantArt entendemos que cada cliente tiene necesidades únicas. Por lo tanto, ofrecemos servicios de fotografía personalizados para adaptarnos a tus requisitos específicos. ¡Contáctanos para discutir tu proyecto y encontrar la mejor solución para ti!</p>
              </div>
            </div>
          </article>
          <!-- Bootstrap card-->
          <article class="card card-custom card-corporate wow fadeInDown" data-wow-delay=".15s">
            <div class="card-header" id="accordion1-heading-3" role="tab">
              <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#accordion1-collapse-3" aria-controls="accordion1-collapse-3" aria-expanded="false">¿Cuál es el tiempo de entrega de las imágenes editadas?
                  <div class="card-arrow"></div>
                </a></div>
            </div>
            <div class="collapse" id="accordion1-collapse-3" role="tabpanel" aria-labelledby="accordion1-heading-3">
              <div class="card-body">
                <p>El tiempo de entrega de las imágenes editadas puede variar según la cantidad y la complejidad del trabajo. Sin embargo, nos esforzamos por entregar los resultados lo más rápido posible sin comprometer la calidad. Te proporcionaremos un plazo de entrega claro al comenzar el proyecto.</p>
              </div>
            </div>
          </article>
          <!-- Bootstrap card-->
          <article class="card card-custom card-corporate wow fadeInDown" data-wow-delay=".2s">
            <div class="card-header" id="accordion1-heading-4" role="tab">
              <div class="card-title"><a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion1" href="#accordion1-collapse-4" aria-controls="accordion1-collapse-4" aria-expanded="false">¿Puedo obtener derechos de autor de las imágenes editadas?
                  <div class="card-arrow"></div>
                </a></div>
            </div>
            <div class="collapse" id="accordion1-collapse-4" role="tabpanel" aria-labelledby="accordion1-heading-4">
              <div class="card-body">
                <p>Sí, al trabajar con InstantArt, tendrás derechos de autor completos sobre las imágenes editadas. Nosotros respetamos y valoramos tu propiedad intelectual, por lo que te proporcionaremos todos los derechos necesarios para utilizar y distribuir las imágenes según tus necesidades.</p>
              </div>
            </div>
          </article>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="progress-linear-outer wow-outer">
          <!-- Linear progress bar-->
          <article class="progress-linear wow slideInDown" data-wow-delay=".05s">
            <div class="progress-header">
              <p>Fotografía</p><span class="progress-value">90</span>
            </div>
            <div class="progress-bar-linear-wrap">
              <div class="progress-bar-linear"></div>
            </div>
          </article>
        </div>
        <div class="progress-linear-outer wow-outer">
          <!-- Linear progress bar-->
          <article class="progress-linear wow slideInDown" data-wow-delay=".1s">
            <div class="progress-header">
              <p>Creatividad</p><span class="progress-value">85</span>
            </div>
            <div class="progress-bar-linear-wrap">
              <div class="progress-bar-linear progress-red"></div>
            </div>
          </article>
        </div>
        <div class="progress-linear-outer wow-outer">
          <!-- Linear progress bar-->
          <article class="progress-linear wow slideInDown" data-wow-delay=".15s">
            <div class="progress-header">
              <p>Retoques</p><span class="progress-value">100</span>
            </div>
            <div class="progress-bar-linear-wrap">
              <div class="progress-bar-linear progress-blue"></div>
            </div>
          </article>
        </div>
        <div class="progress-linear-outer wow-outer">
          <!-- Linear progress bar-->
          <article class="progress-linear wow slideInDown" data-wow-delay=".2s">
            <div class="progress-header">
              <p>Comunicación</p><span class="progress-value">80</span>
            </div>
            <div class="progress-bar-linear-wrap">
              <div class="progress-bar-linear progress-green"></div>
            </div>
          </article>
        </div>
      </div>
    </div>
  </div>
</section>

    <section class="section section-xs bg-gray-700 text-center">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-10 col-md-12">
            <div class="box-cta-thin">
              <h4 class="wow-outer"><span class="wow slideInRight">Buscando un <span class="text-italic">Fotografo de calidad?</span> </span></h4>
              <div class="wow-outer button-outer"><a class="button button-primary button-winona wow slideInLeft" href="#">Sesion</a></div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Latest Blog Posts-->
    
    <!-- Page Footer-->
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
              <a href="contactanos.php">
                            <form class="rd-form rd-mailform form-inline" data-form-output="form-output-global"
                                data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                                <div class="form-wrap">
                                    <input class="form-input" id="subscribe-form-2-email" type="email" name="email">
                                    <label class="form-label" for="subscribe-form-2-email">E-mail</label>
                                </div>
                             
                                <div class="form-button">
                                  
                                  <div class="button button-primary button-icon button-icon-only button-winona"
                                   aria-label="submit"><span
                                          class="icon mdi mdi-email-outline"></span></div>
                         
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
  <script src="js/core.min.js"></script>
  <script src="js/script.js"></script>


  <script>
    if (inicio) {
      document.getElementById("inicio_sesion").style.display = "none"
      document.getElementById("cerrar_sesion").style.display = "block";
      //habitilo la pagina del area personal del cliente
      document.getElementById("area_personal").style.display = "block";
      console.log("inicio sesion");
    }
    
    if(admin){
      console.log("admin")
      document.getElementById("usuarios").style.display= "block";
      document.getElementById("usuarios").style.display= "block";
      document.getElementById("gestion_proyectos").style.display = "block"
      document.getElementById("proyectos_empleado").style.display = "block";
      document.getElementById("area_personal").style.display = "none";
    }
  </script>
</body>

</html>