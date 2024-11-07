<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../models/Usuario.php');

class RestablecerContrasenaController {
    private $usuarioModel;

    public function __construct() {
        $this->usuarioModel = new Usuario();
    }

    public function enviarEnlaceRecuperacion($email) {
        // Verificar si el email pertenece a un administrador
        if ($this->usuarioModel->esAdministrador($email)) {
            // Generar una contraseña temporal segura
            $contrasenaTemporal = bin2hex(random_bytes(8));
            $fechaExpiracion = date('Y-m-d H:i:s', strtotime('+6 minutes'));

            // Guardar la contraseña temporal en la base de datos
            $this->usuarioModel->guardarContrasenaTemporal($email, $contrasenaTemporal, $fechaExpiracion);

            // Enviar el correo electrónico con el enlace de recuperación
            $enlaceRecuperacion = "http://tusitio.com/restablecer.php?token=" . urlencode($contrasenaTemporal);
            $asunto = "Recuperación de contraseña";
            $mensaje = "Hola, usa el siguiente enlace para restablecer tu contraseña (válido por 6 minutos): $enlaceRecuperacion";
            $headers = "From: noreply@tusitio.com";

            if (mail($email, $asunto, $mensaje, $headers)) {
                echo "Enlace de recuperación enviado al correo.";
            } else {
                echo "Error al enviar el correo.";
            }
        } else {
            echo "El correo no pertenece a un administrador.";
        }
    }
}

// Manejo de solicitud POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $controller = new RestablecerContrasenaController();
    $controller->enviarEnlaceRecuperacion($email);
}
