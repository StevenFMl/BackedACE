<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContraseniaReset;
use App\Models\Persona;
use Illuminate\Support\Facades\Hash;

class NewPassword extends Controller
{
    public function nuevaContrasena(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'token' => 'required|string',
            'nueva_contrasena' => 'required|string|min:8',
        ]);

        // Obtener los datos del request
        $token = $request->input('token');
        $nuevaContrasena = md5($request->input('nueva_contrasena')); // Encriptar con md5

        // Verificar si el token es válido y obtener el correo asociado
        $resetRecord = ContraseniaReset::where('token', $token)->first();

        if ($resetRecord) {
            $correo = $resetRecord->correo_persona;

            // Actualizar la contraseña en la tabla persona
            Persona::where('correo_persona', $correo)->update(['clave_persona' => $nuevaContrasena]);

            // Eliminar el registro de contrasenia_reset asociado al token
            $resetRecord->delete();

            return response()->json(['estado' => true, 'mensaje' => 'La contraseña se ha actualizado correctamente.']);
        } else {
            return response()->json(['estado' => false, 'mensaje' => 'El token proporcionado no es válido.']);
        }
    }
}