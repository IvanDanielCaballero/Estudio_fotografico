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
    <link href="http://fonts.googleapis.com/css?family=Roboto:400,700,300" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="usuarios_form.css" />
    <link rel="stylesheet" href="estilos.css" />





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
    if (isset($_SESSION['usuario'])) {
        echo '<script>var id_empleado = "' . $_SESSION['id_empleado'] . '"; var inicio=true;</script>';
    }

    if (isset($_SESSION['usuario']) && isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin') {
        echo '<script>var admin=true;</script>';
    } else {
        header("Location: index.php");
    }
    ?>


    <div class="ie-panel"></div>
    <div class="page"></a>
        <header class="section page-header">
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
                            <div class="rd-navbar-panel">
                                <button class="rd-navbar-toggle"
                                    data-rd-navbar-toggle="#rd-navbar-nav-wrap-1"><span></span></button>
                                <a class="rd-navbar-brand" href="index.php"><img src="logo.png" alt="" width="400"
                                        height="200" srcset="logo.png" /></a>
                            </div>
                            <div class="rd-navbar-main-element">
                                <div class="rd-navbar-nav-wrap" id="rd-navbar-nav-wrap-1">
                                    <ul class="rd-navbar-nav">
                                        <li class="rd-nav-item active"><a class="rd-nav-link"href="../index.php">Inicio</a></li>
                                        <li class="rd-nav-item"><a class="rd-nav-link" href="../about-me.html">SobreNosotros</a></li>
                                        <li class="rd-nav-item"><a class="rd-nav-link" id="usuarios"href="../usuarios.php" style="display: none;">Usuarios</a></li>
                                        <!--Area de gestion de clientes-->
                                        <li class="rd-nav-item"><a class="rd-nav-link" id="gestion_proyectos" href="gestion_proyectos.php">Gestion de proyectos</a></li>
                                        <li class="rd-nav-item"><a class="rd-nav-link ml-5" id="inicio_sesion" href="../login.php" style="margin-left: 40px;">Iniciar Sesion</a></li>
                                        <li class="rd-nav-item"><a class="rd-nav-link" id="cerrar_sesion" href="../logout.php" style="display: none;">Cerrar Sesion</a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </header>


        <div class="col-12 text-center">
            <h3 class="section-title wow-outer"><span class="wow slideInUp">Gestion de trabajos</span></h3>
            <h4 id="empleado"></h4>
        </div>


        <?php
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

        $sql = " SELECT  e.id_evento,  te.nombre, e.localidad, e.fecha, eq.nombre as equipo, e.hora, e.descripcion, e.id_cliente
        FROM evento e
        JOIN tipo_evento te ON e.id_tipo_evento = te.id_tipo_evento
        JOIN evento_empleado ee ON e.id_evento = ee.id_evento
        JOIN equipo eq ON e.id_equipo = eq.id_equipo
        WHERE ee.id_empleado = ".$_SESSION['id_empleado']."
        ORDER BY e.fecha ASC";
        $result = $conn->query($sql);


        $sql2 = "SELECT concat(nombre, ' ', apellidos) from empleado where id_empleado =".$_SESSION['id_empleado']."";
        $result2 = $conn->query($sql2)->fetch_column();
        echo '<script>var nombre = "' . $result2 .'"</script>';
        echo '<script> document.getElementById("empleado").innerText=nombre;</script>';
        ?>
        

        <div class="wrapper wow slideInLeft" id="tabla1">

            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">

                        <div class="fresh-table full-color-orange">
                            <div class="toolbar">
                            </div>

                            <table id="fresh-table" class="table">
                                <thead>
                                    <th data-field="id_evento">ID</th>
                                    <th data-field="ciudad" data-sortable="true">Equipo</th>
                                    <th data-field="hora" data-sortable="true">Ciudad</th>
                                    <th data-field="fecha" data-sortable="true">Hora</th>
                                    <th data-field="equipo">Fecha</th>
                                    <th data-field="descripcion">Tipo</th>
                                    <th data-field="id_cliente">Descripcion</th>
                                    <th data-field="fecha_nacimiento">Id Cliente</th>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($result->num_rows > 0) {
                                        foreach ($result as $row) {
                                            $id = $row["id_evento"];
                                            echo "<tr>";
                                            echo "<td>" . $row["id_evento"] . "</td>";
                                            echo "<td>" . $row["equipo"] . "</td>";
                                            echo "<td>" . $row["localidad"] . "</td>";
                                            echo "<td>" . $row["hora"] . "</td>";
                                            echo "<td>" . $row["fecha"] . "</td>";
                                            echo "<td>" . $row["nombre"] . "</td>";
                                            echo "<td>" . $row["descripcion"] . "</td>";
                                            echo "<td>" . $row["id_cliente"] . "</td>";
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
        <div class="preloader-logo"><img src="logo.png" alt="" width="176" height="28" srcset="logo.png 2x" />
        </div>
        <div class="preloader-body">
            <div id="loadingProgressG">
                <div class="loadingProgressG" id="loadingProgressG_1"></div>
            </div>
        </div>
    </div>

    <div class="snackbars" id="form-output-global"></div>



    <script type="text/javascript">
        if (inicio != undefined && inicio == true) {
            document.getElementById("inicio_sesion").style.display = "none"
            document.getElementById("cerrar_sesion").style.display = "block";
            console.log("inicio sesion");
        }

        if (admin != undefined && admin == true) {
            console.log("admin")
            document.getElementById("usuarios").style.display = "block";
        }


        var $table = $('#fresh-table')


        $(function () {
            $table.bootstrapTable({
                classes: 'table table-hover table-striped',
                toolbar: '.toolbar',
                search: true,
                showPaginationSwitch: true,
                showRefresh: true,
                showToggle: true,
                showColumns: false,
                pagination: true,
                striped: true,
                sortable: true,
                pageSize: 5,
                pageList: [8, 10],

                formatShowingRows: function (pageFrom, pageTo, totalRows) {
                    return 'Mostrando ' + pageFrom + ' a ' + pageTo + ' de ' + totalRows + ' filas';
                },
                formatRecordsPerPage: function (pageNumber) {
                    return ''
                }
            })
        })


    </script>
    <script src="core.min.js"></script>
    <script src="../js/script.js"></script>

</body>

</html>