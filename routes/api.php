<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewPassword;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\RegistroController;

Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/recuperar-contrasena', [PasswordResetController::class, 'recuperarContrasena']);
Route::post('/verificar-codigo', [PasswordResetController::class, 'verificarCodigo']);
Route::post('/nueva-contrasena', [NewPassword::class, 'nuevaContrasena']);
Route::post('/registrar-usuario', [RegistroController::class, 'registrarUsuario']);
Route::get('/nacionalidades', [RegistroController::class, 'listarNacionalidades']);
Route::get('/ciudades', [RegistroController::class, 'listarCiudades']);
Route::get('/provincias', [RegistroController::class, 'listarProvincias']);
