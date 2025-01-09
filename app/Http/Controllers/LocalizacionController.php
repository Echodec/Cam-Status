<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use App\Models\Dispositivo;
use App\Models\Localizacion;
use Illuminate\Http\Request;

class LocalizacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function lbond()
    {
        $Localizaciones = Localizacion::paginate(10);  // Agregar paginación
        return view('Location.index', compact('Localizaciones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'ciudad' => 'required|string|max:255',
        ]);

        $Localizaciones = new Localizacion();
        $Localizaciones->ciudad = $request->input('ciudad');
        $Localizaciones->save();
        return redirect()->back();

    }

    /**
     * Display the specified resource.
     */
    public function show(Localizacion $localizacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'ciudad' => 'required|string|max:255',
        ]);

        $Localizaciones = Localizacion::find($id);
        $Localizaciones->ciudad = $request->input('ciudad');
        $Localizaciones->update();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $Localizaciones = Localizacion::find($id);
        $Localizaciones->delete();
        return redirect()->back();
    }
}
