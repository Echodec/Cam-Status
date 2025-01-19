<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Dispositivo;
use Illuminate\Support\Facades\Log;

class PingController extends Controller
{
    public function pform()
    {
        return view('users.pingstatus');
    }

    public function pingc(Request $request)
    {
        $dispositivos = Dispositivo::where('estado', 'Activo')->get(); // O personaliza la consulta si es necesario

        $response = [];

        // Realizar el ping a cada dirección IP
        foreach ($dispositivos as $dispositivo) {
            $ip = $dispositivo->direccion;  // La columna 'direccion' contiene la IP del dispositivo

            // Hacer ping a cada dispositivo
            $pingResult = $this->pingIp($ip);

            $estado = $pingResult['message'] === 'success' ? 'En línea' : 'Sin conexión';

            // Agregar el resultado del ping junto con la IP
            $response[] = [
                'ip' => $ip,
                'message' => $estado, // En línea o Sin conexión
            ];
        }

        // Retornar los resultados del ping en formato JSON
        return response()->json($response);
    }

    // Método para hacer ping a una IP
    private function pingIp($ip)
    {
        $response = ['message' => ''];

        // Validar si la IP es válida
        if (!filter_var($ip, FILTER_VALIDATE_IP)) {
            return ['message' => 'Sin conexión'];
        }

        try {
            // Obtener la URL del servidor Node.js desde el archivo .env
            $nodeUrl = env('NODE_SERVER_URL', 'http://localhost:3000/ping');

            // Realizar la solicitud POST al servidor Node.js
            $nodeResponse = Http::post($nodeUrl, ['ip' => $ip]);
            Log::info('Node.js Response:', $nodeResponse->json());

            if ($nodeResponse->ok() && $nodeResponse->json()['message'] === 'success') {
                return ['message' => 'En línea'];
            } 
        } catch (\Exception $e) {
            Log::error('Error en pingIp:', ['error' => $e->getMessage()]);
            return ['message' => 'Sin conexión'];
        }

        return ['message' => 'Sin conexión'];
    }
}
