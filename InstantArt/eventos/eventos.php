<?php
// Incluir el archivo funciones.php que contiene la función de conexión
require '../php/funciones.php';

// Establecer la conexión a la base de datos
$bd = conexion();

// Preparar la consulta SQL para obtener los eventos del cliente
$sql = "SELECT evento.id_evento, tipo_evento.nombre , evento.id_equipo, evento.descripcion, evento.fecha, evento.localidad, evento.hora, evento.estado 
        FROM tipo_evento  
        JOIN evento ON evento.id_tipo_evento = tipo_evento.id_tipo_evento 
        WHERE evento.id_cliente = :id_cliente";
$stmt = $bd->prepare($sql);

// Obtener el parámetro id_cliente del método GET
$id_cliente = $_GET['id'];

// Ejecutar la consulta preparada con el id_cliente como parámetro
$stmt->execute(['id_cliente' => $id_cliente]);

// Obtener todos los resultados como un array asociativo
$eventos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Redirigir a la página NO_eventos.html si no hay eventos para ese cliente
if (empty($eventos)) {
    header('Location: NO_eventos.html');
    exit(); // Es buena práctica agregar exit() después de una redirección
}
?>

<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
<meta charset="utf-8">

  <title>Eventos</title>
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport"
    content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="icon" href="../images/favicon.ico" type="image/x-icon">
  <!-- Stylesheets-->
  <link rel="stylesheet" type="text/css"
    href="//fonts.googleapis.com/css?family=Work+Sans:300,700,800%7CIBM+Plex+Sans:200,300,400,400i,600,700">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
 
 
    <link rel="stylesheet" href="../css/bootstrap.css">
 
    <link rel="stylesheet" href="../css/fonts.css">
  <link rel="stylesheet" href="../css/style.css">
  <link rel="stylesheet" href="../css/recopilar.css">
  <script src="../php/comprobar_login.php"></script>

  <style>
    /* Estilos específicos para la página */
    #section_insertar_presupuesto {
      display: none;
    }

    /* Estilos generales */
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
  
