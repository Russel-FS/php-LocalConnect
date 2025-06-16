<?php

class BaseController
{
    protected function view($view, $data = [])
    {
        // Obtener la información del usuario si está autenticado
        if ($this->isAuthenticated()) {
            $data['user'] = [
                'id' => $_SESSION['user_id'],
                'email' => $_SESSION['user_email'] ?? 'usuario@ejemplo.com',
                'name' => $_SESSION['user_name'] ?? 'Usuario'
            ];
        }

        // Extraer los datos para que estén disponibles en la vista
        extract($data);

        // Construir la ruta de la vista
        $viewPath = __DIR__ . "/../../presentation/views/{$view}.php";

        // Verificar si la vista existe
        if (!file_exists($viewPath)) {
            throw new Exception("Vista no encontrada: {$view}");
        }


        ob_start(); // Capturar la salida de la vista
        require $viewPath; // Incluir la vista
        $content = ob_get_clean(); // Obtener el contenido capturado
        require_once __DIR__ . "/../../presentation/views/main.php"; // Incluir el layout principal
    }

    protected function json($data, $statusCode = 200)
    {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }

    protected function redirect($url)
    {
        header("Location: {$url}");
        exit;
    }

    protected function isAuthenticated()
    {
        return isset($_SESSION['user_id']);
    }

    protected function requireAuth()
    {
        if (!$this->isAuthenticated()) {
            $this->redirect('/login');
        }
    }

    protected function getPostData()
    {
        return $_POST;
    }

    protected function getQueryParams()
    {
        return $_GET;
    }

    protected function getRequestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    protected function validateRequired($data, $fields)
    {
        $errors = [];
        foreach ($fields as $field) {
            if (empty($data[$field])) {
                $errors[$field] = "El campo {$field} es requerido";
            }
        }
        return $errors;
    }
}
