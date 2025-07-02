<?php

namespace App\Http\Controllers;

use App\Models\Negocio\MeGusta;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function perfil()
    {
        $user = Auth::user();
        $negocios = $user->negocios()->with('ubicacion')->get();
        $favoritos = $user->favoritos()->with('negocio.ubicacion')->get();
        $meGusta = MeGusta::where('id_usuario', $user->id_usuario)->with('negocio.ubicacion')->get();
        return view('usuarios.perfil', compact('user', 'negocios', 'favoritos', 'meGusta'));
    }

    /**
     * Mostrar formulario de edición de perfil
     */
    public function editarPerfil()
    {
        $user = Auth::user();
        return view('usuarios.editar-perfil', compact('user'));
    }

    /**
     * Actualizar datos del perfil
     */
    public function actualizarPerfil(Request $request)
    {
        $user = Auth::user();
        $validated = $request->validate(
            [
                'name' => 'required|string|max:100',
                'telefono' => 'nullable|string|max:20',
            ],
            [
                'name.required' => 'El nombre es obligatorio.',
                'name.max' => 'El nombre no puede tener más de 100 caracteres.',
                'telefono.max' => 'El teléfono no puede tener más de 20 caracteres.',
            ]
        );
        $user->update($validated);
        return back()->with('success', 'Perfil actualizado correctamente.');
    }

    /**
     * Mostrar formulario para cambiar contraseña
     */
    public function editarPassword()
    {
        return view('usuarios.cambiar-password');
    }

    /**
     * Actualizar contraseña del usuario
     */
    public function actualizarPassword(Request $request)
    {
        $user = Auth::user();
        $request->validate(
            [
                'current_password' => 'required',
                'new_password' => 'required|string|min:8|confirmed',
            ],
            [
                'current_password.required' => 'La contraseña actual es obligatoria.',
                'new_password.required' => 'La nueva contraseña es obligatoria.',
                'new_password.min' => 'La nueva contraseña debe tener al menos 8 caracteres.',
                'new_password.confirmed' => 'Las contraseñas no coinciden.',
            ]
        );
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'La contraseña actual no es correcta.']);
        }
        $user->password = Hash::make($request->new_password);
        $user->save();
        return back()->with('success', 'Contraseña actualizada correctamente.');
    }
}
