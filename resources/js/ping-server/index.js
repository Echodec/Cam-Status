const express = require('express');
const ping = require('ping');
const net = require('net');
const app = express();
const port = 3000;

app.use(express.json());

app.post('/ping', async (req, res) => {
    const ip = req.body.ip;

    if (!ip || !net.isIP(ip)) {
        return res.status(400).json({ status: 'error', message: 'Dirección IP no válida.' });
    }

    try {
        const result = await ping.promise.probe(ip);
        if (result.alive) {
            res.json({ status: 'online', message: `Dispositivo ${ip} está en línea.` });
        } else {
            res.json({ status: 'offline', message: `Dispositivo ${ip} fuera de línea.` });
        }
    } catch (error) {
        console.error('Error al realizar ping:', error);
        res.status(500).json({ status: 'error', message: 'Error al realizar ping.' });
    }
});

app.listen(port, () => {
    console.log(`Servidor de ping escuchando en http://localhost:${port}`);
});
