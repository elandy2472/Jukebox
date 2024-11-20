<?php
namespace app\models;

use app\models\mainModel; // Asegúrate de importar el modelo necesario

class viewsModel
{
    protected function obtenerVistasModelo($vista)
    {
        $listaBlanca = array("dashboardAdmin", "dashboardAdminGeneral", "usuarioPorAceptar", "codigosala", "crearsala", "sala");

        if (in_array($vista, $listaBlanca)) {
            if (is_file("./app/views/content/" . $vista . "-view.php")) {
                $contenido = "./app/views/content/" . $vista . "-view.php";
            } elseif (is_file("./app/controllers/" . $vista . ".html")) {
                $contenido = "./app/controllers/" . $vista . ".html";
            } else {
                $contenido = "404";
            }
        } elseif ($vista == "main" || $vista == "index") {
            $contenido = "main";
        } elseif ($vista == "login") {
            $contenido = "login";
        } elseif ($vista == "register" || $vista == "registro") {
            $contenido = "register";
        } elseif (preg_match('/^sala\/([a-zA-Z0-9]+)$/', $vista, $matches)) {
            // Captura el código de sala
            $codigoSala = $matches[1];

            // Instanciar el modelo para verificar el código de sala
            $modelo = new mainModel();

            // Verificar si el código de sala existe en la base de datos
            if ($modelo->verificarCodigoSala($codigoSala)) {
                // Guardar en sesión si es necesario
                $_SESSION['room_code'] = $codigoSala;
                // Asignar la ruta del archivo reproductor.html
                $contenido = "./app/controllers/reproductor.html"; // Carga el reproductor
            } else {
                // Si no existe el código de sala, mostrar 404
                $contenido = "404"; 
            }
        } else {
            $contenido = "404"; // Si no coincide con ninguna opción válida
        }

        return $contenido; // Retornar la ruta del contenido
    }
}

