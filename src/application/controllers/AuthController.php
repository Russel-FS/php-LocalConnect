<?php

require_once __DIR__ . '/BaseController.php';

class AuthController extends BaseController
{
    public function showLogin()
    {
        if ($this->isAuthenticated()) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/login', [
            'title' => 'Iniciar Sesión | LocalConnect',
            'styles' => ['auth.css'],
            'scripts' => ['auth.js']
        ]);
    }

    public function login()
    {
        $data = $this->getPostData();
        $errors = $this->validateRequired($data, ['email', 'password']);

        if (!empty($errors)) {
            $this->json(['errors' => $errors], 422);
        }

        $_SESSION['user_id'] = 1;
        $_SESSION['user_email'] = $data['email'];
        $_SESSION['user_name'] = 'Usuario Ejemplo'; // Esto vendría de la base de datos

        $this->redirect('/dashboard');
    }

    public function showRegister()
    {
        if ($this->isAuthenticated()) {
            $this->redirect('/dashboard');
        }
        $this->view('auth/register', [
            'title' => 'Registro | LocalConnect',
            'styles' => ['auth.css'],
            'scripts' => ['auth.js']
        ]);
    }

    public function register()
    {
        $data = $this->getPostData();
        $errors = $this->validateRequired($data, ['email', 'password', 'confirm_password']);

        if (!empty($errors)) {
            $this->json(['errors' => $errors], 422);
        }

        if ($data['password'] !== $data['confirm_password']) {
            $this->json(['errors' => ['password' => 'Las contraseñas no coinciden']], 422);
        }
        $this->redirect('/login');
    }

    public function logout()
    {
        session_destroy();
        $this->redirect('/login');
    }
}
