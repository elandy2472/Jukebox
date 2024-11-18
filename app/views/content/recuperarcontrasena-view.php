<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="./app/views/css/recuperar-contrasena-view.css">
</head>
<body>
    <div class="container">
        <i class="fas fa-lock lock-icon"></i>
        <h1>Recuperar Contraseña</h1>
        <p>Ingresa tu correo electrónico para recibir un enlace de recuperación.</p>
        <form action="<?php echo APP_URL;?>app/controllers/RecuperacionController.php" method="POST">
            <input type="email" name="email" placeholder="Correo electrónico" required>
            <input type="submit" value="Enviar enlace de recuperación">
        </form>
        <p><a href="./login">Volver al inicio de sesión</a></p>
    </div>
</body>
</html>
