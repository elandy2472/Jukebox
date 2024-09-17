const express = require('express');
const axios = require('axios');
const path = require('path');
const cors = require('cors');
require('dotenv').config();

const app = express();
const PORT = process.env.PORT || 3000;

// Clave de API de YouTube
const YOUTUBE_API_KEY = process.env.YOUTUBE_API_KEY;

// Configuración para servir archivos estáticos
app.use(express.static(path.join(__dirname, 'public')));

// Configuración de CORS
app.use(cors());

// Ruta de búsqueda de videos
app.get('/search', async (req, res) => {
  const searchQuery = req.query.q;

  try {
    const response = await axios.get('https://www.googleapis.com/youtube/v3/search', {
      params: {
        part: 'snippet',
        maxResults: 1,
        q: searchQuery,
        key: YOUTUBE_API_KEY,
        type: 'video'
      }
    });

    res.json(response.data.items);
  } catch (error) {
    console.error('Error al obtener datos de la API de YouTube', error);
    res.status(500).send('Error al obtener datos de la API de YouTube');
  }
});

app.listen(PORT, () => {
  console.log(`Servidor en ejecución en http://localhost:${PORT}`);
});
