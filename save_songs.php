<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "music_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if (isset($_POST['songs'])) {
    $songs = $_POST['songs'];

    foreach ($songs as $song) {
        list($name, $artist) = explode('|', $song);

        $stmt = $conn->prepare("INSERT INTO favorite_songs (name, artist) VALUES (?, ?)");
        $stmt->bind_param("ss", $name, $artist);

        if ($stmt->execute()) {
            echo "Canción guardada: $name de $artist<br>";
        } else {
            echo "Error al guardar la canción: " . $conn->error;
        }

        $stmt->close();
    }
} else {
    echo "No se seleccionaron canciones.";
}

$conn->close();
?>
