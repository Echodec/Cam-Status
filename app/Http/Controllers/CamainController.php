<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

class CamainController extends Controller
{
    public function cbond()
    {
        return view('camain');
    }
}