<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $secretKey = "6Lc-ht4pAAAAAGs4aKby8bmmxRrxkZafK9ZEVah3";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        $message = "Error: Por favor, completa el CAPTCHA";
        header("Location:  http://localhost/Estudio_fotografico/InstantArt/contactanos.php?message=" . urlencode($message) . "&type=error");
        exit;
    } else {
        $nombre = $_POST['nombre'];
        $apellidos = $_POST['apellidos'];
        $telefono = $_POST['telefono'];
        $duda = $_POST['duda'];
        $email = $_POST['email'];

        $destinatario = 'instantartoficial@gmail.com';
        $asunto = 'Envio de duda y/o requerimiento de informacion';
        $contenido = $contenido = '
        <!DOCTYPE html>
        <html lang="es">
        <head>
          <meta charset="UTF-8">
          <meta name="viewport" content="width=device-width, initial-scale=1.0">
          <title>Duda y/o requerimiento de información</title>
        </head>
        <body>
          <h2 style="color: #333;">Duda y/o requerimiento de información</h2>
          <p><strong>Nombre:</strong> ' . htmlspecialchars($nombre) . '</p>
          <p><strong>Apellidos:</strong> ' . htmlspecialchars($apellidos) . '</p>
          <p><strong>Teléfono:</strong> ' . htmlspecialchars($telefono) . '</p>
          <p><strong>Duda o requerimiento:</strong></p>
          <p>' . nl2br(htmlspecialchars($duda)) . '</p>
          <p><strong>Email:</strong> ' . htmlspecialchars($email) . '</p>
        </body>
        </html>';
        
        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'instantartcomunicate@gmail.com';
            $mail->Password = 'puye ubos gkff dlwe';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Destinatarios
            $mail->setFrom('instantartoficial@gmail.com', 'Cliente');
            $mail->addAddress($destinatario);

            //Contenido
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body = $contenido;

            $mail->send();
            $message = "El mensaje ha sido enviado correctamente.";
            header("Location: ../contactanos.php?message=" . $message . "&type=success");

        } catch (Exception $e) {
            $message = "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
            header("Location: ../contactanos.php?message=" . $message . "&type=error");
 
        }
    }
}
?>
