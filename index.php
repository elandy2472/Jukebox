<?php

require_once("./config/app.php");
require_once("./autoload.php");
require_once("./app/views/inc/session_start.php");

use app\controllers\viewsController;

$viewsController = new viewsController();

// Procesar inicio de sesión si es un formulario POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['username']) && isset($_POST['password'])) {
    $usuarioOcorreo = $_POST['username'];
    $contrasena = $_POST['password'];
    $resultado = $viewsController->iniciarSesionControlador($usuarioOcorreo, $contrasena);
    if ($resultado !== true) {
        $error = $resultado; // Puedes usar esta variable para mostrar un mensaje de error en la vista
    }
}

// Obtener la vista solicitada a través de GET
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
    // Mostrar la vista correspondiente
    if (in_array($vista, $vistasSinAuth)) {
        require_once("./app/views/content/" . $vista . "-view.php");
    } else {
        require_once($vista);
    }

    // Incluir los scripts de JavaScript al final del archivo
    require_once("./app/views/inc/script.php");
    ?>
</body>

</html>
