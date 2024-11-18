<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jukebox";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Error de conexión']));
}

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data['idSala'])) {
    echo json_encode(['success' => false, 'message' => 'ID de sala no proporcionado']);
    exit;
}

$idSala = $data['idSala'];

$stmt = $conn->prepare("DELETE FROM sala WHERE idSala = ?");
$stmt->bind_param("i", $idSala);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Error al eliminar la sala']);
}

$stmt->close();
$conn->close();
?>
