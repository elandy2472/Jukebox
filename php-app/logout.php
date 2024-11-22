<?php
session_start();

// Verificar si hay una sesión activa
if (isset($_SESSION['usuario'])) {
    // Eliminar todas las variables de sesión
    $_SESSION = [];

    // Destruir la sesión
    session_unset();
    session_destroy();

    // Eliminar la cookie de sesión (PHPSESSID)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
    }
}

// Redirigir al usuario a la página de inicio o login
header("Location: ./index.php");
exit();
?>

?>
