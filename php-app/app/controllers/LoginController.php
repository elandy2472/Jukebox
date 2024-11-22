<?php
session_start(); // Para manejar la sesión de usuario

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('../../config/server.php');

// if ($conn->connect_error) {
//     die("Conexión fallida: " . $conn->connect_error);
// }

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correo = $_POST['correo'];
    print($correo);
    $contrasena = $_POST['contrasena'];
    print($contrasena);
    $stmt = $conn->prepare("SELECT correo, contrasena FROM usuarioempresa WHERE correo = ?");
    
    // Vincular parámetros
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar que la contraseña ingresada coincida con la almacenada
        if ($contrasena === $user['contrasena']) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['correo'] = $user['correo'];

            header("Location: ../views/content/admin-controles-view.php");
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "El usuario no existe";
    }
    $stmt->close();
}
?>
