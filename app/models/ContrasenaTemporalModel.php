<?php
class ContrasenaTemporalModel {
    private $conexion;

    public function __construct($conexion) {
        $this->conexion = $conexion;
    }

    public function guardarCodigoTemporal($usuarioId, $email, $codigo, $fechaExpiracion) {
        $query = "INSERT INTO contraseña_temporal (usuarioempresa_id, email, contraseña_temporal, fecha_solicitud, fecha_expiracion) 
                  VALUES ('$usuarioId', '$email', '$codigo', NOW(), '$fechaExpiracion')";
        return mysqli_query($this->conexion, $query);
    }
}
?>
