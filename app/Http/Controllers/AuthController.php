<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required|string'
            ]);

            $user = $this->authService->login($credentials);

            // redirigir al inicio
            return redirect()->route('home')->with('success', '¡Bienvenido!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function register(Request $request)
    {
        try {
            $data = $request->all();

            $user = $this->authService->register($data); // registro de usuario como residente
            auth()->login($user); // iniciar sesión automáticamente

            // Redirigir al home  
            return redirect()->route('home')->with('success', '¡Cuenta creada exitosamente!');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $e) {
            return back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function logout()
    {
        $this->authService->logout();
        return redirect()->route('home')->with('success', 'Sesión cerrada exitosamente.');
    }
}
