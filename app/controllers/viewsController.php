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
        
        $resultado = $modelo->validarCredenciales($usuarioOcorreo, $contrasena);
    
        if ($resultado) {
            session_start();
            
            $_SESSION['usuario'] = $usuarioOcorreo;
            
            $_SESSION['ultimo_acceso'] = time();
    
            $nit = $modelo->obtenerNITPorUsuarioOCorreo($usuarioOcorreo);
            $documento = $modelo->obtenerDocumentoPorUsuarioOCorreo($usuarioOcorreo);
    
            if ($nit && $documento) {
                $_SESSION['nit'] = $nit;
                $_SESSION['documento'] = $documento;
    
                header("Location: dashboardAdmin");
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
            header("Location: ../login");
            exit();
        }
    }
}
