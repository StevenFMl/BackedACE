<?php

namespace App\Http\Controllers;

use App\Models\RegistroPersona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class RegistroController extends Controller
{
    // Método para registrar un nuevo usuario
    public function registrarUsuario(Request $request)
    {
        // Validar los datos de entrada
        $validator = Validator::make($request->all(), [
            'cedula' => 'required|digits:10|unique:persona,ci_persona',
            'tipoced' => 'required|integer',
            'nombre' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'ecivil' => 'required|string|max:50',
            'etnia' => 'required|string|max:50',
            'discapacidad' => 'required|string',
            'tipodis' => 'nullable|string|max:50',
            'porcentajedis' => 'nullable|integer',
            'ncarnetdis' => 'nullable|string|max:50',
            'ocupacion' => 'required|string|max:255',
            'nacionalidad' => 'required|integer',
            'ciudad' => 'required|integer',
            'provincia' => 'required|integer',
            'parroquia' => 'nullable|string|max:255',
            'barrio' => 'nullable|string|max:255',
            'calle1' => 'required|string|max:255',
            'calle2' => 'nullable|string|max:255',
            'neducacion' => 'required|string|max:50',
            'genero' => 'required|string|max:50',
            'correo' => 'required|email|max:255|unique:persona,correo_persona',
            'telefono' => 'required|string|max:15',
            'clave' => 'required|string|min:6|confirmed',
            'check_terminos' => 'required|accepted',
        ]);

        // Retornar errores de validación
        if ($validator->fails()) {
            return response()->json(['estado' => false, 'mensaje' => $validator->errors()], 400);
        }

        // Validar y reemplazar el valor de etnia si es "otro"
        $etnia = $request->etnia === 'otro' ? $request->otraetnia : $request->etnia;

        // Calcular la edad a partir de la fecha de nacimiento
        $edad = now()->year - date('Y', strtotime($request->fecha_nacimiento));

        // Crear el nuevo usuario con la clave en MD5
        $nuevoUsuario = RegistroPersona::create([
            'ci_persona' => $request->cedula,
            'cod_tipoced_persona' => $request->tipoced,
            'nom_persona' => $request->nombre,
            'ape_persona' => $request->apellido,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'edad_persona' => $edad,
            'ecivil_persona' => $request->ecivil,
            'etnia_persona' => $etnia,
            'dis_persona' => $request->discapacidad,
            'tipo_dis_persona' => $request->tipodis,
            'porcentaje_dis_persona' => $request->porcentajedis,
            'ncarnet_dis_persona' => $request->ncarnetdis,
            'ocupacion_persona' => $request->ocupacion,
            'cod_nacionalidad_persona' => $request->nacionalidad,
            'cod_ciudad_persona' => $request->ciudad,
            'cod_provincia_persona' => $request->provincia,
            'parroquia_persona' => $request->parroquia,
            'barrio_persona' => $request->barrio,
            'calle1_persona' => $request->calle1,
            'calle2_persona' => $request->calle2,
            'neducacion_persona' => $request->neducacion,
            'genero_persona' => $request->genero,
            'correo_persona' => $request->correo,
            'telefono_persona' => $request->telefono,
            'clave_persona' => md5($request->clave), // Encriptar la clave con MD5
            'check_terminos' => $request->check_terminos ? 1 : 0, // Almacenar 1 si aceptó, 0 si no
            'cod_rol_persona' => 2, // Asignar el rol de usuario
            'img_perfil' => '', // Campo opcional para la imagen de perfil
        ]);

        // Verificar si el usuario fue creado con éxito
        if ($nuevoUsuario) {
            return response()->json(['estado' => true, 'mensaje' => 'Usuario creado satisfactoriamente.']);
        } else {
            return response()->json(['estado' => false, 'mensaje' => 'Error al crear el usuario.'], 500);
        }
    }

    // Método para listar nacionalidades
    public function listarNacionalidades()
    {
        $nacionalidades = DB::table('nacionalidades')->get();
        return response()->json(['estado' => true, 'datos' => $nacionalidades]);
    }

    // Método para listar ciudades
    public function listarCiudades()
    {
        $ciudades = DB::table('ciudades')->get();
        return response()->json(['estado' => true, 'datos' => $ciudades]);
    }

    // Método para listar provincias
    public function listarProvincias()
    {
        $provincias = DB::table('provincias')->get();
        return response()->json(['estado' => true, 'datos' => $provincias]);
    }
}