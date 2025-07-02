<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (!Auth::check() || Auth::user()->rol->code != 'admin') {
                abort(403, 'No tienes permisos para acceder a esta sección.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $usuarios = User::with('rol')->orderBy('name')->paginate(20);
        return view('admin.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        $roles = Rol::all();
        return view('admin.usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::defaults()],
            'id_rol' => 'required|exists:roles,id_rol',
            'estado' => 'required|in:activo,suspendido,eliminado',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_rol' => $request->id_rol,
            'estado' => $request->estado,
        ]);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario creado correctamente.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $roles = Rol::all();
        return view('admin.usuarios.edit', compact('usuario', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $usuario = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'id_rol' => 'required|exists:roles,id_rol',
            'estado' => 'required|in:activo,suspendido,eliminado',
        ]);

        $data = [
            'name' => $request->name,
            'id_rol' => $request->id_rol,
            'estado' => $request->estado,
        ];

        // Solo actualizar contraseña si se proporciona
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy($id)
    {
        $usuario = User::findOrFail($id);

        // No permitir desactivar el usuario actual
        if ($usuario->id === Auth::id()) {
            return redirect()->route('admin.usuarios.index')->with('error', 'No puedes desactivar tu propia cuenta.');
        }

        $usuario->update(['estado' => 'suspendido']);
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario desactivado correctamente.');
    }

    public function activate($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->update(['estado' => 'activo']);
        return redirect()->route('admin.usuarios.index')->with('success', 'Usuario activado correctamente.');
    }
}
