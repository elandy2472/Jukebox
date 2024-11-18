<?php
require_once('app/controllers/control_inactividad.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jukebox";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Validación de las variables de sesión 'documento' y 'nit'
$documento = isset($_SESSION['documento']) ? $_SESSION['documento'] : null;
$nit = isset($_SESSION['nit']) ? $_SESSION['nit'] : ''; 

// Declaramos arreglos para almacenar datos
$salas = [];
$datosNit = []; // Este arreglo puede ser utilizado para otras funcionalidades relacionadas al NIT

// Si el documento está disponible, obtenemos las salas
if ($documento) {
    $stmt = $conn->prepare("SELECT idSala, nombreSala, codigoSala, aforoFinalSala FROM sala WHERE documento = ?");
    $stmt->bind_param("s", $documento);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $salas[] = $row;
    }
    $stmt->close();
}

// Si el NIT está disponible, podemos realizar consultas adicionales relacionadas
if (!empty($nit)) {
    // Ejemplo: Consulta asociada al NIT (modifica según tus necesidades)
    $stmtNit = $conn->prepare("SELECT nombre FROM empresa WHERE nit = ?");
    $stmtNit->bind_param("s", $nit);
    $stmtNit->execute();
    $resultNit = $stmtNit->get_result();

    while ($rowNit = $resultNit->fetch_assoc()) {
        $datosNit[] = $rowNit;
    }
    $stmtNit->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    require_once("./app/views/inc/head.php");
    ?>
</head>
<style>
    #tbody_dashboard_Main > tr > td {
        text-align: center;
    }
</style>

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
                <form id="formActualizarEmpresa" method="post" action="http://localhost/jukebox/app/views/content/actualizar-view.php">
                    <input type="hidden" name="documento" value="<?php echo htmlspecialchars($documento, ENT_QUOTES, 'UTF-8'); ?>">
                    <input type="hidden" name="nit" value="<?php echo htmlspecialchars($nit, ENT_QUOTES, 'UTF-8'); ?>">
                </form>
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
                    <a href="./logout.php"><i class='bx bx-log-out'></i>Cerrar sesión</a>
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
                    Organización de tus salas y usuarios
                </p>
            </div>
            <div id="contenedor_cajas_informacion">
                <div id="salas_activas">
                    <h4>Salas activas</h4>
                    <p><?php echo count($salas); ?></p>
                </div>

                <div id="usuarios_activos">
                    <h4>Usuarios activos</h4>
                    <p>400</p>
                </div>
            </div>
        </div>
        <div id="div_table">
            <table id="table_salas">
                <thead id="thead_dashboard_Main">
                    <tr>
                        <th>Sala</th>
                        <th>Miembros</th>
                        <th>Codigo Sala</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_dashboard_Main">
                    <?php if (count($salas) > 0): ?>
                        <?php foreach ($salas as $sala): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($sala['nombreSala'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($sala['aforoFinalSala'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td><?php echo htmlspecialchars($sala['codigoSala'], ENT_QUOTES, 'UTF-8'); ?></td>
                                <td>
                                    <button class="btn eliminar" data-id="<?php echo $sala['idSala']; ?>">Eliminar</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4">No hay salas disponibles.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const botonesEliminar = document.querySelectorAll('.btn.eliminar');

            botonesEliminar.forEach(boton => {
                boton.addEventListener('click', function () {
                    if (!confirm("¿Estás seguro de que deseas eliminar esta sala?")) return;

                    const idSala = this.getAttribute('data-id');

                    fetch('./app/controllers/eliminar_sala.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({ idSala: idSala })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const fila = this.closest('tr');
                                fila.remove();
                                alert("Sala eliminada con éxito.");
                            } else {
                                alert("Error al eliminar la sala: " + data.message);
                            }
                        })
                        .catch(error => {
                            console.error("Error:", error);
                            alert("Hubo un problema al intentar eliminar la sala.");
                        });
                });
            });
        });
    </script>
</body>

</html>
