<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContraseniaReset extends Model
{
    use HasFactory;

    protected $table = 'contrasenia_reset';
    protected $fillable = ['correo_persona', 'token'];
    
    // Definir la clave primaria
    protected $primaryKey = 'correo_persona';

    // Indicar que no es auto-incremental
    public $incrementing = false;

    // Deshabilitar el manejo automático de timestamps si no lo necesitas
    public $timestamps = false;
}