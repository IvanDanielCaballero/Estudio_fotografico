<?php
// Obtener datos del cliente
$cliente_id = isset($_GET['id_cliente']) ? $_GET['id_cliente'] : null;
$id_evento = isset($_GET['id_evento']) ? $_GET['id_evento'] : null;

if (!$cliente_id || !$id_evento) {
    die("Parámetros insuficientes.");
}

// Conexión a la base de datos usando PDO
try {
    $servername = "217.160.114.39";
    $username = "jose";
    $password = "56lf2G9BnTez";
    $dbname = "fotografia";

    $bd = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("No se pudo conectar a la base de datos: " . $e->getMessage());
}

// Obtener presupuesto específico del cliente que esté aprobado por eso el id_estado = 1
$stmt = $bd->prepare('SELECT * FROM presupuesto WHERE id_cliente = :id_cliente AND id_evento = :id_evento AND id_estado = 1');
$stmt->execute(['id_cliente' => $cliente_id, 'id_evento' => $id_evento]);
$presupuestos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (empty($presupuestos)) {
    header('Location: NO_presupuestos.html');
    exit(); // Es buena práctica agregar exit() después de una redirección

}

// Tomamos el primer presupuesto 
$presupuesto = $presupuestos[0];

// Obtener datos del cliente
$stmt = $bd->prepare('SELECT * FROM cliente WHERE id_cliente = :id');
$stmt->execute(['id' => $cliente_id]);
$cliente = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$cliente) {
    die("No se encontraron datos para el cliente especificado.");
}

// Obtener evento del presupuesto
$stmt = $bd->prepare('SELECT * FROM evento WHERE id_evento = :id_evento');
$stmt->execute(['id_evento' => $presupuesto['id_evento']]);
$evento = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$evento) {
    die("No se encontraron datos de evento para el presupuesto especificado.");
}

// Obtener la factura
$stmt = $bd->prepare('SELECT * FROM factura WHERE id_evento = :id_evento');
$stmt->execute(['id_evento' => $evento['id_evento']]);
$factura = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$factura) {
    die("No se encontraron datos de factura.");
}

// Obtener el estado de la  factura
$stmt = $bd->prepare('SELECT estado FROM estado_factura WHERE id_estado_factura = :id_estado_factura');
$stmt->execute(['id_estado_factura' => $factura['id_estado_factura']]);
$estado_factura = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$estado_factura) {
    die("No se encontraron datos de estado de factura");
} else {

    if ($estado_factura['estado'] == "pendiente") {
        $mensaje = '<div class="mb-2 ml-auto">
        <span class="text-muted">Detalles del Pago</span>
        <div class="d-flex flex-wrap wmin-md-400">
        <h3>la factura no se ha pagado</h3>
        
        
        </div>
    </div>';

    } else {
        $mensaje = ' <div class="mb-2 ml-auto">
        <span class="text-muted">Detalles del Pago</span>
        <div class="d-flex flex-wrap wmin-md-400">
            <ul class="list list-unstyled mb-0 text-left">

                <li>Nombre del banco:</li>
                <li>País:</li>
                <li>Ciudad:</li>
                <li>Dirección:</li>
                <li>IBAN:</li>
                <li>Código SWIFT:</li>
            </ul>
            <ul class="list list-unstyled text-right mb-0 ml-auto">

                <li><span class="font-weight-semibold">Banco Santander</span></li>
                <li>España</li>
                <li>Madrid</li>
                <li>Calle de Alcalá, 45</li>
                <li><span class="font-weight-semibold">ES9121000418450200051332</span></li>
                <li><span class="font-weight-semibold">BSCHESMMXXX</span></li>
            </ul>
        </div>
    </div>';
    }
}


?>







