<!DOCTYPE html>
<html lang="es">

<head>
    <?php require_once("./app/views/inc/head.php");  ?>
    <link rel="stylesheet" href="styles.css">
</head>

<body id="body_userView">
    <div id="container_userView">
        <!-- Título de la sala -->
        <h1 id="title_room_userView">Nombre de Sala</h1>

        <!-- Mensaje de reproducción -->
        <p id="playing_message_userView">Reproduciendo: </p>

        <!-- Imagen de la canción -->
        <img id="song_image_userView" src="<?php echo APP_URL; ?>app/views/fotos/QUITAR_IMAGEN_AL_LANZAR_img_songview.svg" alt="Imagen de la canción">

        <!-- Input con el nombre de la canción y cantante -->
        <div id="song_info_userView">
            <p id="song_name_userView">Nombre de la canción</p>
            <p id="artist_name_userView">Nombre del cantante</p>
        </div>

        <div id="timeline_container_userView">
            <span id="start_time_userView">0:00</span>
            <input type="range" id="timeline_userView" min="0" max="100" value="30">
            <span id="end_time_userView">3:45</span>
        </div>

        <div id="contenedor_cola_reproduccion">
            <table id="table_userView">
                <thead id="thead_userView">
                    <tr>
                        <th>Canción</th>
                        <th>Artista</th>
                        <th>Duración</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody id="tbody_userView">                    
                    <tr>
                        <td>Canción 2</td>
                        <td>Artista 2</td>
                        <td>4:20</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>Canción 2</td>
                        <td>Artista 2</td>
                        <td>4:20</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>Canción 2</td>
                        <td>Artista 2</td>
                        <td>4:20</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>Canción 2</td>
                        <td>Artista 2</td>
                        <td>4:20</td>
                        <td>...</td>
                    </tr>
                    <tr>
                        <td>Canción 2</td>
                        <td>Artista 2</td>
                        <td>4:20</td>
                        <td>...</td>
                    </tr>
                    <!-- Agrega más filas según sea necesario -->
                </tbody>
            </table>
        </div>

        <form action="#" method="POST" id="form_userView">
            <input id="buscar_cancion" type="text" placeholder="Buscar Cancion">
            <input id="añadir_cancion" type="submit" value="Añadir">
        </form>

    </div>
</body>

</html>