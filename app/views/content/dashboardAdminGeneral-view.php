<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("./app/views/inc/head.php");
    ?>
</head>

<body id="body_dashboardAdmin_General">
    <aside id="aside_dashboardAdmin_General">
        <div id="contenedor_titulo_y_opciones_arriba_General">
            <div id="titulo_panel_control_General">
                <h1><i class='bx bx-user-circle'></i> Pepito Perez</h1>
            </div>
            <ul id="opciones_arriba_General">
                <li id="li_dashboardAdmin_General">
                    <a id="a_dashboardAdmin_General" href="#"><i class='bx bxs-home'></i> Principal</a>
                </li>
                <li id="li_dashboardAdmin_General">
                    <a id="a_dashboardAdmin_General" href="#"><i class='bx bx-news'></i> Salas</a>
                </li>
                <li id="li_dashboardAdmin_General">
                    <a id="a_dashboardAdmin_General" href="usuarioPorAceptar"> <i class='bx bxs-user'></i> Por aceptar</a>
                </li>
                <li id="li_dashboardAdmin_General">
                    <a id="a_dashboardAdmin_General" href="#"><i class='bx bxs-cog'></i> Configuracion</a>
                </li>
            </ul>
        </div>

        <div id="contenedor_titulo_y_opciones_abajo_General">
            <ul id="opciones_abajo_General">
                <li id="li_dashboardMain_abajo_General">
                    <a id="a_nueva_sala_General" href="#"><i class='bx bx-plus'></i> Nueva Sala</a>
                </li>
                <li id="li_dashboardMain_abajo_General">
                    <a href="#"><i class='bx bx-bell'></i> Sugerencias</a>
                </li>
                <li id="li_dashboardMain_abajo_General">
                    <a href="#"><i class='bx bx-help-circle'></i> Ayuda</a>
                </li>
                <li id="li_dashboardMain_abajo_General">
                    <a href="index"><i class='bx bx-log-out'></i> Cerrar sesion</a>
                </li>
            </ul>
        </div>
    </aside>

    <main id="main_dashboardAdmin_General">
        <div id="div_dashboardAdmin_arriba_General">
            <h1>
                Panel de control Administrador General
            </h1>
            <p>
                Salas - Propietarios
            </p>
            <div class="input-con-icono">
                <input type="text" placeholder="Buscar..." id="input_busqueda">
                <i class='bx bx-search-alt-2'></i>
            </div>
        </div>
        <div id="informacion_propietarios_General">
            <h3>Propietarios de locales</h3>

            
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>
            <div class="contenedor-usuario">
                <div class="info-usuario">
                    <img src="<?php echo APP_URL; ?>app/views/fotos/img_usuario.svg" alt="Usuario" class="imagen-usuario">
                    <div class="detalles-usuario">
                        <h6>Nombre del Propietario</h6>
                        <p>Propietario</p>
                    </div>
                </div>
                <div class="ultimo-ingreso">
                    <p>Hace 2 días</p>
                </div>
            </div>  

            <!-- Añadir más "contenedor-usuario" aquí para más usuarios -->
        </div>




    </main>
</body>

</html>