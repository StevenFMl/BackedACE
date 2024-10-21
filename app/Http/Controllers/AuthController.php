<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'usuario' => 'required|string',
            'clave' => 'required|string',
        ]);

        $usuario = $request->input('usuario');
        $clave_md5 = md5($request->input('clave')); // Usamos md5 para la contraseña

        // Buscar el usuario en la base de datos
        $persona = DB::table('persona')
                    ->where('ci_persona', $usuario)
                    ->where('clave_persona', $clave_md5)
                    ->first();

        // Verificar si el usuario existe
        if ($persona) {
            return response()->json([
                'estado' => true,
                'persona' => [
                    'codigo' => $persona->cod_persona,
                    'cedula' => $persona->ci_persona,
                    'nombre' => $persona->nom_persona,
                    'apellido' => $persona->ape_persona,
                    'correo' => $persona->correo_persona,
                    'img_perfil' => $persona->img_perfil,
                ],
            ]);
        } else {
            return response()->json([
                'estado' => false,
                'mensaje' => 'Usuario o clave incorrecto',
            ], 401);
        }
    }
}