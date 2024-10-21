<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegistroPersona extends Model
{
    use HasFactory;

    protected $table = 'persona'; 
    protected $primaryKey = 'cod_persona'; 
    public $timestamps = false; 

    protected $fillable = [
        'ci_persona',
        'cod_tipoced_persona',
        'nom_persona',
        'ape_persona',
        'fecha_nacimiento',
        'edad_persona',
        'ecivil_persona',
        'etnia_persona',
        'dis_persona',
        'tipo_dis_persona',
        'porcentaje_dis_persona',
        'ncarnet_dis_persona',
        'ocupacion_persona',
        'cod_nacionalidad_persona',
        'cod_ciudad_persona',
        'cod_provincia_persona',
        'parroquia_persona',
        'barrio_persona',
        'calle1_persona',
        'calle2_persona',
        'neducacion_persona',
        'genero_persona',
        'correo_persona',
        'telefono_persona',
        'clave_persona',
        'check_terminos',
        'cod_rol_persona',
        'img_perfil'
    ];
}