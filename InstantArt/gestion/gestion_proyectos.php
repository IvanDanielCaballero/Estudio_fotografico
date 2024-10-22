<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Inicio</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport"
        content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="../images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!-- <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="usuarios_form.css" />
    <link rel="stylesheet" href="estilos.css" />
    <link rel="stylesheet" href="../css/fonts.css">
    <script src="../php/comprobar_login.php"></script>
    <style>
        .texto_centrado {
            text-align: center;
        }
    </style>
 


    <!-- Stylesheets-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>


    <link href="../css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="../css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>

<body>


    <?php
    session_start();
    require 'login.php';

    ?>


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
                    <li class="rd-nav-item"><a class="rd-nav-link" href="../contactanos.html">Contactanos</a></li>
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


        <div class="col-12 text-center">
            <h3 class="section-title wow-outer"><span class="wow slideInUp">Gestion de proyectos</span></h3>
        </div>


        <?php
        
        // Configuración de la conexión a la base de datos
        require 'utilidades_gestion.php';

        // Crear conexión
        $conn = conexion_bd();

        // Consulta SQL para obtener los usuarios
        $sql = "SELECT * FROM cliente";
        $result = $conn->query($sql);

        $sql2 = "SELECT id_empleado,nombre,apellidos,contraseña,dni,telefono,salario_mes,tipo FROM empleado
        JOIN tipo_empleado ON empleado.id_tipo_empleado=tipo_empleado.id_tipo_empleado
        
        ";
        $result2 = $conn->query($sql2);
        ?>


        <div class="wrapper wow slideInLeft" id="tabla1">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="fresh-table full-color-gestion">
                            <div class="toolbar">
                            </div>

                            <table id="fresh-table" class="table">
                                <thead>
                                    <th data-field="id_cliente">ID</th>
                                    <th data-field="nombre" data-sortable="true">Nombre</th>
                                    <th data-field="apellidos" data-sortable="true">Apellidos</th>
                                    <th data-field="contraseña" data-sortable="true">Contraseña</th>
                                    <th data-field="email">Email</th>
                                    <th data-field="fecha_nacimiento">Fecha Nacimiento</th>
                                    <th data-field="telefono">Telefono</th>
                                    <th data-field="actions">Acciones</th>
                                    <th data-field="budget">Presupuestos</th>

                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        foreach ($result as $row) {
                                            $id = $row["id_cliente"];
                                            echo "<tr>";
                                            echo "<td>" . $row["id_cliente"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["apellidos"] . "</td>";
                                            echo "<td>" . $row["contraseña"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
                                            echo "<td>" . $row["telefono"] . "</td>";
                                            echo "<td>
                                            <a rel='tooltip' title='subir' class='table-action edit'  title='Editar' href='#' onclick='Subir($id)'><i class='fas fa-paperclip'></i></a>
                                            <a rel='tooltip' title='Editar' class='table-action edit'  title='Subir' href='#' onclick='Modificar($id)'><i class='fa fa-edit'></i></a>
                                            <a rel='tooltip' title='añadir' class='table-action like' title='Añadir' href='#' onclick='Anadir($id)'><i class='fa fa-plus'></i></a>
                                           
                                            </td>";

                                            echo "<td class='texto_centrado'>
                                            <a rel='tooltip' title='ver presupuestos' onclick=\"window.location.href = '../eventos/eventos.php?id=" . $id . "'\">
                                                <i class='fa fa-list'></i>
                                            </a>
                                          </td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php
        // Obtener los eventos en formato JSON
        $events_json = eventos_bd();
        $events = json_decode($events_json, true);

        // Obtener los equipos en formato JSON
        $equipos_json = equipos_bd();
        $equipos = json_decode($equipos_json, true);

        // Obtener los equipos en formato JSON
        $empleados_json = empleados_bd();
        $empleados = json_decode($empleados_json, true);

        ?>

        <!-- Formulario para añadir proyectos-->
        <div class='container fo wow slideInDown' id='forAnadir' style='display: none;'>
            <form action='anadirProyecto.php' method='POST' class='text-center'>
                <div class='mb-3 mt-3'>
                    <h3>Añadir eventos</h3>
                    <div class='row mt-3'>
                        <div class='col-md-6'>
                            <input type='hidden' id='id_cliente' name='id_cliente'>
                            <label for='tipo_evento' class='form-label'>Tipo evento:</label>
                            <select id='tipo_evento' class='form-control' name='tipo_evento'>
                                <?php foreach ($events as $event): ?>
                                    <option value="<?= $event['id_tipo_evento'] ?>"><?= $event['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <label for='equipo' class='form-label'>Equipo:</label>
                            <select id='equipo' class='form-control' name='equipo'>
                                <?php foreach ($equipos as $equipo): ?>
                                    <option value="<?= $equipo['id_equipo'] ?>"><?= $equipo['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>


                            <label for='descripcion' class='form-label'>Descripcion:</label>
                            <input type='text' class='form-control' id='descripcion' name='descripcion'>
                            <label for='estado' class='form-label'>Estado:</label>
                            <input type='text' id='estado' class='form-control' name='estado'>

                        </div>

                        <div class='col-md-6'>
                            <label for='hora' class='form-label'>Hora:</label>
                            <input type='time' id='hora' class='form-control' name='hora'>
                            <label for='localidad' class='form-label'>Localidad:</label>
                            <input type='text' class='form-control' id='localidad' name='localidad'>
                            <label for='fecha' class='form-label'>Fecha:</label>
                            <input type='date' class='form-control' id='fecha' name='fecha'>

                            <label for='empleado' class='form-label'>Empleado:</label>
                            <select id='empleado' class='form-control' name='empleado'>
                                <?php foreach ($empleados as $empleado): ?>
                                    <option value="<?= $empleado['id_empleado'] ?>"><?= $empleado['nombre'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                    </div>
                </div>
                <div class="button-container text-center row">
                    <div class="col-md-6 col-xs-6 text-end">
                        <button class="btn btn-primary enviar" type="submit">Enviar</button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-start">
                        <button class="btn btn-primary  cancelar" type="button"
                            onclick="location.reload();">Cancelar</button>
                    </div>
                </div>


            </form>
        </div>




        <!-- Formularios para editar eventos -->
        
        <div class='container fo wow slideInDown' id='forEditar' style='display: none;'>
            <form action='editarEvento.php' method='POST' enctype="multipart/form-data" class='text-center'>
                <div class='mb-3 mt-3'>
                    <h3>Editar eventos</h3>
                    <h4 id="nombre_cliente"></h4>
                    <label for="evento" class="form-label me-2">Seleccionar Evento:</label>
                        <select id="evento" class="form-control me-2" name="evento">
                        </select>
                        <button type="button" class="btn btn-danger" onclick="borrarEvento()">Borrar</button>
                    <div class='row mt-3'>
                        <div class='col-md-6'>
                                    <input type='hidden' id='id_cliente' name='id_cliente'>
                                    <label for='tipo_evento' class='form-label'>Tipo evento:</label>
                                    <select id='tipo_evento' class='form-control' name='tipo_evento'>
                                        <?php foreach ($events as $event): ?>
                                            <option value="<?= $event['id_tipo_evento'] ?>"><?= $event['nombre'] ?></option>
                                        <?php endforeach; ?>
                                    </select>

                                    <label for='equipo' class='form-label'>Equipo:</label>
                                    <select id='equipo' class='form-control' name='equipo'>
                                        <?php foreach ($equipos as $equipo): ?>
                                            <option value="<?= $equipo['id_equipo'] ?>"><?= $equipo['nombre'] ?></option>
                                        <?php endforeach; ?>
                                    </select>


                                    <label for='descripcion' class='form-label'>Descripcion:</label>
                                    <input type='text' class='form-control' id='descripcion' name='descripcion'>
                                    <label for='estado' class='form-label'>Estado:</label>
                                    <input type='text' id='estado' class='form-control' name='estado'>

                        </div>

                        <div class='col-md-6'>
                        <label for='hora' class='form-label'>Hora:</label>
                                    <input type='time' id='hora' class='form-control' name='hora'>
                                    <label for='localidad' class='form-label'>Localidad:</label>
                                    <input type='text' class='form-control' id='localidad' name='localidad'>
                                    <label for='fecha' class='form-label'>Fecha:</label>
                                    <input type='date' class='form-control' id='fecha' name='fecha'>

                                    <label for='empleado' class='form-label'>Empleado:</label>
                                    <select id='empleado' class='form-control' name='empleado'>
                                        <?php foreach ($empleados as $empleado): ?>
                                            <option value="<?= $empleado['id_empleado'] ?>"><?= $empleado['nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                        </div>

                    </div>
                </div>
                <div class="button-container text-center row">
                    <div class="col-md-6 col-xs-6 text-end">
                        <button class="btn btn-primary enviar" type="submit">Enviar</button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-start">
                        <button class="btn btn-primary  cancelar" type="button"
                            onclick="location.reload();">Cancelar</button>
                    </div>
                </div>


            </form>
        </div>

    <!-- Formulario para gestionar las imagenes de los eventos-->

    <div class="container fo wow slideInDown" id="forSubir" style="display: none;">
        <form id="formularioSubirImagen" enctype="multipart/form-data" class="text-center">
            <div class="mb-3 mt-3">
                <h3>Gestionar imágenes</h3>
                <h4 id="nombre_cliente"></h4>
                <label for="evento" class="form-label">Seleccionar Evento:</label>
                <select id="evento2" class="form-control" name="evento">
                    <!-- Aquí se llenará dinámicamente con los eventos -->
                </select>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <input type="hidden" id="id_cliente_img2" name="id_cliente">
                        <input type="hidden" id="id_evento_img2" name="id_evento">
                        <label for="imagenes" class="form-label">Seleccionar Imágenes:</label>
                        <input type="file" class="form-control" id="imagenes" name="imagenes[]" multiple>
                    </div>
                </div>
            </div>
            <div class="button-container text-center row">
                <div class="col-md-6 col-xs-6 text-end">
                    <button class="btn btn-primary enviar" type="submit">Subir</button>
                </div>
                <div class="col-md-6 col-xs-6 text-start">
                    <button class="btn btn-primary cancelar" type="button"
                        onclick="location.reload();">Cancelar</button>
                </div>
            </div>
        </form>
        <div class="col-md-12 col-xs-12 text-start" id="fotos2"></div>
    </div>





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
                        <a href="../contactanos.html">
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
        <div class="preloader-logo"><img src="logo.png" alt="" width="176" height="28" srcset="logo.png 2x" />
        </div>
        <div class="preloader-body">
            <div id="loadingProgressG">
                <div class="loadingProgressG" id="loadingProgressG_1"></div>
            </div>
        </div>
    </div>

    <div class="snackbars" id="form-output-global"></div>
    <script src="funciones.js"></script>
    <script src="core.min.js"></script>
    <script src="../js/script.js"></script>

</body>

</html>