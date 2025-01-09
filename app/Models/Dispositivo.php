<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $table = 'dispositivos'; // Nombre de la tabla

    // Define los campos que se pueden asignar masivamente
    protected $primeykey = 'id';
    protected $fillable = ['idciudad','nomenclatura', 'direccion', 'estado'];
    protected $guarded = [];
    public $timestamps = false;


    public function Localizacion(){
        return $this->hasOne(Localizacion::class, 'id','idciudad');
    }
}
