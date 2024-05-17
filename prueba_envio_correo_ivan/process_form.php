<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $secretKey = "6Lc-ht4pAAAAAGs4aKby8bmmxRrxkZafK9ZEVah3";
    $responseKey = $_POST['g-recaptcha-response'];
    $userIP = $_SERVER['REMOTE_ADDR'];

    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
    $response = file_get_contents($url);
    $responseKeys = json_decode($response, true);

    if (intval($responseKeys["success"]) !== 1) {
        echo "Por favor, completa el CAPTCHA";
    } else {

        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $destinatario = 'vanchocaballero@gmail.com';
        $asunto = 'Lo logre';
        $contenido = 'El contenido es que ' . $nombre;

        $mail = new PHPMailer(true);
        try {
            //Configuración del servidor
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'vanchocaballero@gmail.com'; // Cambia 'tucorreo' por tu dirección de correo Gmail
            $mail->Password = 'nrty dhvi aphh czel'; // Cambia 'tucontraseña' por tu contraseña de Gmail
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Destinatarios
            $mail->setFrom('danielmarinocamberos@gmail.com', 'Ivan'); // Cambia 'tucorreo' por tu dirección de correo Gmail y 'Tu Nombre' por tu nombre
            $mail->addAddress($destinatario);

            //Contenido
            $mail->isHTML(true);
            $mail->Subject = $asunto;
            $mail->Body    = $contenido;

            $mail->send();
            echo "<script>alert('El correo se ha enviado');</script>";
        } catch (Exception $e) {
            echo "El mensaje no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
