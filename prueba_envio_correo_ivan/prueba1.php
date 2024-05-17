<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario con CAPTCHA</title>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="process_form.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br><br>

        <div class="g-recaptcha" data-sitekey="6Lc-ht4pAAAAAFD-hRTNCi5373mfYayLpmz_B-FE"></div><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
