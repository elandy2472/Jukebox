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
                
                if ($songs) {
                    foreach ($songs as $song) {
                        echo '
                        <div class="song-item">
                            <input type="checkbox" name="songs[]" value="' . htmlspecialchars($song['name']) . '|' . htmlspecialchars($song['artist']) . '">
                            <label>' . htmlspecialchars($song['name']) . ' - ' . htmlspecialchars($song['artist']) . '</label>
                        </div>
                        ';
                    }
                } else {
                    echo "<p>No se pudieron obtener las canciones.</p>";
                }
                ?>
            </div>
            <button type="submit" class="save-btn">Guardar canciones favoritas</button>
        </form>
    </div>
</body>
</html>
