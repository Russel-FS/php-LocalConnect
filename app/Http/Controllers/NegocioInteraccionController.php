<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NegocioFavorito;
use App\Models\Negocio\MeGusta;
use App\Models\Negocio\Negocio;

class NegocioInteraccionController extends Controller
{
    // Favoritos
    public function agregarFavorito($id)
    {
        $user = Auth::user();
        if (!NegocioFavorito::where('id_usuario', $user->id_usuario)->where('id_negocio', $id)->exists()) {
            NegocioFavorito::create([
                'id_usuario' => $user->id_usuario,
                'id_negocio' => $id,
            ]);
        }
        return back();
    }

    public function quitarFavorito($id)
    {
        $user = Auth::user();
        NegocioFavorito::where('id_usuario', $user->id_usuario)->where('id_negocio', $id)->delete();
        return back();
    }

    // Me gusta
    public function agregarMeGusta($id)
    {
        $user = Auth::user();
        if (!MeGusta::where('id_usuario', $user->id_usuario)->where('id_negocio', $id)->exists()) {
            MeGusta::create([
                'id_usuario' => $user->id_usuario,
                'id_negocio' => $id,
            ]);
        }
        return back();
    }

    public function quitarMeGusta($id)
    {
        $user = Auth::user();
        MeGusta::where('id_usuario', $user->id_usuario)->where('id_negocio', $id)->delete();
        return back();
    }
}