<div class="ie-panel"></div>
    <div class="page"></a>
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
                <a class="rd-navbar-brand" href="index.php"><img src="../images/logo.png" alt="" width="400" height="200"
                    srcset="../images/logo.png" /></a>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item "><a class="rd-nav-link" href="../index.php">Inicio</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../sobre_nosotros.html">Sobre Nosotros</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../servicios.html">Servicios</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../contactanos.php">Contactanos</a></li>
                    <li class="rd-nav-item" id="usuarios" style="display: none;"><a class="rd-nav-link"  href="../usuarios.php">Usuarios</a></li>
                    <!--Area personal, para descargar proyectos-->
                    <li class="rd-nav-item" id="area_personal" style="display: none;"><a class="rd-nav-link" href="../areaPersonal/areaPersonal.php">Area Personal</a></li>
                    <!--Area de gestion de clientes-->
                    <li class="rd-nav-item  active"  id="gestion_proyectos" style="display: none;"><a class="rd-nav-link" href="gestion_proyectos.php">Gestion de proyectos</a></li>
                    <!--Tabla para ver los trabajos pendientes de un empleado-->
                    <li class="rd-nav-item"id="proyectos_empleado" style="display: none;"><a class="rd-nav-link"  href="../gestion/proyecto_empleado.php">Evento empleado</a></li>
                    <li class="rd-nav-item" id="inicio_sesion"><a class="rd-nav-link ml-5"  href="../login.php">Iniciar Sesion</a></li>
                    <li class="rd-nav-item " id="cerrar_sesion" style="display: none;"><a class="rd-nav-link"  href="../logout.php" >Cerrar Sesion</a></li>
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
      style="background-image: url(https://images.pexels.com/photos/1587927/pexels-photo-1587927.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=2);">
      <div class="breadcrumbs-custom-inner">
        <div class="container breadcrumbs-custom-container">
          <div class="breadcrumbs-custom-main">
            <h6 class="breadcrumbs-custom-subtitle title-decorated">Eventos</h6>
            <h1 class="breadcrumbs-custom-title">Eventos</h1>
          </div>
          <ul class="breadcrumbs-custom-path">
            <li><a href="../index.html">Inicio</a></li>
            <li>Eventos</li>
            <li class="active">Formulario</li>
          </ul>
        </div>
      </div>
    </section>

    <section id="tabla_eventos" class="section section-sm">
      <div class="container">
      <div class="table-responsive">
        <h5>Estos son los eventos del cliente: <?php echo htmlspecialchars($_GET['id']); ?></h5>
        <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Tipo Evento</th>
              <th scope="col">Equipo</th>
              <th scope="col">Descripción</th>
              <th scope="col">Fecha</th>
              <th scope="col">Localidad</th>
              <th scope="col">Hora</th>

              <th scope="col">Presupuesto</th>
              <th scope="col">Factura</th>

            </tr>
          </thead>
          <tbody>
            <?php foreach ($eventos as $evento): ?>
              <tr>
                <th scope="row"><?php echo htmlspecialchars($evento['id_evento']); ?></th>
                <td><?php echo htmlspecialchars($evento['nombre']); ?></td>
                <td><?php echo htmlspecialchars($evento['id_equipo']); ?></td>
                <td><?php echo htmlspecialchars($evento['descripcion']); ?></td>
                <td><?php echo htmlspecialchars($evento['fecha']); ?></td>
                <td><?php echo htmlspecialchars($evento['localidad']); ?></td>
                <td><?php echo htmlspecialchars($evento['hora']); ?></td>
  
                <td>
                  <button id="NuevoPresupuesto_<?php echo htmlspecialchars($evento['id_evento']); ?>" type="button"
                    class="btn btn-warning">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-caret-up-square-fill" viewBox="0 0 16 16">
                      <path
                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11" />
                    </svg>
                  </button>
                </td>
                <td>
                  <button id="NuevoFactura_<?php echo htmlspecialchars($evento['id_evento']); ?>" type="button"
                    class="btn btn-dark">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                      class="bi bi-caret-up-square-fill" viewBox="0 0 16 16">
                      <path
                        d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2zm4 9h8a.5.5 0 0 0 .374-.832l-4-4.5a.5.5 0 0 0-.748 0l-4 4.5A.5.5 0 0 0 4 11" />
                    </svg>
                  </button>
                </td>


              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        </div>
      </div>
    </section>
    <section id="section_insertar_presupuesto" class="section section-sm">
      <div class="container container_recopilar">
        <div class="card_recopilar">
          <a class="titulo_recopilar">Insertar Presupuesto</a>

          <form id="form_recopilar" action="insertar_presupuesto.php" method="post">

            <div class="inputBox mb3">
              <input type="text" id="id_cliente" name="id_cliente" value="<?php echo htmlspecialchars($_GET['id']); ?>"
                readonly>

              <span class="id_cliente" style="margin-left: 50px;">Id cliente</span>
            </div>


            <div class="inputBox mb3">
              <input type="text" id="id_evento_presupuesto" value="<?php echo htmlspecialchars($evento['id_evento']); ?>" readonly>

              <span class="id_evento_presupuesto" style="margin-left: 50px;">Id evento</span>
            </div>


            <div class="inputBox mb3">
              <input type="text" name="descripcion" required="required">
              <span class="descripcion_presupuesto">Descripción</span>
            </div>

            <div class="inputBox mb3">
              <input type="number" name="precio" required="required">
              <span class="precio">Precio</span>
            </div>

            <div class="inputBox mb3">
              <select name="estado" required="required">
                <option value="" disabled selected></option>
                <option value="1">Aprobado</option>
                <option value="2">Pendiente</option>
                <option value="3">Rechazado</option>
              </select>
              <span class="estado_presupuesto">Estado presupuesto</span>
            </div>

            <div class="column">
              <div class="inputBox col-12 m-4">
                <input type="date" name="fecha_vencimiento" required="required">
                <span class="fecha_vencimiento">Fecha vencimiento</span>
              </div>
              <div class="inputBox col-12 m-4">
                <input type="date" name="fecha_creacion" required="required">
                <span class="fecha_creacion">Fecha creación</span>
              </div>
            </div>
            <button type="submit" class="enter btn_volver">Volver</button>
            <button type="submit" class="enter">Enviar</button>
          </form>
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
                            <p>Nos llamamos InstantArt, donde cada clic captura la esencia de la vida, convirtiendo
                                momentos ordinarios en extraordinarias obras maestras visuales. </p>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-5 col-lg-4">
                        <div class="box-1">
                            <h4>Información de contacto</h4>
                            <ul class="list-sm">
                                <li class="object-inline"><span
                                        class="icon icon-md mdi mdi-map-marker text-gray-700"></span><a
                                        class="link-default" href="#">Calle San José <br> Puerta 3, Piso 2, Número
                                        123.</a></li>
                                <li class="object-inline"><span
                                        class="icon icon-md mdi mdi-phone text-gray-700"></span><a class="link-default"
                                        href="tel:#">675456345</a></li>
                                <li class="object-inline"><span
                                        class="icon icon-md mdi mdi-email text-gray-700"></span><a class="link-default"
                                        href="mailto:#">InstantArt@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-7 col-lg-4">
                        <h4>Contacto</h4>
                        <p>Pon tu email para consultar lo que quieras</p>
                        <a href="../contactanos.php">
                        <form class="rd-form rd-mailform form-inline" data-form-output="form-output-global"
                            data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                            <div class="form-wrap">
                                <input class="form-input" id="subscribe-form-2-email" placeholder="email" type="email"
                                    name="email" data-constraints="@Email @Required">
                                <label class="form-label" for="subscribe-form-2-email"></label>
                            </div>
                            <div class="form-button">
                                <button class="button button-primary button-icon button-icon-only button-winona"
                                    type="submit" aria-label="submit"><span
                                        class="icon mdi mdi-email-outline"></span>Enviar</button>
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
    <div class="preloader-logo"><img src="../images/logo-inverse-176x28.png" alt="" width="176" height="28"
        srcset="../images/logo-default-352x56.png 2x" />
    </div>
    <div class="preloader-body">
      <div id="loadingProgressG">
        <div class="loadingProgressG" id="loadingProgressG_1"></div>
      </div>
    </div>
  </div>
  

