<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ping IP - Vista 2</title>

    <link rel="stylesheet" href="{{ asset('assets/main.css') }}">

    <script>
        let pingInterval;
        let isPinging = false;

        async function startPing() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (isPinging) return;

            document.getElementById('ping-status').innerText = 'Iniciando ping...';
            toggleButtons(true);

            pingInterval = setInterval(async () => {
                try {
                    const response = await fetch('{{ route('pingstatus.pingc') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken
                        }
                    });

                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }

                    const result = await response.json();
                    document.getElementById('result').innerText = 'Ping en ejecución...';
                    updateDashboard(result);

                } catch (error) {
                    document.getElementById('result').innerText = 'Error en la solicitud de ping.';
                    console.error('Error en la solicitud de ping:', error);
                }
            }, 5000);

            isPinging = true;
        }

        function stopPing() {
            if (!isPinging) return;

            clearInterval(pingInterval);
            document.getElementById('result').innerText = 'Ping detenido.';
            toggleButtons(false);
            isPinging = false;
        }

        function toggleButtons(isPingRunning) {
            document.getElementById('start-btn').disabled = isPingRunning;
            document.getElementById('stop-btn').disabled = !isPingRunning;
        }

        function updateDashboard(results) {
            const dashboardContent = document.getElementById('dashboard-content');
            dashboardContent.innerHTML = ''; // Limpiar el contenido previo

            results.forEach(result => {
                const div = document.createElement('div');
                div.innerHTML = `IP: ${result.ip} - Estado: ${result.message}`;
                dashboardContent.appendChild(div);
            });
        }
    </script>

</head>
<body>
    <header>
        <h1>Ping IP - Vista 2</h1>
    </header>

    <div class="main-content">

        <div id="dashboard">
            <div class="form-container">
                <!-- Eliminamos el campo para ingresar la IP -->
                <button type="button" id="start-btn" onclick="startPing()">Iniciar Ping a todas las IPs</button>
                <button type="button" id="stop-btn" onclick="stopPing()">Detener Ping</button>
                <p id="result"></p>
            </div>
            <h2>Estado del Ping</h2>
            <div id="dashboard-content">
                Aquí se mostrarán los resultados del estado de los pings a todas las IPs.
            </div>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</body>
</html>
