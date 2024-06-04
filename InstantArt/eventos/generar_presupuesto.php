<?php
require '../php/funciones.php';
$id_presupuesto = $_GET['id'];


try {
    // Conectar a la base de datos
    $pdo = conexion();

    // Preparar la consulta SQL para insertar los datos
    $stmt = $pdo->prepare('SELECT * FROM presupuesto WHERE id_presupuesto = :id_presupuesto');

    $stmt->execute(['id_presupuesto' => $id_presupuesto]);
    $presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$presupuesto) {
        die("No se encontraron datos para el presupuesto especificado.");
    }


    $stmt = $pdo->prepare('SELECT * FROM estado_presupuesto WHERE id_estado = :id_estado');
    $stmt->execute(['id_estado' => $presupuesto['id_estado']]);
    $estado_presupuesto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$presupuesto) {
        die("No se encontraron datos para el estado_presupuesto especificado.");
    }





    // Obtener datos del cliente
    $stmt = $pdo->prepare('SELECT * FROM cliente WHERE id_cliente = :id_cliente');
    $stmt->execute(['id_cliente' => $presupuesto['id_cliente']]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$cliente) {
        die("No se encontraron datos para el cliente especificado.");
    }



    // Obtener evento del presupuesto
    $stmt = $pdo->prepare('SELECT * FROM evento WHERE id_evento = :id_evento');
    $stmt->execute(['id_evento' => $presupuesto['id_evento']]);
    $evento = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$evento) {
        die("No se encontraron datos de evento para el presupuesto especificado.");
    }

} catch (PDOException $e) {
    echo $e->getMessage();
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presupuesto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-Q5oIJ5xvLOQeL6isSWAWZsO8F0nVJd9o3+xL//VqoXLlf4uJ+ec0cObrxAvCIdkUwKXuRtlZ3kF9VVrE7j/eVQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #ffffff;
            border-bottom: none;
        }

        .card-title {
            color: #007bff;
        }

        .card-body {
            padding: 20px;
        }

        .list-unstyled {
            padding-left: 0;
            list-style: none;
        }

        .list-unstyled li {
            margin-bottom: 5px;
        }

        .table th,
        .table td {
            border-top: none;
        }

        .font-weight-semibold {
            font-weight: 600;
        }

        .text-primary {
            color: #007bff;
        }

        .text-muted {
            color: #6c757d;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 20px;
            border-top: 1px solid #dee2e6;
        }

        /* === removing default button style ===*/
        .button {
            margin: 0;
            height: auto;
            background: transparent;
            padding: 0;
            border: none;
            cursor: pointer;
        }

        /* button styling */
        .button {
            --border-right: 6px;
            --text-stroke-color: rgba(7, 7, 7, 0.6);
            --animation-color: #ebb85e;
            ;
            --fs-size: 2em;
            letter-spacing: 3px;
            text-decoration: none;
            font-size: var(--fs-size);
            font-family: "Arial";
            position: relative;
            text-transform: uppercase;
            color: transparent;
            -webkit-text-stroke: 1px var(--text-stroke-color);
        }

        /* this is the text, when you hover on button */
        .hover-text {
            position: absolute;
            box-sizing: border-box;
            content: attr(data-text);
            color: var(--animation-color);
            width: 0%;
            inset: 0;
            border-right: var(--border-right) solid var(--animation-color);
            overflow: hidden;
            transition: 0.5s;
            -webkit-text-stroke: 1px var(--animation-color);
        }

        /* hover */
        .button:hover .hover-text {
            width: 100%;
            filter: drop-shadow(0 0 23px var(--animation-color))
        }

        h4 {
            color: #ebb85e;
        }




        .cartel {
            position: relative;
            width: 200px;
            height: 200px;
            background: lightgrey;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
            transition: all 1s ease-in-out;
        }

        .background {
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 100% 107%, #545454 0%, #000000 30%, #ebb85e 60%);
        }

        .logo {
            position: absolute;
            right: 50%;
            bottom: 50%;
            transform: translate(50%, 50%);
            transition: all 0.6s ease-in-out;
        }

        .logo .logo-svg {
            fill: white;
            width: 30px;
            height: 30px;
        }

        .icon {
            display: inline-block;
            width: 20px;
            height: 20px;
        }

        .icon .svg {
            fill: rgba(255, 255, 255, 0.797);
            width: 100%;
            transition: all 0.5s ease-in-out;
        }

        .box {
            position: absolute;
            padding: 10px;
            text-align: right;
            background: rgba(255, 255, 255, 0.389);
            border-top: 2px solid rgb(255, 255, 255);
            border-right: 1px solid white;
            border-radius: 10% 13% 42% 0%/10% 12% 75% 0%;
            box-shadow: rgba(100, 100, 111, 0.364) -7px 7px 29px 0px;
            transform-origin: bottom left;
            transition: all 1s ease-in-out;
        }

        .box::before {
            content: "";
            position: absolute;
            inset: 0;
            border-radius: inherit;
            opacity: 0;
            transition: all 0.5s ease-in-out;
        }

        .box:hover .svg {
            fill: white;
        }

        .box1 {
            width: 70%;
            height: 70%;
            bottom: -70%;
            left: -70%;
        }

        .box1::before {
            background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #ff53d4 60%, #62c2fe 90%);
        }

        .box1:hover::before {
            opacity: 1;
        }

        .box1:hover .icon .svg {
            filter: drop-shadow(0 0 5px white);
        }

        .box2 {
            width: 50%;
            height: 50%;
            bottom: -50%;
            left: -50%;
            transition-delay: 0.2s;
        }

        .box2::before {
            background: radial-gradient(circle at 30% 107%, #91e9ff 0%, #00ACEE 90%);
        }

        .box2:hover::before {
            opacity: 1;
        }

        .box2:hover .icon .svg {
            filter: drop-shadow(0 0 5px white);
        }

        .box3 {
            width: 30%;
            height: 30%;
            bottom: -30%;
            left: -30%;
            transition-delay: 0.4s;
        }

        .box3::before {
            background: radial-gradient(circle at 30% 107%, #25d366 0%, #128c7e 90%);
        }

        .box3:hover::before {
            opacity: 1;
        }

        .box3:hover .icon .svg {
            filter: drop-shadow(0 0 5px white);
        }

        .box4 {
            width: 10%;
            height: 10%;
            bottom: -10%;
            left: -10%;
            transition-delay: 0.6s;
        }

        .cartel:hover {
            transform: scale(1.1);
        }

        .cartel:hover .box {
            bottom: -1px;
            left: -1px;
        }

        .cartel:hover .logo {
            transform: translate(0, 0);
            bottom: 20px;
            right: 20px;
        }

        #cartel_logo {
            display: flex;
            justify-content: center;
        }

        .card-footer {
            margin: 3%;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div id="invoice" class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-primary">Presupuesto</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-unstyled">
                                    <li>
                                        <button class="button" data-text="Awesome">
                                            <span class="actual-text text-dark">&nbsp;InstantArt&nbsp;</span>
                                            <span aria-hidden="true" class="hover-text">&nbsp;InstantArt&nbsp;</span>
                                        </button>
                                    </li>
                                    <li>Calle San Jose 123</li>
                                    <li>675456345</li>
                                </ul>
                            </div>
                            <div class="col-md-6 text-right">
                                <h4 class="mb-3">Presupuesto
                                    #<?php echo htmlspecialchars($presupuesto['id_presupuesto']); ?></h4>
                                <ul class="list-unstyled">
                                    <li>Fecha inicio: <span
                                            class="font-weight-semibold"><?php echo htmlspecialchars($presupuesto['fecha_creacion']); ?></span>
                                    </li>
                                    <li>Estado: <span
                                            class="font-weight-semibold"><?php echo htmlspecialchars($estado_presupuesto['nombre']); ?></span>
                                    </li>
                                    <li>Fecha fin: <span
                                            class="font-weight-semibold"><?php echo htmlspecialchars($presupuesto['fecha_vencimiento']); ?></span>
                                    </li>

                                </ul>
                            </div>
                        </div>
                        <hr>
                        <div class="mb-4">
                            <h5 class="text-muted">Presupuesto para:</h5>
                            <h5><?php echo htmlspecialchars($cliente['nombre']) . ' ' . htmlspecialchars($cliente['apellidos']); ?>
                            </h5>
                            <ul class="list-unstyled">
                                <li>+34 <?php echo htmlspecialchars($cliente['telefono']); ?></li>
                                <li><?php echo htmlspecialchars($cliente['email']); ?></li>
                            </ul>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Descripción</th>
                                        <th>Fecha del evento</th>
                                        <th>Hora del evento</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>

                                            <span
                                                class="text-muted"><?php echo htmlspecialchars($presupuesto['descripcion_detallada']); ?></span>
                                        </td>
                                        <td><?php echo htmlspecialchars($evento['fecha']) . ' ' . htmlspecialchars($evento['localidad']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($evento['hora']); ?></td>
                                        <td><span
                                                class="font-weight-semibold"><?php echo htmlspecialchars($presupuesto['precio']); ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <th class="text-left">Subtotal:</th>
                                        <td class="text-right"><?php echo htmlspecialchars($presupuesto['precio']); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-left">Total (sin IVA):</th>
                                        <td class="text-right text-primary">
                                            <?php echo htmlspecialchars($presupuesto['precio']); ?></td>
                                    </tr>
                                </tbody>
                            </table>

                            <div id="cartel_logo">
                                <img src="../images/logo-default-176x28.png" class="img" style="display: none;" alt="">
                                <div class="cartel">
                                    <div class="background">
                                    </div>
                                    <div class="logo">
                                        <img src="../images/logo-default-176x28.png" alt="">
                                    </div>
                                    <div class="box box1"><span class="icon"><svg viewBox="0 0 30 30"
                                                xmlns="http://www.w3.org/2000/svg" class="svg">
                                                <path
                                                    d="M 9.9980469 3 C 6.1390469 3 3 6.1419531 3 10.001953 L 3 20.001953 C 3 23.860953 6.1419531 27 10.001953 27 L 20.001953 27 C 23.860953 27 27 23.858047 27 19.998047 L 27 9.9980469 C 27 6.1390469 23.858047 3 19.998047 3 L 9.9980469 3 z M 22 7 C 22.552 7 23 7.448 23 8 C 23 8.552 22.552 9 22 9 C 21.448 9 21 8.552 21 8 C 21 7.448 21.448 7 22 7 z M 15 9 C 18.309 9 21 11.691 21 15 C 21 18.309 18.309 21 15 21 C 11.691 21 9 18.309 9 15 C 9 11.691 11.691 9 15 9 z M 15 11 A 4 4 0 0 0 11 15 A 4 4 0 0 0 15 19 A 4 4 0 0 0 19 15 A 4 4 0 0 0 15 11 z">
                                                </path>
                                            </svg></span></div>
                                    <div class="box box2">
                                        <span class="icon">
                                            <svg viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="svg">
                                                <path
                                                    d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z">
                                                </path>
                                            </svg></span>
                                    </div>
                                    <div class="box box3">
                                        <span class="icon">
                                            <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="svg">
                                                <path
                                                    d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z">
                                                </path>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="footer">
                        <p class="text-muted">El precio de este presupuesto no incluye el IVA. Los servicios propuestos
                            están sujetos a términos y condiciones acordados
                        </p>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary" id="download"><i class="fas fa-download"></i> Descargar PDF</button>
                    <button class="btn btn-primary" id="btn_continuar"> <i
                            class="bi bi-arrow-right-circle-fill"></i>Continuar</button>

                </div>
            </div>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <script>
        document.getElementById('btn_continuar').onclick = function () {
            window.location.href = '../gestion/gestion_proyectos.php';
        };

        document.getElementById('download').addEventListener('click', function () {
            var element = document.getElementById('invoice');
            var img = document.getElementsByClassName('img')[0];
            img.style.display = 'block';
            document.getElementsByClassName('cartel')[0].style.display = 'none';

            document.getElementsByClassName('card-footer')[0].style.display = 'none';

            html2pdf().from(element).save();
            setTimeout(
                function () {
                    img.style.display = 'none';

                    document.getElementsByClassName('cartel')[0].style.display = 'block';
                    document.getElementsByClassName('card-footer')[0].style.display = 'block';

                }, 1000);
        });



    </script>
</body>

</html>