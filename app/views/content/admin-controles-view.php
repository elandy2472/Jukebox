<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de Salas</title>
    <!-- Incluimos Font Awesome para los íconos -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/admin-controles-view.css">
</head>

<body>
    <div class="sidebar">
        <h2>Control Panel</h2>
        <ul>
            <li><a href="#">Inicio</a></li>
            <li><a href="#">Salas</a></li>
            <li><a href="#">Eventos</a></li>
            <li><a href="#">Usuarios</a></li>
            <li><a href="#">Configuración</a></li>
        </ul>
        <div class="sidebar-footer">
            <a href="crearsala">+ Nueva sala</a>
            <a href="#">Invitar equipo</a>
            <a href="#">Comentarios</a>
            <a href="#">Ayuda y documentación</a>
        </div>
    </div>

    <div class="main-content">
        <div class="music-header">
            <h1>Salas Activas</h1>
        </div>

        <div class="rooms-grid">
            <!-- Sala 3 -->
            <div class="room-card">
                <img src="../img/musica1.jpg" alt="Sala 3" />
                <div class="room-info">
                    <p><strong>Sala:</strong> 1</p>
                    <div class="controls">
                        <button class="play" onclick="playMusic(this)">
                            <i class="icono"><img src="../img/play-solid.svg" alt=""></i>
                        </button>
                        <button class="pause" onclick="pauseMusic(this)">
                            <i class="icono"><img src="../img/pause-solid.svg" alt=""></i>
                        </button>
                        <button class="skip" onclick="skipMusic(this)">
                            <i class="icono"><img src="../img/forward-solid.svg" alt=""></i>
                        </button>
                        <button class="delete" onclick="deleteRoom(this)">
                            <i class="icono"><img src="..//img/trash-solid.svg" alt=""></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sala 3 -->
            <div class="room-card">
                <img src="../img/musica2.jpg" alt="Sala 3" />
                <div class="room-info">
                    <p><strong>Sala:</strong> 4</p>
                    <div class="controls">
                        <button class="play" onclick="playMusic(this)">
                            <i class="icono"><img src="../img/play-solid.svg" alt=""></i>
                        </button>
                        <button class="pause" onclick="pauseMusic(this)">
                            <i class="icono"><img src="../img/pause-solid.svg" alt=""></i>
                        </button>
                        <button class="skip" onclick="skipMusic(this)">
                            <i class="icono"><img src="../img/forward-solid.svg" alt=""></i>
                        </button>
                        <button class="delete" onclick="deleteRoom(this)">
                            <i class="icono"><img src="../img/trash-solid.svg" alt=""></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sala 3 -->
            <div class="room-card">
                <img src="../img/musica3.jpg" alt="Sala 3" />
                <div class="room-info">
                    <p><strong>Sala:</strong> 4</p>
                    <div class="controls">
                        <button class="play" onclick="playMusic(this)">
                            <i class="icono"><img src="../img/play-solid.svg" alt=""></i>
                        </button>
                        <button class="pause" onclick="pauseMusic(this)">
                            <i class="icono"><img src="../img/pause-solid.svg" alt=""></i>
                        </button>
                        <button class="skip" onclick="skipMusic(this)">
                            <i class="icono"><img src="../img/forward-solid.svg" alt=""></i>
                        </button>
                        <button class="delete" onclick="deleteRoom(this)">
                            <i class="icono"><img src="../img/trash-solid.svg" alt=""></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="room-card">
                <img src="../img/musica4.jpg" alt="Sala 3" />
                <div class="room-info">
                    <p><strong>Sala:</strong> 4</p>
                    <div class="controls">
                        <button class="play" onclick="playMusic(this)">
                            <i class="icono"><img src="../img/play-solid.svg" alt=""></i>
                        </button>
                        <button class="pause" onclick="pauseMusic(this)">
                            <i class="icono"><img src="../img/pause-solid.svg" alt=""></i>
                        </button>
                        <button class="skip" onclick="skipMusic(this)">
                            <i class="icono"><img src="../img/forward-solid.svg" alt=""></i>
                        </button>
                        <button class="delete" onclick="deleteRoom(this)">
                            <i class="icono"><img src="../img/trash-solid.svg" alt=""></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- <script src="script.js"></script> -->
</body>

</html>