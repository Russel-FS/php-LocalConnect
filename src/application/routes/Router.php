<?php

class Router
{
    private $routes = [];

    // Método para registrar rutas GET
    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    // Método para registrar rutas POST
    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    // Método principal que maneja las peticiones
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        // Si la ruta existe, ejecutar el callback
        if (isset($this->routes[$method][$path])) {
            $callback = $this->routes[$method][$path];

            // Si el callback es un string (Controller@method)
            if (is_string($callback)) {
                list($controller, $method) = explode('@', $callback);
                $controllerClass = "App\\Controllers\\{$controller}";
                $controllerInstance = new $controllerClass();
                return $controllerInstance->$method();
            }

            // Si es una función anónima
            return call_user_func($callback);
        }

        // Si la ruta no existe, mostrar 404
        header("HTTP/1.0 404 Not Found");
        echo "404 - Página no encontrada";
    }
}