</body>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../js/core.min.js"></script>
<script src="../js/script.js"></script>

<script>
// Función para mostrar el formulario de inserción de presupuesto y ocultar la tabla de eventos
function insertar_presupuesto(e) {
  // Ocultar la tabla de eventos
  document.getElementById('tabla_eventos').style.display = 'none';
  // Mostrar el formulario de inserción de presupuesto
  document.getElementById('section_insertar_presupuesto').style.display = 'block';
  
  // Obtener el ID del evento desde el botón clickeado
  let id_boton = e.target.getAttribute("id");
  let id_evento = id_boton.split("_")[1]; // Extraer el ID del evento desde el ID del botón
  console.log(id_evento); // Mostrar el ID del evento en la consola
  
  // Asignar el ID del evento al campo correspondiente del formulario de presupuesto
  document.getElementById('id_evento_presupuesto').value = id_evento;
}

// Función para redirigir a la página de generación de factura
function insertar_factura(e) {
  // Obtener el ID del cliente desde PHP (renderizado en el script PHP)
  let idCliente = <?php echo json_encode($id_cliente); ?>;
  
  // Obtener el ID del evento desde el botón clickeado
  let id_boton = e.target.getAttribute("id");
  let id_evento = id_boton.split("_")[1]; // Extraer el ID del evento desde el ID del botón
  
  // Redirigir a la página de generación de factura con los IDs de cliente y evento
  window.location.href = 'factura.php?id_evento=' + id_evento + '&id_cliente=' + idCliente;
}

// Función para recargar la página actual
function volver_pagina(e) {
  window.location.reload(); // Recargar la página actual
}

// Obtener todos los botones de inserción de presupuesto y asignarles un evento click
let botones_presupuesto = document.getElementsByClassName('btn btn-warning');
for (let btn of botones_presupuesto) {
  btn.addEventListener('click', insertar_presupuesto);
}

// Obtener todos los botones de generación de factura y asignarles un evento click
let botones_factura = document.getElementsByClassName('btn btn-dark');
for (let btn of botones_factura) {
  btn.addEventListener('click', insertar_factura);
}

// Obtener todos los botones de volver y asignarles un evento click
let botones_volver = document.getElementsByClassName('btn_volver');
for (let btn of botones_volver) {
  btn.addEventListener('click', volver_pagina);
}



</script>

</html>