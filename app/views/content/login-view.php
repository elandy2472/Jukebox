<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href=".\app\views\css\style-login.css">
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body id="body_login">
    <?php require_once("./app/views/inc/navbar.php") ?>

    <main id="main_login">

        <form action="login" method="post" id="form_login">
            <label for="username" id="label_login">Usuario o Correo Electrónico
                <input type="text" id="username" name="username" placeholder="Usuario o Correo Electrónico"
                    required minlength="8" maxlength="50"
                    pattern="([A-Za-z0-9_]{8,30}|([a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}))"
                    title="Debe ser un nombre de usuario de 8-30 caracteres o una dirección de correo electrónico válida.">
            </label>
            <label for="password" id="label_login">Password
                <input type="password" id="password" name="password" placeholder="Password"
                    required minlength="8" maxlength="20"
                    title="La contraseña debe tener entre 8 y 20 caracteres.">
            </label>
            <label for="input_checkbox" id="label_checkbox_login">
                <input type="checkbox" id="input_checkbox" v checked>Mantenerme logueado
            </label>

            <input type="submit" value="Ingresar">
            <a id="no_tienes_cuenta" href="register">¿No tienes cuenta?</a>
            <a id="olvido_contraseña" href="">¿Olvido su contraseña?</a>

            <?php if (!empty($error)) : ?>
                <div class="error-message">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
        </form>


    </main>

</body>

</html>