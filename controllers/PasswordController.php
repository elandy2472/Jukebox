<?php
require_once '../models/PasswordModel.php';

class PasswordController {
    private $passwordModel;

    public function __construct() {
        $this->passwordModel = new PasswordModel();
    }

    public function updatePassword() {
        $documento = $_POST['documento'] ?? '';
        $currentPassword = $_POST['currentPassword'] ?? '';
        $newPassword = $_POST['newPassword'] ?? '';
        $confirmPassword = $_POST['confirmPassword'] ?? '';

        if (empty($documento) || empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $this->sendResponse("error", "Todos los campos son obligatorios.");
            return;
        }

        if (!$this->passwordModel->verifyCurrentPassword($documento, $currentPassword)) {
            $this->sendResponse("error", "La contraseña actual es incorrecta.");
            return;
        }

        if ($newPassword !== $confirmPassword) {
            $this->sendResponse("error", "La nueva contraseña y la confirmación no coinciden.");
            return;
        }

        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $newPassword)) {
            $this->sendResponse("error", "La nueva contraseña no cumple con los requisitos de seguridad.");
            return;
        }

        if ($this->passwordModel->updatePassword($documento, $newPassword)) {
            $this->sendResponse("success", "Contraseña actualizada con éxito.");
        } else {
            $this->sendResponse("error", "Error al actualizar la contraseña.");
        }
    }

    private function sendResponse($status, $message) {
        echo json_encode(["status" => $status, "message" => $message]);
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $controller = new PasswordController();
    $controller->updatePassword();
}
?>
