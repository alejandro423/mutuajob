<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    // LISTAR CATALOGO
    public function index()
    {
        $idiomas = Idioma::all();
        return view('idiomas.index', compact('idiomas'));
    }

    // FORM CREAR
    public function create()
    {
        $idiomas = Idioma::all();
        return view('perfil.idioma_create', compact('idiomas'));
    }

    // GUARDAR CATALOGO
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Idioma::create([
            'nombre' => $validated['nombre']
        ]);

        return redirect()->route('idiomas.index')
            ->with('success', 'Idioma creado correctamente');
    }

    // EDITAR
    public function edit(int $id)
    {
        $idioma = Idioma::findOrFail($id);
        return view('perfil.idioma_edit', compact('idioma'));
    }

    // ACTUALIZAR
    public function update(Request $request, int $id)
    {
        $idioma = Idioma::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $idioma->update($request->only('nombre'));

        return redirect()->route('idiomas.index')
            ->with('success', 'Idioma actualizado');
    }

    // ELIMINAR
    public function destroy(int $id)
    {
        Idioma::findOrFail($id)->delete();

        return redirect()->route('idiomas.index')
            ->with('success', 'Idioma eliminado');
    }
}