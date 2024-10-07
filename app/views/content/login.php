<?php
session_start();
require_once '../../models/mainModel.php'; // Asegúrate de incluir el modelo

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $contrasena = trim($_POST['contrasena']);

    if (!empty($usuario) && !empty($contrasena)) {
        $modelo = new \app\models\mainModel();

        // Consultar la base de datos para obtener el usuario
        $sql = $modelo->seleccionDatos('Unico', 'usuarioempresa', 'usuario', $usuario);
        $datosUsuario = $sql->fetch(PDO::FETCH_ASSOC);
        if ($datosUsuario) {
            // Verificar la contraseña
            if ($datosUsuario['contrasena'] === $_POST['contrasena']) {
                // La contraseña es correcta
                $_SESSION['usuario'] = $datosUsuario['usuario'];
                $_SESSION['documento'] = $datosUsuario['documento'];
                header("Location: crearsala");
                exit;
            } else {
                // Contraseña incorrecta
                $error = "Contraseña incorrecta.";
            }
        } else {
            $error = "Usuario no encontrado.";
        }
    } else {
        $error = "Por favor, completa todos los campos.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - Jukebox Pro</title>
    <style>
        /* Estilos sencillos */
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            color: white;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        form {
            background-color: #333;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);
        }
        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #444;
            border-radius: 5px;
            background-color: #222;
            color: white;
        }
        button {
            padding: 10px;
            background-color: #1a73e8;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #1557b0;
        }
        .error {
            color: #ff4444;
        }
    </style>
</head>
<body>
    <form method="POST">
        <h2>Iniciar Sesión</h2>
        <?php if ($error): ?>
            <p class="error"><?php echo htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <input type="text" name="usuario" placeholder="Usuario" required>
        <input type="password" name="contrasena" placeholder="Contraseña" required>
        <button type="submit">Iniciar Sesión</button>
    </form>
</body>
</html>
