<?php
$servidor = "localhost";
$usuario_db = "root";
$contrasena_db = "password";
$base_datos = "jukebox";

$conexion = new mysqli($servidor, $usuario_db, $contrasena_db, $base_datos);

if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}

function puedeEnlistarCancion($idCliente) {
    global $conexion;

    $sql = "SELECT ultima_enlistada FROM listareproduccion WHERE idCliente = ? ORDER BY ultima_enlistada DESC LIMIT 1";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("i", $idCliente);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    if ($fila) {
        $ultimaEnlistada = strtotime($fila['ultima_enlistada']);
        $tiempoActual = time();
        
        if (($tiempoActual - $ultimaEnlistada) >= 600) {
            return true;
        } else {
            return false;
        }
    } else {
        return true;
    }
}

function enlistarCancion($idCliente, $cancion, $genero, $artista, $duracion, $idSala) {
    global $conexion;
    
    $sql = "INSERT INTO listareproduccion (cancion, genero, artista, duracion, idCliente, idSala, ultima_enlistada) VALUES (?, ?, ?, ?, ?, ?, NOW())";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("ssssii", $cancion, $genero, $artista, $duracion, $idCliente, $idSala);
    return $stmt->execute();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idCliente = $_POST['idCliente'];
    $idSala = $_POST['idSala'];
    $cancion = $_POST['cancion'];
    $genero = $_POST['genero'];
    $artista = $_POST['artista'];
    $duracion = $_POST['duracion'];

    if (puedeEnlistarCancion($idCliente)) {
        if (enlistarCancion($idCliente, $cancion, $genero, $artista, $duracion, $idSala)) {
            echo "Canción enlistada exitosamente.";
        } else {
            echo "Error al enlistar la canción.";
        }
    } else {
        echo "Debe esperar 10 minutos antes de enlistar otra canción.";
    }
}
?>
