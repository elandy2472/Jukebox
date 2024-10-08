<?php

namespace app\controllers;

use app\models\viewsModel;


class viewsController extends viewsModel {
    public function obtenerVistasControlador($vista){
        if($vista != ""){
            $respuesta = $this->obtenerVistasModelo($vista);
        }else{
            $respuesta = "main";
        }

        return $respuesta;
    }
}
