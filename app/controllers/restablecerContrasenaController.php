<?php
require_once '../models/Usuario.php';

class RestablecerContrasenaController {
    public function enviarEnlaceRecuperacion() {
        // Verificar que se haya enviado el email a través del formulario
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            $usuarioModel = new Usuario();

            // Verificar si el email pertenece a un administrador
            if ($usuarioModel->esAdministrador($email)) {
                // Generar una contraseña temporal
                $contrasenaTemporal = bin2hex(random_bytes(4)); // 8 caracteres hexadecimales
                $usuarioModel->guardarContrasenaTemporal($email, $contrasenaTemporal);
                
                // Enviar el enlace de recuperación por correo
                $this->enviarCorreoRecuperacion($email, $contrasenaTemporal);
                echo "Se ha enviado un enlace de recuperación a su correo electrónico.";
            } else {
                echo "El correo proporcionado no pertenece a un administrador.";
            }
        } else {
            echo "Por favor, ingrese un correo electrónico.";
        }
    }

    private function enviarCorreoRecuperacion($email, $contrasenaTemporal) {
        $asunto = "Recuperación de Contraseña - Contraseña Temporal";
        $mensaje = "Su contraseña temporal es: $contrasenaTemporal. Esta contraseña expirará en 6 minutos.";
        $cabeceras = 'From: no-reply@tu-sitio.com' . "\r\n" .
                     'Reply-To: soporte@tu-sitio.com' . "\r\n" .
                     'X-Mailer: PHP/' . phpversion();

        mail($email, $asunto, $mensaje, $cabeceras);
    }
}

// Instancia del controlador y llamada al método para enviar el enlace de recuperación
$controlador = new RestablecerContrasenaController();
$controlador->enviarEnlaceRecuperacion();
