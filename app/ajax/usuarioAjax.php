<?php

require_once "../../config/app.php";
require_once "../views/inc/session_start.php";
require_once "../../autoload.php";

use app\controllers\userController;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
		$instanciaUsuario = new userController();
			
		echo $instanciaUsuario->registrarUsuarioControlador();
}
