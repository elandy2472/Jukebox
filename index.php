<?php

require_once("./config/app.php");
require_once("./autoload.php");
require_once("./app/views/inc/session_start.php");


if (isset($_GET["views"])) {
    $url = explode("/", $_GET["views"]);
} else {
    $url = ["main"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body>
    <?php

    use app\controllers\viewsController;

    $viewsController = new viewsController();

    $vista = $viewsController->obtenerVistasControlador($url[0]);

    if ($vista == "main" || $vista == "index" || $vista == "login" || $vista == "404" || $vista == "register") {
        require_once("./app/views/content/" . $vista . "-view.php");
    } else {
        require_once($vista);
    }


    ?>
</body>

</html>