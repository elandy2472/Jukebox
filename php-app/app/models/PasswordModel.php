<?php
/* class PasswordModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=jukebox', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function verifyCurrentPassword($documento, $currentPassword) {
        $stmt = $this->db->prepare("SELECT contrasena FROM usuarioempresa WHERE documento = :documento");
        $stmt->bindParam(':documento', $documento);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            return false;
        }

        return password_verify($currentPassword, $result['contrasena']);
    }

    public function updatePassword($documento, $newPassword) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $fechaCambio = date("Y-m-d");

        $stmt = $this->db->prepare("UPDATE usuarioempresa SET contrasena = :newPassword, fechaUltimoCambio = :fechaCambio WHERE documento = :documento");
        $stmt->bindParam(':newPassword', $newPasswordHash);
        $stmt->bindParam(':fechaCambio', $fechaCambio);
        $stmt->bindParam(':documento', $documento);

        return $stmt->execute();
    }

    public function getFechaUltimoCambio($documento) {
        $stmt = $this->db->prepare("SELECT fechaUltimoCambio FROM usuarioempresa WHERE documento = :documento");
        $stmt->bindParam(':documento', $documento);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['fechaUltimoCambio'] ?? null;
    }
}
 */
class PasswordModel {
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=mysql;dbname=jukebox', 'user', 'password');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            exit();
        }
    }

    public function verifyCurrentPassword($documento, $currentPassword) {
        $stmt = $this->db->prepare("SELECT contrasena FROM usuarioempresa WHERE documento = :documento");
        $stmt->bindParam(':documento', $documento);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result && password_verify($currentPassword, $result['contrasena']);
    }

    public function canChangePassword($documento) {
        $stmt = $this->db->prepare("SELECT ultima_actualizacion_contrasena FROM usuarioempresa WHERE documento = :documento");
        $stmt->bindParam(':documento', $documento);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result['ultima_actualizacion_contrasena']) {
            $ultimaActualizacion = new DateTime($result['ultima_actualizacion_contrasena']);
            $hoy = new DateTime();
            $diasTranscurridos = $hoy->diff($ultimaActualizacion)->days;
            return $diasTranscurridos >= 7;
        }

        return true; // Permitir cambio si no hay registro previo
    }

    public function updatePassword($documento, $newPassword) {
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("UPDATE usuarioempresa SET contrasena = :newPassword, ultima_actualizacion_contrasena = CURDATE() WHERE documento = :documento");
        $stmt->bindParam(':newPassword', $newPasswordHash);
        $stmt->bindParam(':documento', $documento);

        return $stmt->execute();
    }
}

