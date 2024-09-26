
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../css/style-login.css">
    <!-- require_once("./app/views/inc/head.php");  -->
</head>

<body>
  <!-- require_once("./app/views/inc/navbar.php"); -->

    <main>
        <div class="login-container">
            <!-- Formulario de inicio de sesión -->
            <form action="../../controllers/loginController.php" method="POST">
                <label for="correo">Usuario o Correo Electrónico</label>
                <input type="text" id="correo" name="correo" placeholder="Usuario o Correo Electrónico" 
                    required minlength="8" maxlength="50"
                    pattern="([A-Za-z0-9_]{8,30}|([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}))"
                    title="Debe ser un nombre de usuario de 8-30 caracteres o una dirección de correo electrónico válida.">

                <label for="contrasena">Password</label>
                <input type="password" id="contrasena" name="contrasena" placeholder="Password" 
                    required minlength="8" maxlength="20" 
                    title="La contraseña debe tener entre 8 y 20 caracteres.">

                <div class="checkbox-container">
                    <input type="checkbox" id="keep-signed-in">
                    <label for="keep-signed-in">Keep me signed in.</label>
                </div>

                <button type="submit" class="sign-in-button">Sign in</button>

                <a href="#" class="forgot-password">Forgot your password?</a>

                <a href="register-view.php">
                    <button  type="button" class="register-button">Registro</button>
                </a>
                

                <!-- Mostrar mensaje de error si existe -->
                <?php if (!empty($error)) : ?>
                    <div class="error-message">
                        <?php echo $error; ?>
                    </div>
                <?php endif; ?>
            </form>

        </div>
    </main>

</body>
</html>
