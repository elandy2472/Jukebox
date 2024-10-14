<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favoritas Canciones</title>
    <link rel="stylesheet" href="style_favsong.css">
</head>
<body>
    <div class="container">
        <h1>Tus canciones favoritas</h1>
        <form action="save_songs.php" method="POST">
            <div class="song-list">
                <?php
                include 'api.php';

                // Verifica si se obtuvieron canciones
                if (isset($songs['items']) && !empty($songs['items'])) {
                    foreach ($songs['items'] as $item) {
                        $name = htmlspecialchars($item['snippet']['title']);
                        $artist = htmlspecialchars($item['snippet']['channelTitle']); // Cambiado para obtener el artista

                        echo '
                        <div class="song-item">
                            <input type="checkbox" name="songs[]" value="' . $name . '|' . $artist . '">
                            <label>' . $name . ' - ' . $artist . '</label>
                        </div>
                        ';
                    }
                } else {
                    // Manejo de error si no hay canciones
                    echo "<p>No se pudieron obtener las canciones o no se encontraron resultados.</p>";
                }
                ?>
            </div>
            <button type="submit" class="save-btn">Guardar canciones favoritas</button>
        </form>
    </div>
</body>
</html>
