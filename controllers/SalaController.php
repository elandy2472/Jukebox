<?php
namespace app\controllers;

use app\models\mainModel;

class SalaController
{
    public function ingresarSala()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nickname = $_POST['nickname'] ?? '';
            $codigoSala = $_POST['codigo'] ?? '';

            // Validar que el código no esté vacío
            if (empty($codigoSala) || strlen($codigoSala) < 6) {
                echo "El código de la sala es inválido.";
                return;
            }

            // Instanciar el modelo
            $modelo = new mainModel();

            // Guardar el cliente en la base de datos
            if (!$modelo->guardarCliente($nickname)) {
                echo "Error al guardar el cliente.";
                header("Location: /Jukebox");
                exit();
            }

            // Verificar si el código de sala existe
            if ($modelo->verificarCodigoSala($codigoSala)) {
                // Guardar en sesión el código de sala y el nickname
                $_SESSION['room_code'] = $codigoSala;
                $_SESSION['nickname'] = $nickname;

                // Redirigir al usuario a la sala
                header("Location: /Jukebox/sala/" . $codigoSala);
                exit();
            } else {
                // Si el código no existe, redirigir al inicio
                header("Location: /Jukebox");
                exit();
            }
        }
    }

}
