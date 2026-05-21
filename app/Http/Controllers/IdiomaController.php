<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    // LISTAR
    public function index()
    {
        $idiomas = Idioma::orderBy('id', 'desc')->paginate(5);

        return view('administrador.idiomas.index', compact('idiomas'));
    }

    // FORM CREAR
    public function create()
    {
        return view('administrador.idiomas.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        Idioma::create($validated);

        return redirect()
            ->route('administrador.idiomas.index')
            ->with('success', 'Idioma creado correctamente');
    }

    // FORM EDITAR
    public function edit(int $id)
    {
        $idioma = Idioma::findOrFail($id);

        return view('administrador.idiomas.edit', compact('idioma'));
    }

    // ACTUALIZAR
    public function update(Request $request, int $id)
    {
        $idioma = Idioma::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $idioma->update($validated);

        return redirect()
            ->route('administrador.idiomas.index')
            ->with('success', 'Idioma actualizado correctamente');
    }

    // ELIMINAR
    public function destroy(int $id)
    {
        $idioma = Idioma::findOrFail($id);

        $idioma->delete();

        return redirect()
            ->route('administrador.idiomas.index')
            ->with('success', 'Idioma eliminado correctamente');
    }
}