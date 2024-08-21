<!-- Pagina principal que se va a ejecutar, es decir, vendría siendo el INDEX -->

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body>
    <?php require_once("./app/views/inc/navbar.php") ?>

    <main>
        <section class="section_ingresar_sala">
            <div class="mensaje_section_ingresar_sala">
                <h1>¡Que empiece la rumba virtual!</h1>
                <p>Solo ingresa un apodo, y el codigo de una sala y a disfrutar</p>
            </div>
            <div class="inputs_entrar_sala">
                <form action="#" method="POST" id="formulario_ingresar_sala">
                    <label for="nickname" id="lbl_nickname">
                        Apodo
                        <input type="text" id="nickname" name="nickname" placeholder="Ingresa tu Apodo">
                    </label>
                    <label for="codigo" id="lbl_codigo">
                        Codigo
                        <input type="text" id="codigo" name="codigo" placeholder="Ingresa el codigo de la sala">
                    </label>
                    <input type="submit" id="boton_ingresar_sala" value="Enviar">
                </form>
            </div>
        </section>
        <section class="tarjeta_como_funciona_jukebox">
<div class="contenedor_tarjeta_como_funciona_titulo">

</div>
<div class="contenedor_tarjeta_como_funciona_contenedores">

</div>
        </section>
    </main>
</body>

</html>