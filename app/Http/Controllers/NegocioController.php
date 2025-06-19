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

class NegocioController extends Controller
{
    public function showRegistro()
    {
        $serviciosPredefinidos = [
            new ServicioPredefinido(1, 'Desayuno', 'Servicio de desayuno'),
            new ServicioPredefinido(2, 'Almuerzo', 'Servicio de almuerzo'),
            new ServicioPredefinido(3, 'Delivery', 'Entrega a domicilio'),
        ];
        return view('negocios.registro', compact('serviciosPredefinidos'));
    }
}
