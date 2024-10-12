<?php

namespace app\models;

class viewsModel
{
    protected function obtenerVistasModelo($vista)
    {
        $listaBlanca = array("dashboard", "codigosala");

        if (in_array($vista, $listaBlanca)) {
            if (is_file("./app/views/content/" . $vista . "-view.php")) {
                $contenido = "./app/views/content/" . $vista . "-view.php";
            } else {
                $contenido = "404";
            }
        } elseif ($vista == "main" || $vista == "index") {
            $contenido = "main";
        } elseif ($vista == "login") {
            $contenido = "login";
        } elseif ($vista == "register" || $vista == "registro") {
            $contenido = "register";
        } else {
            $contenido = "404";
        }

        return $contenido;
    }
}
