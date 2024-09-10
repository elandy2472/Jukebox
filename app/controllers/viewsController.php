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
            header("Location: dashboard");
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
