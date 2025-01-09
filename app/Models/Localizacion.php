<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Localizacion extends Model
{
    use HasFactory;
    protected $table = 'localizaciones';
    protected $primaryKey='id';
    protected $fillable=['ciudad'];
    public $timestamps=false;
    
}
