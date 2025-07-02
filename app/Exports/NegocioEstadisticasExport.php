<?php

namespace App\Exports;

use App\Models\Negocio\Negocio;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;

class NegocioEstadisticasExport implements FromView
{
    protected $negocio;
    protected $estadisticas;

    public function __construct(Negocio $negocio, array $estadisticas)
    {
        $this->negocio = $negocio;
        $this->estadisticas = $estadisticas;
    }

    public function view(): View
    {
        return view('negocios.estadisticas-excel', [
            'negocio' => $this->negocio,
            'estadisticas' => $this->estadisticas,
        ]);
    }
}
