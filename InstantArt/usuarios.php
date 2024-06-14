<!DOCTYPE html>
<html class="wide wow-animation" lang="en">

<head>
    <title>Home</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width height=device-height initial-scale=1.0 maximum-scale=1.0 user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <!--  <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css"> -->
    <link rel="stylesheet" href="css/usuarios_form.css" />




    <!-- Stylesheets-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/bootstrap-table/dist/bootstrap-table.min.js"></script>


    <link href="css/fresh-bootstrap-table.css" rel="stylesheet" />
    <link href="css/demo.css" rel="stylesheet" />
    <link rel="stylesheet" href="css/style_old.css">
    <script src="php/comprobar_login.php"></script>
    

</head>

<body>


    <?php
    session_start();
    require "php/funciones.php";
    if (isset($_SESSION['usuario'])) {
        echo '<script>var nombre = "' . $_SESSION['usuario'] . '"; var inicio=true;</script>';
    }

    if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
        echo '<script>var admin=true;</script>';
    } else {
        header("Location: index.php");
    }
    ?>


    <div class="ie-panel"></div>
    <div class="page"></a>
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
                <a class="rd-navbar-brand" href="index.php"><img src="images/logo.png" alt="" width="400" height="200"
                    srcset="images/logo.png" /></a>
              </div>
              <div class="rd-navbar-main-element">
                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                  <!-- RD Navbar Nav-->
                  <ul class="rd-navbar-nav">
                    <li class="rd-nav-item "><a class="rd-nav-link" href="index.php">Inicio</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="sobre_nosotros.html">Sobre Nosotros</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="servicios.html">Servicios</a></li>
                    <li class="rd-nav-item"><a class="rd-nav-link" href="contactanos.php">Contactanos</a></li>
                    <li class="rd-nav-item  active" id="usuarios" style="display: none;"><a class="rd-nav-link"  href="usuarios.php">Usuarios</a></li>
                    <!--Area personal, para descargar proyectos-->
                    <li class="rd-nav-item" id="area_personal" style="display: none;"><a class="rd-nav-link" href="areaPersonal/areaPersonal.php">Area Personal</a></li>
                    <!--Area de gestion de clientes-->
                    <li class="rd-nav-item"  id="gestion_proyectos" style="display: none;"><a class="rd-nav-link" href="gestion/gestion_proyectos.php">Gestion de proyectos</a></li>
                    <!--Tabla para ver los trabajos pendientes de un empleado-->
                    <li class="rd-nav-item"id="proyectos_empleado" style="display: none;"><a class="rd-nav-link"  href="gestion/proyecto_empleado.php">Evento empleado</a></li>
                    <li class="rd-nav-item" id="inicio_sesion"><a class="rd-nav-link ml-5"  href="login.php">Iniciar Sesion</a></li>
                    <li class="rd-nav-item " id="cerrar_sesion" style="display: none;"><a class="rd-nav-link"  href="logout.php" >Cerrar Sesion</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </nav>

      </div>
    </header>


        <div class="col-12 text-center">
            <h3 class="section-title wow-outer"><span class="wow slideInUp">Gestion de Usuarios</span></h3>
        </div>


        <?php
        // Crear conexión
        $conn = conexion();

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

                        <div class="fresh-table full-color-orange">
                            <div class="toolbar">
                                <button id="empleados" class="btn btn-default">Empleados</button>
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
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->rowCount() > 0) {
                                        foreach ($result as $row) {
                                            echo "<tr>";
                                            echo "<td>" . $row["id_cliente"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["apellidos"] . "</td>";
                                            echo "<td>" . $row["contraseña"] . "</td>";
                                            echo "<td>" . $row["email"] . "</td>";
                                            echo "<td>" . $row["fecha_nacimiento"] . "</td>";
                                            echo "<td>" . $row["telefono"] . "</td>";
                                            echo "<td>
                                            <a rel='tooltip' title='Like' class='table-action like' title='Like' href='#'onclick='Añadir()' >
                                            <i class='fa fa-plus'></i>
                                            </a>
                                            <a rel='tooltip' title='Edit' class='table-action edit'  title='Edit'  href='#' onclick='agregarFila1(this)'>
                                            <i class='fa fa-edit'></i>
                                            </a>
                                            <a rel='tooltip' title='Remove' class='table-action remove' title='Remove' href='#' onclick='eliminarFila1(this)'>
                                            <i class='fa fa-trash'></i></a>
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
        <div class="wrapper wow slideInRight" style="display: none;" id="tabla2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="fresh-table full-color-orange">
                            <div class="toolbar2">
                                <button id="clientes" class="btn btn-default">Clientes</button>
                            </div>

                            <table id="fresh-table2" class="table">
                                <thead>
                                    <th data-field="id_empleado">ID</th>
                                    <th data-field="nombre2" data-sortable="true">Nombre</th>
                                    <th data-field="apellidos2" data-sortable="true">Apellidos</th>
                                    <th data-field="fecha_nacimiento2">Contraseña</th>
                                    <th data-field="dni" data-sortable="true">DNI</th>
                                    <th data-field="telefono2">telefono</th>
                                    <th data-field="salario">Salario</th>
                                    <th data-field="tipo">Tipo</th>
                                    <th data-field="acciones">Acciones</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result2->rowCount() > 0) {
                                        foreach ($result2 as $row) {
                                            echo "<tr>";

                                            echo "<td>" . $row["id_empleado"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["apellidos"] . "</td>";
                                            echo "<td>" . $row["contraseña"] . "</td>";
                                            echo "<td>" . $row["dni"] . "</td>";
                                            echo "<td>" . $row["telefono"] . "</td>";
                                            echo "<td>" . $row["salario_mes"] . "</td>";
                                            echo "<td>" . $row["tipo"] . "</td>";
                                            echo "<td>
                                            <a rel='tooltip' title='Like' class='table-action like' title='Like' href='#' onclick='Añadir2()'>
                                            <i class='fa fa-plus'></i>
                                            </a>
                                            <a rel='tooltip' title='Edit' class='table-action edit'  title='Edit'  href='#'onclick='agregarFila2(this)' >
                                            <i class='fa fa-edit'></i>
                                            </a>
                                            <a rel='tooltip' title='Remove' class='table-action remove' title='Remove' href='#' onclick='eliminarFila2(this)'>
                                            <i class='fa fa-trash'></i></a>
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



        <div class='container fo wow slideInDown' id='for3' style='display: none;'>
            <form action='php/editar_cliente.php' method='POST' class='text-center'>
                <div class='mb-3 mt-3'>
                    <h3>Modificar Cliente</h3>
                    <div class='row mt-3'>
                        <div class='col-md-6'>
                            <label for='nombre' class='form-label'>Nombre:</label>
                            <input type='text' id='nombre' class='form-control' name='nombre'>


                            <label for='apellido' class='form-label'>Apellidos:</label>
                            <input type='text' class='form-control' id='apellido' name='apellido'>
                            <label for='email' class='form-label'>email:</label>
                            <input type='text' class='form-control' id='email' name='email'>

                        </div>

                        <div class='col-md-6'>
                            <label for='telefono' class='form-label'>Telefono:</label>
                            <input type='text' id='telefono' class='form-control' name='telefono'>

                            <label for='password' class='form-label'>Contraseña:</label>
                            <input type='text' class='form-control' id='password' name='password'>
                            <label for='fecha' class='form-label'>Fecha Nacimiento:</label>
                            <input type='date' class='form-control' id='fecha' name='fecha'>

                        </div>

                    </div>
                </div>
                <div class="button-container text-center row">
                    <div class="col-md-6 col-xs-6 text-end">
                        <button class="btn btn-primary enviar3" type="submit">Modificar</button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-start">
                        <button class="btn btn-primary  cancelar" type="button">Cancelar</button>
                    </div>
                </div>


            </form>
        </div>


        <div class='container fo wow slideInDown' id='for4' style='display:none;'>
            <form action='php/añadir_cliente.php' method='POST' class='text-center'>
                <div class='mb-3 mt-3'>
                    <h3>Añadir Cliente</h3>
                    <div class='row mt-3'>
                        <div class='col-md-6'>
                            <label for='Nombre' class='form-label'>Nombre:</label>
                            <input type='text' id='Nombre' class='form-control' name='nombre'>


                            <label for='Apellido' class='form-label'>Apellidos:</label>
                            <input type='text' class='form-control' id='Apellido' name='apellido'>
                            <label for='Email' class='form-label'>email:</label>
                            <input type='text' class='form-control' id='Email' name='email'>

                        </div>

                        <div class='col-md-6'>
                            <label for='Telefono' class='form-label'>Telefono:</label>
                            <input type='text' id='Telefono' class='form-control' name='telefono'>

                            <label for='Password' class='form-label'>Contraseña:</label>
                            <input type='text' class='form-control' id='Password' name='password'>
                            <label for='Fecha' class='form-label'>Fecha Nacimiento:</label>
                            <input type='date' class='form-control' id='Fecha' name='fecha'>

                        </div>
                    </div>
                </div>

                <div class="button-container text-center row">
                    <div class="col-md-6 col-xs-6 text-end">
                        <button class='btn btn-primary enviar3' type="submit">Añadir</button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-start">
                        <button  class='btn btn-primary cancelar' type="button">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>


        <div class='container fo wow slideInDown' id='for5' style='display:none;'>
            <form action='php/editar_empleado.php' method='POST' class='text-center'>
                <div class='mb-3 mt-3'>
                    <h3>Modificar Empleado</h3>
                    <div class='row mt-3'>
                        <div class='col-md-6'>
                            <label for='nombre2' class='form-label'>Nombre:</label>
                            <input type='text' id='nombre2' class='form-control' name='nombre'>
                            <label for='apellido2' class='form-label'>Apellidos:</label>
                            <input type='text' class='form-control' id='apellido2' name='apellido'>
                            <label for='dni' class='form-label'>Dni:</label>
                            <input type='text' class='form-control' id='dni' name='dni'>

                        </div>

                        <div class='col-md-6'>
                            <label for='telefono2' class='form-label'>Telefono:</label>
                            <input type='text' id='telefono2' class='form-control' name='telefono'>
                            <label for='password2' class='form-label'>Contraseña:</label>
                            <input type='text' class='form-control' id='password2' name='password'>
                            <label for='salario' class='form-label'>Salario:</label>
                            <input type='text' class='form-control' id='salario' name='salario'>

                        </div>
                        <div class='col-md-12'>
                            <label for='tipo' class='form-label'>Tipo:</label>
                            <input type='text' id='tipo' class='form-control' name='tipo'>

                        </div>
                    </div>
                </div>

                <div class="button-container text-center row">
                    <div class="col-md-6 col-xs-6 text-end">
                        <button class='btn btn-primary enviar3' type="submit">Añadir</button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-start">
                        <button class='btn btn-primary cancelar' type="button">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>


        <div class='container fo wow slideInDown' id='for6' style='display:none;'>
            <form action='php/añadir_empleado.php' method='POST' class='text-center'>
                <div class='mb-3 mt-3'>
                    <h3>Añadir Empleado</h3>
                    <div class='row mt-3'>
                        <div class='col-md-6'>
                            <label for='Nombre2' class='form-label'>Nombre:</label>
                            <input type='text' id='Nombre2' class='form-control' name='nombre'>
                            <label for='Apellido2' class='form-label'>Apellidos:</label>
                            <input type='text' class='form-control' id='Apellido2' name='apellido'>
                            <label for='Dni' class='form-label'>Dni:</label>
                            <input type='text' class='form-control' id='Dni' name='dni'>

                        </div>

                        <div class='col-md-6'>
                            <label for='Telefono2' class='form-label'>Telefono:</label>
                            <input type='text' id='Telefono2' class='form-control' name='telefono'>
                            <label for='Password2' class='form-label'>Contraseña:</label>
                            <input type='text' class='form-control' id='Password2' name='password'>
                            <label for='Salario' class='form-label'>Salario:</label>
                            <input type='text' class='form-control' id='Salario' name='salario'>

                        </div>
                        <div class='col-md-12'>
                            <label for='Tipo' class='form-label'>Tipo:</label>
                            <input type='text' id='Tipo' class='form-control' name='tipo'>

                        </div>
                    </div>
                </div>

                <div class="button-container text-center row">
                    <div class="col-md-6 col-xs-6 text-end">
                        <button class='btn btn-primary enviar3' type="submit">Añadir</button>
                    </div>
                    <div class="col-md-6 col-xs-6 text-start">
                        <button class='btn btn-primary  cancelar' type="button">Cancelar</button>
                    </div>
                </div>
            </form>
        </div>


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
                            <form class="rd-form rd-mailform form-inline" data-form-output="form-output-global" data-form-type="subscribe" method="post" action="bat/rd-mailform.php">
                                <div class="form-wrap">
                                    <input class="form-input" id="subscribe-form-2-email" placeholder="email" type="email" name="email" data-constraints="@Email @Required">
                                    <label class="form-label" for="subscribe-form-2-email"></label>
                                </div>
                                <div class="form-button">
                                    <button class="button button-primary button-icon button-icon-only button-winona" type="submit" aria-label="submit"><span class="icon mdi mdi-email-outline"></span>Enviar</button>
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


    <script type="text/javascript" src="js/usuariosjs.js"></script>
    <script src="js/core.min.js"></script>
    <script src="js/script.js"></script>

</body>

</html>