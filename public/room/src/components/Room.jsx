import "./Room.css";

function Room() {
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
              src="https://polvora.com.mx/wp-content/uploads/2023/02/Linkin-Park-lanza-Lost-1536x802.jpg"
              alt="Chester Bennington"
            />
          </div>
          <div className="song-inf">
            <p className="song-number">1. Lost Demos, 3:19</p>
            <h3>Chester bennington</h3>
            <p className="album">Meteora</p>
          </div>
        </div>
        
        {/* Barra de música en progreso */}
        <div className="progress-container">
          <div className="time-display" id="time-display">
            0:00
          </div>
          <div className="progress-bar">
            <div className="progress" id="progress"></div>
          </div>
          <div className="time-total" id="time-total">
            4:00
          </div>
        </div>

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

        {/* Barra de busqueda */}
        <div className="search-input">
          <input className="bar-search" type="text" placeholder="Busca una canción" />
          <button className="add-btn">Agregar</button>
        </div>
      </div>
    </div>
  );
}

export default Room;
