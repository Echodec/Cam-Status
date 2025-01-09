<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Dispositivo;

class PingController extends Controller
{
    public function pform()
    {
        return view('users.pingstatus');
    }

    public function pingc(Request $request)
    {
        \Log::info('PingController -> pingc ejecutado.');
        return response()->json(['message' => 'Controlador ejecutado correctamente.']);
    

        $dispositivos = Dispositivo::all(); // O personaliza la consulta si es necesario

        $response = [];

        // Realizar el ping a cada dirección IP
        foreach ($dispositivos as $dispositivo) {
            $ip = $dispositivo->direccion;  // La columna 'direccion' contiene la IP del dispositivo

            // Hacer ping a cada dispositivo
            $pingResult = $this->pingIp($ip);

            // Agregar el resultado del ping junto con la IP
            $response[] = [
                'ip' => $ip,
                'message' => $pingResult
            ];
        }

        // Retornar los resultados del ping en formato JSON
        return response()->json($response);
    }

    // Método para hacer ping a una IP
    private function pingIp($ip)
    {
        \Log::info("Intentando hacer ping a {$ip}");

        $response = ['message' => ''];

        // Validar si la IP es válida
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return 'Dirección IP no válida';
        }

        try {
            // Obtener la URL del servidor Node.js desde el archivo .env
            $nodeUrl = env('NODE_SERVER_URL', 'http://localhost:3000/ping');

            // Realizar la solicitud POST al servidor Node.js
            $nodeResponse = Http::post($nodeUrl, ['ip' => $ip]);

            if ($nodeResponse->ok()) {
                $response['message'] = $nodeResponse->json()['message'];
            } else {
                $response['message'] = 'Error en la solicitud al servidor Node.js.';
            }
        } catch (\Exception $e) {
            $response['message'] = 'Error al intentar conectar con el servidor Node.js: ' . $e->getMessage();
        }

        return response()->json($response);
    }
}