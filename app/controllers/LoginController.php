<?php
session_start(); // Para manejar la sesión de usuario

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ('../../config/server.php');

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si el método de la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $correo = $_POST['correo'];
    $contrasena = $_POST['contrasena'];

    // Usar consultas preparadas para evitar inyecciones SQL
    $stmt = $conn->prepare("SELECT correo, contrasena FROM usuarioempresa WHERE correo = ?");
    
    // Vincular parámetros
    $stmt->bind_param("s", $correo);
    $stmt->execute();
    
    // Obtener el resultado
    $result = $stmt->get_result();

    // Verificar si el usuario existe
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verificar que la contraseña ingresada coincida con la almacenada
        if ($contrasena === $user['contrasena']) {
            // Iniciar sesión y guardar datos del usuario en la sesión
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['correo'] = $user['correo'];
            
            // Redirigir al usuario al dashboard
            header("Location: ../views/content/admin-controles-view.php");
            exit(); // Detener el script después de redirigir
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "El usuario no existe";
    }

    // Cerrar el statement
    $stmt->close();
}
?>
