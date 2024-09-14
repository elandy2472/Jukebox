import "./Room.css";
import { useEffect, useState } from "react";

function Room() {
  const [videoTitle, setVideoTitle] = useState('');
  const [videoThumbnail, setVideoThumbnail] = useState('');
  const [videoDuration, setVideoDuration] = useState('0:00');
  const [currentTime, setCurrentTime] = useState('0:00');
  const [progressPercent, setProgressPercent] = useState(0); // Estado para el progreso

  useEffect(() => {
    // Cargar la API de YouTube
    const script = document.createElement("script");
    script.src = "https://www.youtube.com/iframe_api";
    script.async = true;
    document.body.appendChild(script);

    // Cargar tu script personalizado
    const script2 = document.createElement("script");
    script2.src = "./src/components/script.js"; // Asegúrate de que la ruta sea correcta
    script2.async = true;
    document.body.appendChild(script2);

    // Configurar el reproductor cuando la API esté lista
    window.onYouTubeIframeAPIReady = () => {
      window.player = new window.YT.Player('player', {
        height: '0',
        width: '0',
        videoId: '', // No se establece video ID aquí, lo haremos dinámicamente
        events: {
          'onReady': onPlayerReady,
          'onStateChange': onPlayerStateChange
        }
      });
    };

    function onPlayerReady(event) {
      console.log("YouTube player is ready.");
    }

    function onPlayerStateChange(event) {
      if (event.data === window.YT.PlayerState.PLAYING) {
        // Actualizar el tiempo de reproducción y la barra de progreso
        setInterval(() => {
          const currentTime = window.player.getCurrentTime();
          const duration = window.player.getDuration();
          setCurrentTime(formatTime(currentTime));
          setVideoDuration(formatTime(duration));

          // Actualizar el progreso de la barra
          setProgressPercent((currentTime / duration) * 100);
        }, 1000);
      }
    }

    function formatTime(seconds) {
      const minutes = Math.floor(seconds / 60);
      const secs = Math.floor(seconds % 60);
      return `${minutes}:${secs < 10 ? '0' : ''}${secs}`;
    }

    // Limpiar los scripts cuando el componente se desmonte
    return () => {
      document.body.removeChild(script);
      document.body.removeChild(script2);
    };
  }, []);

  function handlePlayVideo(videoId, title) {
    if (window.player) {
      window.player.loadVideoById(videoId);
      window.player.playVideo();
      window.player.unMute(); // Asegúrate de que el video no esté en mudo
      setVideoTitle(title);
      setVideoThumbnail(`https://img.youtube.com/vi/${videoId}/hqdefault.jpg`);
    }
  }

  useEffect(() => {
    document.getElementById('searchButton').addEventListener('click', () => {
      const query = document.getElementById('searchInput').value;

      fetch(`http://localhost:3000/search?q=${encodeURIComponent(query)}`)
        .then(response => response.json())
        .then(videos => {
          const videoResults = document.getElementById('videoResults');
          videoResults.innerHTML = '';

          if (videos.length > 0) {
            const video = videos[0]; // Tomamos el primer video de los resultados
            setVideoTitle(video.snippet.title);
            setVideoThumbnail(`https://img.youtube.com/vi/${video.id.videoId}/hqdefault.jpg`);

            videoResults.innerHTML = `
              <iframe id="player" width="0" height="0" src="https://www.youtube.com/embed/${video.id.videoId}" frameborder="0" allowfullscreen></iframe>
            `;
          }
        })
        .catch(error => console.error('Error:', error));
    });

    // Limpiar el event listener cuando el componente se desmonte
    return () => {
      document.getElementById('searchButton').removeEventListener('click', handleSearch);
    };
  }, []);

  function handleSearch() {
    const query = document.getElementById('searchInput').value;
    fetch(`http://localhost:3000/search?q=${encodeURIComponent(query)}`)
      .then(response => response.json())
      .then(videos => {
        const videoResults = document.getElementById('videoResults');
        videoResults.innerHTML = '';

        if (videos.length > 0) {
          const video = videos[0]; // Tomamos el primer video de los resultados
          setVideoTitle(video.snippet.title);
          setVideoThumbnail(`https://img.youtube.com/vi/${video.id.videoId}/hqdefault.jpg`);

          videoResults.innerHTML = `
            <iframe id="player" width="0" height="0" src="https://www.youtube.com/embed/${video.id.videoId}" frameborder="0" allowfullscreen></iframe>
          `;
        }
      })
      .catch(error => console.error('Error:', error));
  }

  return (
    <div className="container">
      <div className="room-container">
        <div>
          <h1>Sala 1</h1>
        </div>
        {/* Imagen e información de la canción */}
        <div className="music-card">
          <div className="image-container">
            <img
              src={videoThumbnail || "https://polvora.com.mx/wp-content/uploads/2023/02/Linkin-Park-lanza-Lost-1536x802.jpg"}
              alt="Thumbnail"
            />
          </div>
          <div className="song-inf">
            <p className="song-number">{videoTitle ? `1. ${videoTitle}` : '1. Lost Demos, 3:19'}</p>
            <h3>{videoTitle || 'Chester Bennington'}</h3>
          </div>
        </div>
        {/* Barra de música en progreso */}
        <div className="progress-container">
          <div className="time-display" id="time-display">
            {currentTime}
          </div>
          <div className="progress-bar">
            <div className="progress" id="progress" style={{ width: `${progressPercent}%` }}></div>
          </div>
          <div className="time-total" id="time-total">
            {videoDuration}
          </div>
        </div>
        {/* LISTA */}
        {/* Lista de música en progreso */}
        <div className="playlist">
          <div className="song-item">
            <img src="https://via.placeholder.com/40" alt="Album Art" />
            <div className="song-info">
              <span className="song-title">Sympathy for the Devil</span>
              <span className="song-artist">The Rolling Stones</span>
            </div>
            <span className="remove-song">✖</span>
          </div>
          <div className="song-item">
            <img src="https://via.placeholder.com/40" alt="Album Art" />
            <div className="song-info">
              <span className="song-title">A Hard Day's Night</span>
              <span className="song-artist">The Beatles</span>
            </div>
            <span className="remove-song">✖</span>
          </div>
          <div className="song-item">
            <img src="https://via.placeholder.com/40" alt="Album Art" />
            <div className="song-info">
              <span className="song-title">Baba O'Riley</span>
              <span className="song-artist">The Who</span>
            </div>
            <span className="remove-song">✖</span>
          </div>
        </div>
        {/* Barra de búsqueda */}
        <div className="search-input">
          <input id="searchInput" className="bar-search" type="text" placeholder="Busca una canción" />
          <button id="searchButton" className="add-btn">Buscar y mostrar</button>
          <button onClick={() => {
            const videoId = document.querySelector('#videoResults iframe').src.split('/').pop().split('?')[0];
            handlePlayVideo(videoId, videoTitle);
          }}>Reproducir Video</button>
          <div id="videoResults"></div>
        </div>
        {/* Reproductor de YouTube */}
        <div id="player"></div>
      </div>
    </div>
  );
}

export default Room;