<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
        crossorigin="anonymous">
    <link rel="stylesheet" href="pdf.css" />
    
    <script src="pdf.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.js"></script>
    <style>
        h4 {
            color: #eec275;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center mt-50 mb-50">
        <div class="row">
            <div class="col-md-12 text-right mb-3">
                <button class="btn btn-primary" id="download">Descargar pdf</button>
            </div>
            <div class="col-md-12">
                <div class="card" id="invoice">
                    <div class="card-header bg-transparent header-elements-inline">
                        <h6 class="card-title text-primary">Factura de venta</h6>
                    </div>
                    <div class="card-body" style="padding-bottom: 0px;">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mb-4 pull-left">
                                    <ul class="list list-unstyled mb-0 text-left">
                                        <li>
                                            <h2>InstantArt</h2>
                                        </li>
                                        <li>Yecla</li>
                                        <li>675456345</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mb-4">
                                    <div class="text-sm-right">
                                        <h4 class="mb-2 mt-md-2">Invoice
                                            #<?php echo htmlspecialchars($factura['id_factura']); ?></h4>
                                        <ul class="list list-unstyled mb-0">
                                            <li>Fecha emisión: <span
                                                    class="font-weight-semibold"><?php echo htmlspecialchars($factura['fecha_emision']); ?></span>
                                            </li>
                                            <li>Estado: <span
                                                    class="font-weight-semisbold"><?php echo htmlspecialchars($estado_factura['estado']); ?></span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-md-flex flex-md-wrap">
                            <div class="mb-4 mb-md-2 text-left">
                                <span class="text-muted">Factura para:</span>
                                <ul class="list list-unstyled mb-0">
                                    <li>
                                        <h5 class="my-2"><?php echo htmlspecialchars($cliente['nombre']); ?></h5>
                                    </li>
                                    <li><span
                                            class="font-weight-semibold"><?php echo htmlspecialchars($cliente['apellidos']); ?></span>
                                    </li>

                                    <li><?php echo htmlspecialchars($cliente['telefono']); ?></li>
                                    <li><a
                                            href="mailto:<?php echo htmlspecialchars($cliente['email']); ?>"><?php echo htmlspecialchars($cliente['email']); ?></a>
                                    </li>
                                </ul>
                            </div>

                            <?php echo $mensaje; ?>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-lg">
                            <thead>
                                <tr>
                                    <th>Descripción</th>
                                    <th>Fecha de evento</th>
                                    <th>Hora de evento</th>

                                    <th>Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <h6 class="mb-0"><?php echo htmlspecialchars($evento['descripcion']); ?></h6>
                                        <span
                                            class="text-muted"><?php echo htmlspecialchars($presupuesto['descripcion_detallada']); ?></span>
                                    </td>
                                    <td><?php echo htmlspecialchars($evento['fecha']); ?></td>
                                    <td><?php echo htmlspecialchars($evento['hora']); ?></td>
                                    <td><span
                                            class="font-weight-semibold">€<?php echo htmlspecialchars($factura['importe']); ?></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body">
                        <div class="d-md-flex flex-md-wrap">
                            <div class="pt-2 mb-3 wmin-md-400 ml-auto">
                                <h6 class="mb-3 text-left">Total a pagar</h6>
                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th class="text-left">Subtotal:</th>
                                                <td class="text-right">
                                                    €<?php echo htmlspecialchars($factura['importe']); ?></td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Impuesto: <span
                                                        class="font-weight-normal">(<?php echo htmlspecialchars($factura['iva']); ?>%)</span>
                                                </th>
                                                <td class="text-right">
                                                    €<?php echo htmlspecialchars(($factura['importe'] * $factura['iva']) / 100); ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th class="text-left">Total:</th>
                                                <td class="text-right text-primary">
                                                    <h5 class="font-weight-semibold">
                                                        €<?php echo htmlspecialchars($factura['importe']) + (($factura['importe'] * $factura['iva']) / 100); ?>
                                                    </h5>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <img src="../InstantArt/images/logo-default-176x28.png" alt="">
                    </div>

                    <div class="card-footer mt-0">
                        <span class="text-muted">
                            Los servicios prestados son exclusivamente para el propósito acordado y detallado en la
                            factura.
                            El pago total debe recibirse en la cuenta designada dentro de los 30 días posteriores a la
                            emisión de esta factura.
                            La factura y los servicios asociados son estrictamente confidenciales y no pueden ser
                            compartidos con terceros sin consentimiento previo.
                        </span>
                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

<script>

    window.onload = function () {
        document.getElementById("download")
            .addEventListener("click", () => {
                const invoice = this.document.getElementById("invoice");
                console.log(invoice);
                console.log(window);
                var opt = {
                    margin: 0.2,
                    filename: 'factura.pdf',
                    image: { type: 'jpeg', quality: 0.98 },
                    html2canvas: { scale: 2 },
                    jsPDF: { unit: 'in', format: 'letter', orientation: 'portrait' }
                };
                html2pdf().from(invoice).set(opt).save();
            })
    }
</script>

</html>