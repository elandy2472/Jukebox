<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body id="body_register">
    <main id="main_register">
        <form action="<?php APP_URL; ?>app/ajax/usuarioAjax.php" method="POST" id="form_register" class="FormularioAjax" enctype="multipart/form-data">

            <h1>Registra tu empresa</h1>

            <label for="input_nombres_register" id="label_register">
                Nombres
                <input type="text" id="input_nombres_register" name="nombres" placeholder="Usuario o correo" title="Debe tener entre 4 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="4" maxlength="50" required>
            </label>

            <label for="input_apellidos_register" id="label_register">
                Apellidos
                <input type="text" id="input_apellidos_register" name="apellidos" placeholder="Apellidos" title="Debe tener entre 6 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="6" maxlength="50" required>
            </label>

            <label for="input_correo_register" id="label_register">
                Correo
                <input type="email" id="input_correo_register" name="correo" placeholder="Correo" title="Debe tener entre 4 y 100 caracteres, sin espacio, numeros ni C. especiales" minlength="10" maxlength="100" required>
            </label>

            <label for="input_tipo_documento_register" id="label_register">
                Documento
                <input type="number" id="input_tipo_documento_register" name="tipo_documento" title="Debe tener entre 8 y 10  caracteres, sin espacio, numeros ni C. especiales" placeholder="Tipo de documento" minlength="8" maxlength="10" required>
            </label>

            <label for="input_usuario_register" id="label_register">
                Usuario
                <input type="text" id="input_usuario_register" name="usuario" placeholder="Usuario" title="Debe tener entre 10 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="10" maxlength="50" required>
            </label>

            <label for="input_contraseña_register" id="label_register">
                Contraseña
                <input type="password" id="input_contraseña_register" name="contraseña" placeholder="Contraseña" title="Debe tener entre 8 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="10" maxlength="50" required>
            </label>

            <label for="input_empresa_register" id="label_register">
                Empresa
                <input type="text" id="input_empresa_register" name="empresa" placeholder="Empresa" title="Debe tener entre 4 y 50 caracteres, sin espacio, numeros ni C. especiales" minlength="4" maxlength="50" required>
            </label>

            <div id="label_register_div">
                <label for="input_empresa_register" id="label_register">
                    Direccion
                    <input type="text" id="input_empresa_register" name="direccion" placeholder="Empresa" title="Debe tener entre 10 y 150 caracteres, sin espacio, numeros ni C. especiales" minlength="10" maxlength="150" required>
                </label>
                <label for="input_empresa_register" id="label_register">
                    Ciudad
                    <input type="text" id="input_empresa_register" name="ciudad" placeholder="Empresa" title="Debe tener entre 4 y 20 caracteres, sin espacio, numeros ni C. especiales" minlength="4" maxlength="20" required>
                </label>
            </div>

            <label for="input_documento_register" id="label_register">
                Subir documento
                <input type="file" id="input_documento_register" name="documento">
            </label>

            <label for="input_nit_register" id="label_register">
                Nit
                <input type="text" id="input_nit_register" name="nit" title="Debe tener 12 caracteres, sin espacio, numeros ni C. especiales" minlength="12" maxlength="12" required>
            </label>

            <input type="submit" name="enviar" value="Ingresar">

            <a id="ya_tienes_cuenta" href="login">¿Ya tienes cuenta?</a>
        </form>
    </main>
</body>

</html>
