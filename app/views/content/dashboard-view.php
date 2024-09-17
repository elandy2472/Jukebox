Dash
<?php
// No es necesario iniciar sesión de nuevo si ya está iniciada en otro lado
// Solo verificamos si la sesión contiene el NIT
if (isset($_SESSION['nit'])) {
    $nit = $_SESSION['nit']; // Obtenemos el NIT almacenado en la sesión
} else {
    $nit = ''; // En caso de que el NIT no esté disponible, manejamos este caso
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href=".\app\views\css\style-login.css">
    <?php require_once("./app/views/inc/head.php"); ?>
</head>

<body>
    <?php require_once("./app/views/inc/nav2bar.php") ?>

    <main>
        <div class="login-container">
            <!-- Botón de Cerrar Sesión -->
            <form method="POST" action="./logout.php">
                <button type="submit">Cerrar Sesión</button>
            </form>
            <form method="GET" action="http://localhost/jukebox/app/views/content/actualizar_empresa.php">
                <!-- Incluimos el NIT en un campo hidden -->
                <input type="hidden" name="nit" value="<?php echo htmlspecialchars($nit, ENT_QUOTES, 'UTF-8'); ?>">
                <button type="submit">Actualizar Datos</button>
            </form>
        </div>
    </main>
    
</body>
</html>
