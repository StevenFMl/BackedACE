<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'persona'; 
    protected $primaryKey = 'cod_persona';

    public $timestamps = false; // Desactivar timestamps

    protected $fillable = [
        'ci_persona',
        'nom_persona',
        'ape_persona',
        'correo_persona',
        'img_perfil',
        'clave_persona', // Asegúrate de que este campo esté hasheado al almacenarlo
    ];
}