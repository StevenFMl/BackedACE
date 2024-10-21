<?php
namespace App\Http\Controllers;

use App\Models\ContraseniaReset;
use App\Models\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Mail\PasswordResetMail; 

class PasswordResetController extends Controller
{
    public function recuperarContrasena(Request $request)
    {
        // Validación de entrada
        $request->validate([
            'cedula' => 'required|string',
        ]);
    
        $cedula = $request->input('cedula');
    
        try {
            // Buscar el correo asociado a la cédula
            $persona = Persona::where('ci_persona', $cedula)->first();
    
            if ($persona) {
                $email = $persona->correo_persona;
                $token = random_int(100000, 999999); // Genera un código numérico de 6 dígitos
    
                // Eliminar cualquier token previo para este correo
                ContraseniaReset::where('correo_persona', $email)->delete();
    
                // Insertar el nuevo token en la base de datos
                ContraseniaReset::create([
                    'correo_persona' => $email,
                    'token' => $token,
                    'created_at' => now(),
                ]);
    
                // Enviar correo al usuario utilizando el mailable
                Mail::to($email)->send(new PasswordResetMail($token, $email));
    
                return response()->json(['estado' => true, 'mensaje' => "Se ha enviado un código de recuperación de contraseña a su correo electrónico."]);
            } else {
                return response()->json(['estado' => false, 'mensaje' => "No se encontró un usuario con esa cédula."]);
            }
        } catch (\Exception $e) {
            return response()->json(['estado' => false, 'mensaje' => "Ocurrió un error al procesar la solicitud.", 'error' => $e->getMessage()]);
        }
    }

    public function verificarCodigo(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        $token = $request->input('token');

        // Verificar si el token es válido
        $resetRequest = ContraseniaReset::where('token', $token)->first();

        if ($resetRequest) {
            return response()->json(['estado' => true, 'mensaje' => "Código válido."]);
        } else {
            return response()->json(['estado' => false, 'mensaje' => "El código proporcionado no es válido."]);
        }
    }
}