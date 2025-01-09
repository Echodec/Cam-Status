const express = require('express');
const { exec } = require('child_process');
const dns = require('dns');
const os = require('os');
const app = express();
const port = 3000;

app.use(express.json());

// Función para determinar el comando de ping adecuado según el sistema operativo
const getPingCommand = (ip) => {
    const platform = os.platform();
    return platform === 'win32' ? `ping -n 1 ${ip}` : `ping -c 1 ${ip}`;
};

app.post('/ping', (req, res) => {
    const ip = req.body.ip;

    if (!ip || !/^(\d{1,3}\.){3}\d{1,3}$/.test(ip)) {
        return res.status(400).json({ message: 'Dirección IP no válida.' });
    }

    const pingCommand = getPingCommand(ip);

    exec(pingCommand, (error) => {
        if (error) {
            return res.json({ message: `Dispositivo ${ip} fuera de línea.` });
        }

        dns.reverse(ip, (err, hostnames) => {
            if (err || hostnames.length === 0) {
                res.json({ message: `Dispositivo ${ip} está en línea.` });
            } else {
                const deviceName = hostnames[0];
                res.json({ message: `Dispositivo "${deviceName}" está en línea.` });
            }
        });
    });
});

app.listen(port, () => {
    console.log(`Servidor de ping escuchando en http://localhost:${port}`);
});
