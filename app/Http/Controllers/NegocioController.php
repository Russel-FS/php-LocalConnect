<?php

namespace App\Http\Controllers;

class ServicioPredefinido
{
    public $id_servicio_predefinido;
    public $nombre_servicio;
    public $descripcion;
    public function __construct($id, $nombre, $descripcion)
    {
        $this->id_servicio_predefinido = $id;
        $this->nombre_servicio = $nombre;
        $this->descripcion = $descripcion;
    }
}

class Categoria
{
    public $id_categoria;
    public $nombre_categoria;
    public function __construct($id, $nombre)
    {
        $this->id_categoria = $id;
        $this->nombre_categoria = $nombre;
    }
}

class NegocioController extends Controller
{
    public function showRegistro()
    {
        $serviciosPredefinidos = [
            new ServicioPredefinido(1, 'Desayuno', 'Servicio de desayuno'),
            new ServicioPredefinido(2, 'Almuerzo', 'Servicio de almuerzo'),
            new ServicioPredefinido(3, 'Delivery', 'Entrega a domicilio'),
        ];
        $categorias = [
            new Categoria(1, 'Restaurante'),
            new Categoria(2, 'Farmacia'),
            new Categoria(3, 'Ferretería'),
            new Categoria(4, 'Servicios'),
            new Categoria(5, 'Comercio'),
            new Categoria(6, 'Otros'),
        ];
        return view('negocios.registro', compact('serviciosPredefinidos', 'categorias'));
    }
}
