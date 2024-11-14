<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once '../models/UsuarioEmpresaModel.php';
require_once '../models/ContrasenaTemporalModel.php';
require_once '../libreries/PHPMailer/src/PHPMailer.php';
require_once '../libreries/PHPMailer/src/Exception.php';
require_once '../libreries/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class RecuperacionController {
    private $conexion;
    private $usuarioModel;
    private $contrasenaModel;

    public function __construct($conexion) {
        $this->conexion = $conexion;
        $this->usuarioModel = new UsuarioEmpresaModel($conexion);
        $this->contrasenaModel = new ContrasenaTemporalModel($conexion);
    }

    public function enviarCodigoRecuperacion($email) {
        
        $documento = $this->usuarioModel->verificarAdministrador($email);

        if ($documento) { 
            $codigo = rand(100000, 999999);
            $fechaExpiracion = date('Y-m-d H:i:s', strtotime('+1 hour'));

            
            if ($this->contrasenaModel->guardarCodigoTemporal($documento, $email, $codigo, $fechaExpiracion)) {
                $this->enviarCorreo($email, $codigo);
                echo "Correo enviado con el código de recuperación.";
            } else {
                echo "Error al guardar el código temporal.";
            }
        } else {
            echo "El usuario no tiene permisos de administrador.";
        }
    }

    private function enviarCorreo($email, $codigo) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.tu-servidor-smtp.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tu-email@ejemplo.com';
            $mail->Password = 'tu-contraseña';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('tu-email@ejemplo.com', 'Soporte');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Código de Recuperación de Contraseña';
            $mail->Body = "Su código de recuperación es: <b>$codigo</b>";

            $mail->send();
        } catch (Exception $e) {
            echo "Error al enviar el correo: {$mail->ErrorInfo}";
        }
    }
}
?>
