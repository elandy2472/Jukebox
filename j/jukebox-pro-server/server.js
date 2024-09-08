const express = require('express');
const cors = require('cors');
const bodyParser = require('body-parser');

const app = express();
const port = 5000;

app.use(cors());
app.use(bodyParser.json());

let salas = {}; // Aquí guardaremos las salas activas

function generarCodigoUnico() {
    return Math.random().toString(36).substring(2, 8).toUpperCase();
}

app.post('/crear-sala', (req, res) => {
    const { nombreSala } = req.body;
    const codigoSala = generarCodigoUnico();

    if (salas[codigoSala]) {
        return res.status(400).json({ message: 'Error al crear la sala. Intente nuevamente.' });
    }

    salas[codigoSala] = { nombre: nombreSala, usuarios: [] };
    return res.status(201).json({ 
        message: `Sala ${nombreSala} creada`, 
        nombreSala: nombreSala,
        codigoSala: codigoSala,
        linkCompartir: `http://localhost:3000/sala/${codigoSala}`
    });
});

app.listen(port, () => {
    console.log(`Servidor corriendo en http://localhost:${port}`);
});