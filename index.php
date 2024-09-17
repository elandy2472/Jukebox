<?php
require_once("./config/app.php");
require_once("./autoload.php");
require_once("./app/views/inc/session_start.php");

use app\controllers\viewsController;

$viewsController = new viewsController();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    // Procesar el inicio de sesión
    $usuarioOcorreo = $_POST['username'];
    $contrasena = $_POST['password'];
    $resultado = $viewsController->iniciarSesionControlador($usuarioOcorreo, $contrasena);
    if ($resultado !== true) {
        $error = $resultado;
    }
}

if (isset($_GET["views"])) {
    $url = explode("/", $_GET["views"]);
} else {
    $url = ["main"];
}

$vista = $viewsController->obtenerVistasControlador($url[0]);

// Lista de vistas que no requieren autenticación
$vistasSinAuth = ["main", "index", "login", "404", "register"];

// Si la vista no está en la lista, verificamos la sesión
if (!in_array($vista, $vistasSinAuth)) {
    $viewsController->verificarSesion();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body>
    <?php
    // Aquí no necesitas repetir el código de $viewsController o de obtener vistas,
    // ya lo has hecho anteriormente.
    
    if (in_array($vista, $vistasSinAuth)) {
        require_once("./app/views/content/" . $vista . "-view.php");
    } else {
        require_once($vista);
    }
    ?>
</body>

</html>
