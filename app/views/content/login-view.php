<!DOCTYPE html>
<html lang="en">

<head>

    <?php require_once("./app/views/inc/head.php"); ?>

</head>

<body id="body_login">
    <main id="main_login">

        <form action="#" method="POST" id="form_login" class="FormularioAjax">
            <h1>Ingresa</h1>
            <label for="input_usuario" id="label_login">
                Usuario o correo
                <input type="text" id="input_usuario_login" placeholder="Usuario" placeholder="Usuario o correo" title="Debe tener entre 4 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="10" maxlength="100" required>
            </label>

            <label for="input_contraseña" id="label_login">
                Contraseña
                <input type="password" id="input_contraseña_login" placeholder="Contraseña" placeholder="Usuario o correo" title="Debe tener entre 4 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="10" maxlength="50" required>
            </label>

            <label for="input_checkbox" id="label_checkbox_login">
                <input type="checkbox" id="input_checkbox"v checked>Mantenerme logueado
            </label>

            <input type="submit" value="Ingresar">
            <a id="no_tienes_cuenta" href="register">¿No tienes cuenta?</a>
        </form>
    </main>
</body>

</html>