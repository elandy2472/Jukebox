<?php
class UsuarioEmpresaModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function verificarAdministrador($email) {
        $query = "SELECT documento, correo FROM usuarioempresa WHERE correo = '$email' LIMIT 1";
        $resultado = mysqli_query($this->conexion, $query);

        if ($resultado && mysqli_num_rows($resultado) > 0) {
            $usuario = mysqli_fetch_assoc($resultado);
            // Asume que 'ADMIN' en 'documento' indica que es administrador
            if ($usuario['documento'] === 'ADMIN') {
                return $usuario['documento']; // Retorna el documento del usuario
            }
        }
        return false; // Retorna false si no es administrador
    }
}
?>
