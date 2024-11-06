<?php
require_once ('../../config/server.php');

class Usuario {
    private $db;

    public function __construct() {
        $this->db = new PDO(DB_SERVER, DB_USER, DB_PASS);
    }

    // Verifica si el email pertenece a un administrador
    public function esAdministrador($email) {
        $stmt = $this->db->prepare("SELECT rol FROM usuarioempresa WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $usuario = $stmt->fetch();
        return $usuario && $usuario['rol'] === 'administrador';
    }

    // Guarda la contraseña temporal en la base de datos
    public function guardarContrasenaTemporal($email, $contrasenaTemporal) {
        $fechaHora = date('Y-m-d H:i:s');
        $stmt = $this->db->prepare("UPDATE usuarios SET contrasena_temporal = :contrasena, fecha_temporal = :fecha WHERE email = :email");
        $stmt->execute([
            'contrasena' => $contrasenaTemporal,
            'fecha' => $fechaHora,
            'email' => $email
        ]);
    }
}
