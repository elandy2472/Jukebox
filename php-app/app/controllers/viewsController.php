<?php

namespace app\controllers;

use app\models\viewsModel;
use app\models\mainModel;

class viewsController extends viewsModel {
    public function obtenerVistasControlador($vista) {
        // Validación directa para retornar vista
        return $vista !== "" ? $this->obtenerVistasModelo($vista) : "main";
    }

    public function iniciarSesionControlador($usuarioOcorreo, $contrasena) {
        // Verificar si ya hay una sesión activa antes de iniciarla
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $modelo = new mainModel();
        $resultado = $modelo->validarCredenciales($usuarioOcorreo, $contrasena);

        if ($resultado) {
            // Guardar usuario en la sesión
            $_SESSION['usuario'] = $resultado;
            $_SESSION['ultimo_acceso'] = time();

            // Obtener datos adicionales (NIT y documento)
            $nit = $modelo->obtenerNITPorUsuarioOCorreo($usuarioOcorreo);
            $documento = $modelo->obtenerDocumentoPorUsuarioOCorreo($usuarioOcorreo);

            if ($nit && $documento) {
                // Guardar datos adicionales en la sesión
                $_SESSION['nit'] = $nit;
                $_SESSION['documento'] = $documento;

                // Redirigir al panel de administración
                header("Location: dashboardAdmin");
                exit();
            } else {
                // Si no se encuentra el NIT o el documento, redirigir con error
                header("Location: ../login?error=no_nit");
                exit();
            }
        } else {
            // Si las credenciales no son válidas, redirigir con error
            header("Location: ../login?error=credenciales");
            exit();
        }
    }

    public function verificarSesion() {
        // Verificar si la sesión no está iniciada
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Si no hay un usuario en la sesión, redirigir al login
        if (!isset($_SESSION["usuario"])) {
            header("Location: ../login");
            exit();
        }
    }
}
