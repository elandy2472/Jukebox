<?php
// Obtener canciones de Deezer 
function obtenerCancionesDeezer()
{
    $url = "https://api.deezer.com/chart/0/tracks";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

$canciones = obtenerCancionesDeezer();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reproductor de Canciones Populares</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0c0f25;
            color: #ffffff;
            font-family: 'Arial', sans-serif;
        }

        .container {
            max-width: 1200px;
            margin-top: 50px;
        }

        h2 {
            color: #ffc107;
            font-size: 2.5rem;
            text-align: center;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .search-bar {
            background-color: #2e2f47;
            border: none;
            color: #ffffff;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 30px;

            &:focus {
                background: #2a2d49;
                color: wheat;
            }
        }

        .search-bar::placeholder {
            color: #cccccc;
        }

        .song-card {
            background-color: #1c1f35;
            border-radius: 15px;
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #333754;
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.5);
        }

        .song-card:hover {
            transform: translateY(-10px);
            background-color: #2a2d49;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.8);
        }

        .song-card img {
            width: 100%;
            height: auto;
            border-radius: 12px;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            color: #ffffff;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-text {
            font-size: 1rem;
            color: #b0b2c7;
            margin-bottom: 15px;
        }

        .song-controls {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .song-controls button {
            background-color: transparent;
            border: none;
            color: #ffc107;
            font-size: 1.5rem;
            transition: color 0.3s ease;
        }

        .song-controls button:hover {
            color: #ffdd57;
        }

        .btn-enlistar {
            background-color: #28a745;
            color: white;
            font-weight: bold;
            width: 100%;
            padding: 10px;
            margin-top: 15px;
            transition: background-color 0.3s ease;
            border-radius: 10px;
        }

        .btn-enlistar:hover {
            background-color: #218838;
        }

        .btn-enlistar:hover {
            background-color: #33b74d;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        }

        .search-bar:focus {
            outline: none;
            box-shadow: 0 0 8px rgba(255, 255, 255, 0.3);
        }

        @media (max-width: 768px) {
            .song-card {
                margin-bottom: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Canciones Populares</h2>

        <div class="row">
            <div class="col-md-12">
                <input type="text" id="search-bar" class="form-control search-bar" placeholder="Buscar canciones por nombre...">
            </div>
        </div>

        <div class="row" id="song-list">
            <?php if (isset($canciones['data'])): ?>
                <?php foreach ($canciones['data'] as $cancion): ?>
                    <div class="col-md-4 song-card" data-title="<?php echo strtolower($cancion['title']); ?>">
                        <img src="<?php echo $cancion['album']['cover_medium']; ?>" alt="<?php echo $cancion['title']; ?> carátula" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $cancion['title']; ?></h5>
                            <p class="card-text"><?php echo $cancion['artist']['name']; ?></p>
                            <div class="song-controls">
                                <button onclick="rewindSong(this)" data-preview="<?php echo $cancion['preview']; ?>"><i class="bi bi-skip-backward-fill"></i></button>
                                <button class="btn-play-pause" data-preview="<?php echo $cancion['preview']; ?>" onclick="togglePlayPause(this)">
                                    <i class="bi bi-play-circle-fill"></i>
                                </button>
                                <button onclick="forwardSong(this)" data-preview="<?php echo $cancion['preview']; ?>"><i class="bi bi-skip-forward-fill"></i></button>
                            </div>
                            <form method="POST" action="../../controllers/enlistarCancionController.php">
                                <input type="hidden" name="cancion" value="<?php echo $cancion['title']; ?>">
                                <input type="hidden" name="artista" value="<?php echo $cancion['artist']['name']; ?>">
                                <input type="hidden" name="genero" value="<?php echo $cancion['album']['title']; ?>">
                                <input type="hidden" name="duracion" value="03:00">
                                <input type="hidden" name="idCliente" value="1">
                                <input type="hidden" name="idSala" value="1">
                                <button type="submit" class="btn btn-enlistar">Enlistar</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No se pudieron cargar las canciones.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        let currentAudio = null;
        let isPlaying = false;

        //  reproducir/pausar 
        function togglePlayPause(button) {
            const previewUrl = button.getAttribute('data-preview');

            if (!currentAudio) {
                currentAudio = new Audio(previewUrl);
            } else if (currentAudio.src !== previewUrl) {
                currentAudio.pause();
                currentAudio = new Audio(previewUrl);
            }

            if (isPlaying) {
                currentAudio.pause();
                button.innerHTML = '<i class="bi bi-play-circle-fill"></i>';
            } else {
                currentAudio.play();
                button.innerHTML = '<i class="bi bi-pause-circle-fill"></i>';
            }

            isPlaying = !isPlaying;

            currentAudio.addEventListener('ended', () => {
                button.innerHTML = '<i class="bi bi-play-circle-fill"></i>';
                isPlaying = false;
            });
        }

        // Adelantar 
        function forwardSong() {
            if (currentAudio) {
                currentAudio.currentTime += 5;
            }
        }

        // Atrasar 
        function rewindSong() {
            if (currentAudio) {
                currentAudio.currentTime -= 5;
            }
        }

        // búsqueda 
        document.getElementById('search-bar').addEventListener('keyup', function() {
            const query = this.value.toLowerCase();
            const songCards = document.querySelectorAll('.song-card');

            songCards.forEach(card => {
                const title = card.getAttribute('data-title');
                if (title.includes(query)) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</body>

</html>