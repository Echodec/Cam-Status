<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CamainController;
use App\Http\Controllers\DispositivoController;
use App\Http\Controllers\LocalizacionController;
use App\Http\Controllers\PingController;
use App\Models\Localizacion;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/camain', [CamainController::class, 'cbond'])->name('camain.cbond');
Route::get('/cameras/device', [DispositivoController::class, 'dbond'])->name('device.dbond');
Route::get('/Location/index', [LocalizacionController::class, 'lbond'])->name('index.lbond');
Route::get('/users/pingstatus', [PingController::class, 'pform'])->name('pingstatus.pform');
Route::post('/index/save', [LocalizacionController::class, 'store'])->name('index.store');
Route::post('/device/save', [DispositivoController::class, 'dsave'])->name('device.dsave');
Route::post('/users/pingstatus', [PingController::class, 'pingc'])->name('pingstatus.pingc');
Route::put('/index/update/{id}', [LocalizacionController::class, 'update'])->name('index.update');
Route::put('/device/update/{id}', [DispositivoController::class, 'dupdate'])->name('device.dupdate');
Route::delete('/index/delete/{id}', [LocalizacionController::class, 'destroy'])->name('index.destroy');
Route::delete('/device/delete/{id}', [DispositivoController::class, 'ddestroy'])->name('device.ddestroy');