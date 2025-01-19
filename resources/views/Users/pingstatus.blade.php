<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ping IP - Vista 2</title>

    <link rel="stylesheet" href="{{ asset('assets/main.css') }}">

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Deshabilitar el botón "Detener Ping" al cargar la página
            document.getElementById('stop-btn').disabled = true;
        });
    </script>

    <script>
        let pingInterval; // Almacena el ID del intervalo
        let isPinging = false; // Estado de ejecución del ping
        let isPingStopped = false; // Bandera para detener Ping

        async function startPing() {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (isPinging) return; // Evitar múltiples inicios

            document.getElementById('ping-status').innerText = 'Iniciando ping...';
            toggleButtons(true); // Deshabilitar botón de inicio y habilitar el de detener

            // Crear el intervalo de ping
            pingInterval = setInterval(async () => {

                if (isPingStopped) { // Si el ping está detenido, salimos del intervalo
                    clearInterval(pingInterval); // Detenemos el intervalo inmediatamente
                    return; // Salimos de la función
                }

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
            }, 10000);

            isPinging = true; // Marcar como en ejecución
        }

        function stopPing() {
            if (!isPinging) return; // Evitar detener si ya está detenido

            isPingStopped = true; // Detener inmediatamente el ping
            clearInterval(pingInterval); // Detener el intervalo
            document.getElementById('result').innerText = 'Ping detenido.';
            toggleButtons(false); // Habilitar botón de inicio y deshabilitar el de detener
            isPinging = false; // Marcar como detenido
        }

        function toggleButtons(isPingRunning) {
            document.getElementById('start-btn').disabled = isPingRunning;
            document.getElementById('stop-btn').disabled = !isPingRunning;
        }

        function updateDashboard(results) {
            const dashboardContent = document.getElementById('dashboard-content');
            dashboardContent.innerHTML = ''; // Limpiar el contenido previo

            results.forEach(result => {
                const row = document.createElement('tr');
                row.innerHTML = `
            <td>${result.ip}</td>
            <td class="${result.message === 'En línea' ? 'online' : 'offline'}">${result.message}</td>
        `;
                dashboardContent.appendChild(row);
            });
        }
    </script>

</head>

<body>
    <header>
        <h1>Ping-Status</h1>
    </header>

    <div class="main-content">

        <div id="dashboard">
            <div class="form-container">
                <!-- Eliminamos el campo para ingresar la IP -->
                <button type="button" id="start-btn" onclick="startPing()">Iniciar Ping a todas las IPs</button>
                <button type="button" id="stop-btn" onclick="stopPing()">Detener Ping</button>
            </div>
            <br><br><br><br>
            <p id="ping-status"></p>
            <p id="result"></p>
            <h2>Estado de los Dispositivos</h2>
            <table id="dashboard-table">
                <thead>
                    <tr>
                        <th>Dirección IP</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody id="dashboard-content">
                    <!-- Aquí se añadirán dinámicamente los resultados -->
                </tbody>
            </table>
        </div>
    </div>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</body>

</html>