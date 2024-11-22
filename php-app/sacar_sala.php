<?php
// Conexión a la base de datos
$host = 'localhost';
$dbname = 'nombre_base_datos';
$username = 'usuario';
$password = 'contraseña';

try {
    $pdo = new PDO(dsn: "mysql:host=$host;dbname=$dbname", username: $username, password: $password);
    $pdo->setAttribute(attribute: PDO::ATTR_ERRMODE, value: PDO::ERRMODE_EXCEPTION); 
} catch (PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Función para eliminar a un usuario de una sala
function eliminarUsuarioDeSala($session_id, $room_code): string {
    global $pdo;

    // Obtener el ID de la sala usando el room_code
    $sql = "SELECT id FROM rooms WHERE room_code = :room_code";
    $stmt = $pdo->prepare(query: $sql);
    $stmt->bindParam(param: ':room_code', var: $room_code);
    $stmt->execute();

    // Verificar si la sala existe
    $room = $stmt->fetch(mode: PDO::FETCH_ASSOC);
    if (!$room) {
        return "Sala no encontrada.";
    }

    $room_id = $room['id'];

    // Eliminar al usuario de la sala usando su session_id
    $sql = "DELETE FROM room_users WHERE session_id = :session_id AND room_id = :room_id";
    $stmt = $pdo->prepare(query: $sql);
    $stmt->bindParam(param: ':session_id', var: $session_id);
    $stmt->bindParam(param: ':room_id', var: $room_id);

    if ($stmt->execute()) {
        return "Usuario eliminado de la sala correctamente.";
    } else {
        return "Error al eliminar al usuario de la sala.";
    }
}