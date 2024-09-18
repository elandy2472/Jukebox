<?php

namespace app\controllers;

use app\models\viewsModel;
use app\models\mainModel;

class viewsController extends viewsModel {
    public function obtenerVistasControlador($vista){
        if($vista != ""){
            $respuesta = $this->obtenerVistasModelo($vista);
        }else{
            $respuesta = "main";
        }

        return $respuesta;
    }
    public function iniciarSesionControlador($usuarioOcorreo, $contrasena) {
        $modelo = new mainModel();
        // Validar las credenciales del usuario
        $resultado = $modelo->validarCredenciales($usuarioOcorreo, $contrasena);
    
        if ($resultado) {
            // Iniciar la sesión
            session_start();
            
            // Almacenar el usuario en la sesión
            $_SESSION['usuario'] = $usuarioOcorreo;
    
            // Consulta para obtener el NIT basado en el usuario o correo
            $nit = $modelo->obtenerNITPorUsuarioOCorreo($usuarioOcorreo);
    
            if ($nit) {
                // Guardar el NIT en la sesión
                $_SESSION['nit'] = $nit;
                header("Location: dashboard");
            } else {
                return "No se encontró el NIT del usuario";
            }
        } else {
            return "Credenciales incorrectas";
        }
    }
    

    public function verificarSesion() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start(); 
        }
    
        if (!isset($_SESSION["usuario"])) {
            header("Location: index.php?views=login");
            exit();
        }
    }
}
