<?php
require_once ('../../config/server.php');

if (!extension_loaded('pdo_mysql')) {
    echo "PDO MySQL no está habilitado!";
} else {
    echo "PDO MySQL está habilitado.";
}

class Usuario {
    private $db;

    public function __construct() {
        try {
            // crear el dns de conexión usando las constantes definidas
            $this->db = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Para manejar errores de conexión
        } catch (PDOException $e) {
            // mostrar un mensaje de error si la conexión falla
            echo "Error en la conexión: " . $e->getMessage();
        }
    }

    public function esAdministrador($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarioempresa WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();
        return $usuario && $usuario['rol'] === 'administrador';
    }

    public function guardarContrasenaTemporal($email, $contrasenaTemporal, $fechaExpiracion) {
        $fechaSolicitud = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("
            INSERT INTO envio_contraseña_temporal (email, contraseña_temporal, fecha_solicitud, fecha_expiracion)
            VALUES (:email, :contrasena, :fecha_solicitud, :fecha_expiracion)
        ");
        $stmt->execute([
            'email' => $email,
            'contrasena' => $contrasenaTemporal,
            'fecha_solicitud' => $fechaSolicitud,
            'fecha_expiracion' => $fechaExpiracion
        ]);
    }
}

