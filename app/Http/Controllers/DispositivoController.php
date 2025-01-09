<?php

namespace App\Http\Controllers;
use App\Models\Dispositivo;
use App\Models\Localizacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DispositivoController extends Controller
{
    public function dbond()
    {
        $Dispositivos = Dispositivo::paginate(10); // Cambia 10 por la cantidad de registros que deseas mostrar por página
        $Localizaciones = Localizacion::all();
        return view('cameras.device', compact('Dispositivos','Localizaciones'));
    }

    public function dsave(Request $request)
    {
        $request->validate([
            'nomenclatura' => 'required|string|max:255',
            'direccion' => 'required|ip', // o 'required|string|max:255' si no solo IP
            'estado' => 'required|string|max:255',
        ]);

        $Dispositivos = new Dispositivo();
        $Dispositivos->nomenclatura = $request->input('nomenclatura');
        $Dispositivos->direccion = $request->input('direccion');
        $Dispositivos->idciudad = $request->input('idciudad');  /*$Dispositivo->Localizacion->ciudad*/
        $Dispositivos->estado = $request->input('estado');
        $Dispositivos->save();

        return redirect()->back();
    }

    public function dupdate(Request $request,$id)
    {
        $request->validate([
            'nomenclatura' => 'required|string|max:255',
            'direccion' => 'required|ip',
            'estado' => 'required|string|max:255',
        ]);


        $Dispositivos = Dispositivo::find($id);
        $Dispositivos->nomenclatura = $request->input('nomenclatura');
        $Dispositivos->direccion = $request->input('direccion');
        $Dispositivos->idciudad = $request->input('idciudad');
        $Dispositivos->estado = $request->input('estado');
        $Dispositivos->update();

        return redirect()->back();
    }

    public function ddestroy($id)
    {
        $Dispositivos=Dispositivo::find($id);
        $Dispositivos->delete();

        return redirect()->back();
    }
}