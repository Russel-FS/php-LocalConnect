<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Negocio\Categoria;
use App\Services\CloudinaryService;
use Illuminate\Http\Request;

class AdminCategoriaController extends Controller
{
    protected $cloudinaryService;

    public function __construct(CloudinaryService $cloudinaryService)
    {
        $this->cloudinaryService = $cloudinaryService;
    }
    public function index()
    {
        $categorias = Categoria::orderBy('nombre_categoria')->paginate(20);
        return view('admin.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre_categoria' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'estado' => 'required|in:activo,suspendido,eliminado',
        ], [
            'nombre_categoria.required' => 'El nombre de la categoría es obligatorio.',
            'nombre_categoria.max' => 'El nombre no puede tener más de 100 caracteres.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'img_url.image' => 'El archivo debe ser una imagen.',
            'img_url.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, webp.',
            'img_url.max' => 'La imagen no puede ser mayor a 2MB.',
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $data = $request->only('nombre_categoria', 'descripcion', 'estado');

        // Subir imagen si se proporciona
        if ($request->hasFile('img_url')) {
            try {
                $data['img_url'] = $this->cloudinaryService->upload($request->file('img_url'), 'categorias');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }

        Categoria::create($data);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría creada correctamente.');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id)
    {
        $categoria = Categoria::findOrFail($id);
        $request->validate([
            'nombre_categoria' => 'required|string|max:100',
            'descripcion' => 'nullable|string|max:255',
            'img_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'estado' => 'required|in:activo,suspendido,eliminado',
        ], [
            'nombre_categoria.required' => 'El nombre de la categoría es obligatorio.',
            'nombre_categoria.max' => 'El nombre no puede tener más de 100 caracteres.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'img_url.image' => 'El archivo debe ser una imagen.',
            'img_url.mimes' => 'La imagen debe ser de tipo: jpeg, png, jpg, gif, webp.',
            'img_url.max' => 'La imagen no puede ser mayor a 2MB.',
            'estado.required' => 'Debe seleccionar un estado.',
            'estado.in' => 'El estado seleccionado no es válido.',
        ]);

        $data = $request->only('nombre_categoria', 'descripcion', 'estado');

        // Subir nueva imagen si se proporcionas
        if ($request->hasFile('img_url')) {
            try {
                $data['img_url'] = $this->cloudinaryService->upload($request->file('img_url'), 'categorias');
            } catch (\Exception $e) {
                return redirect()->back()->withInput()->with('error', 'Error al subir la imagen: ' . $e->getMessage());
            }
        }

        $categoria->update($data);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría actualizada correctamente.');
    }

    public function destroy($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update(['estado' => 'suspendido']);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría suspendida correctamente.');
    }

    public function activate($id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->update(['estado' => 'activo']);
        return redirect()->route('admin.categorias.index')->with('success', 'Categoría activada correctamente.');
    }
}
