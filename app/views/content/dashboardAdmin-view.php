<?php
require_once('app/controllers/control_inactividad.php'); 

if (isset($_SESSION['nit'])) {
    $nit = $_SESSION['nit']; // Obtenemos el NIT almacenado en la sesión
} else {
    $nit = ''; // En caso de que el NIT no esté disponible, manejamos este caso
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("./app/views/inc/head.php");
    ?>
</head>

<body id="body_dashboardAdmin">
    <aside id="aside_dashboardAdmin">
        <div id="contenedor_titulo_y_opciones_arriba">
            <div id="titulo_panel_control">
                <h1><i class='bx bx-user-circle'></i> Pepito Perez</h1>
            </div>
            <ul id="opciones_arriba">
                <li id="li_dashboardAdmin">
                    <a id="a_dashboardAdmin" href="#"><i class='bx bxs-home'></i> Principal</a>
                </li>
                <li id="li_dashboardAdmin">
                    <a id="a_dashboardAdmin" href="#"><i class='bx bx-news'></i> Salas</a>
                </li>
                <li id="li_dashboardAdmin">
                    <a id="a_dashboardAdmin" href="#"> <i class='bx bxs-user'></i> Usuarios</a>
                </li>
                <!-- Formulario con el método GET y la URL de destino -->
                <form id="formActualizarEmpresa" method="post" action="http://localhost/jukebox/app/views/content/actualizar-view.php">
                    <!-- Incluimos el NIT en un campo hidden -->
                    <input type="hidden" name="nit" value="<?php echo htmlspecialchars($nit, ENT_QUOTES, 'UTF-8'); ?>">
                </form>

                <!-- Enlace que actúa como botón para enviar el formulario -->
                <li id="li_dashboardAdmin">
                    <a id="a_dashboardAdmin" href="#" onclick="document.getElementById('formActualizarEmpresa').submit();">
                        <i class='bx bxs-cog'></i> Configuración
                    </a>
                </li>

            </ul>
        </div>


        <div id="contenedor_titulo_y_opciones_abajo">
            <ul id="opciones_abajo">
                <li id="li_dashboardMain_abajo">
                    <a id="a_nueva_sala" href="crearsala"><i class='bx bx-plus'></i> Nueva Sala</a>
                </li>
                <li id="li_dashboardMain_abajo">
                    <a href="#"><i class='bx bx-bell'></i> Sugerencias</a>
                </li>
                <li id="li_dashboardMain_abajo">
                    <a href="#"><i class='bx bx-help-circle'></i> Ayuda</a>
                </li>
                <li id="li_dashboardMain_abajo">
                    <a href="<?php echo APP_URL;?>logout.php"><i class='bx bx-log-out'></i>Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </aside>

    <main id="main_dashboardAdmin">
        <div id="div_dashboardAdmin_arriba">
            <div id="contenedor_titulo">
                <h1>
                    Panel de control
                </h1>
                <p>
                    Organizacion de tus salas y usuarios
                </p>
            </div>
            <div id="contenedor_cajas_informacion">
                <div id="salas_activas">
                    <h4>
                        Salas activas
                    </h4>
                    <p>
                        200
                    </p>
                </div>

                <div id="usuarios_activos">
                    <h4>
                        Usuarios activos
                    </h4>
                    <p>
                        400
                    </p>
                </div>
            </div>
        </div>
        <div id="div_table">
            <table id="table_salas">
                <thead id="thead_dashboard_Main">
                    <tr>
                        <th>Sala</th>
                        <th>Miembros</th>
                        <th>Inicio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_dashboard_Main">
                    <tr>
                        <td>Sala 1</td>
                        <td>10 Miembros</td>
                        <td>2024-09-01</td>
                        <td>
                            <button class="btn ver">Ver</button>
                            <button class="btn editar">Editar</button>
                            <button class="btn eliminar">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td>15 Miembros</td>
                        <td>2024-09-02</td>
                        <td>
                            <button class="btn ver">Ver</button>
                            <button class="btn editar">Editar</button>
                            <button class="btn eliminar">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td>15 Miembros</td>
                        <td>2024-09-02</td>
                        <td>
                            <button class="btn ver">Ver</button>
                            <button class="btn editar">Editar</button>
                            <button class="btn eliminar">Eliminar</button>
                        </td>
                    </tr>
                    <tr>
                        <td>Sala 2</td>
                        <td>15 Miembros</td>
                        <td>2024-09-02</td>
                        <td>
                            <button class="btn ver">Ver</button>
                            <button class="btn editar">Editar</button>
                            <button class="btn eliminar">Eliminar</button>
                        </td>
                    </tr>

                    <!-- Más filas si es necesario -->
                </tbody>
            </table>
        </div>


    </main>
</body>

</html>