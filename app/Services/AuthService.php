<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthService
{
    /**
     * Registrar un nuevo usuario
     */
    public function register(array $data)
    {
        // Validar datos de entrada
        $validator = Validator::make($data, [
            'name' => 'required|string|max:100',
            'email' => 'required|email|unique:usuarios,email',
            'password' => 'required|string|min:8|confirmed',
            'tipo' => 'required|in:residente,negocio,admin'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']), // se encripta la contraseña
                'tipo' => $data['tipo'] ?? 'residente',
                'estado' => 'activo'
            ]);

            return $user;
        });
    }

    /**
     * Iniciar sesión de usuario
     */
    public function login(array $credentials)
    {
        // Validar credenciales
        $validator = Validator::make($credentials, [
            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        // Intentar autenticación
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Verificar si el usuario está activo
            if ($user->estado !== 'activo') {
                Auth::logout();
                throw new \Exception('Tu cuenta está suspendida o eliminada.');
            }

            session()->regenerate();
            return $user;
        }

        throw new \Exception('Credenciales inválidas.');
    }

    /**
     * Cerrar sesión
     */
    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
    }

    /**
     * Obtener usuario autenticado
     */
    public function getCurrentUser()
    {
        return Auth::user();
    }

    /**
     * Verificar si el usuario está autenticado
     */
    public function isAuthenticated()
    {
        return Auth::check();
    }
}
