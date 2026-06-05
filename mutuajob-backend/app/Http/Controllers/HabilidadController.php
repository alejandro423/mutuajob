<?php

namespace App\Http\Controllers;

use App\Models\Habilidad;
use Illuminate\Http\Request;

class HabilidadController extends Controller
{
    // LISTAR CATALOGO
    public function index()
    {
        $habilidades = Habilidad::all();
        return view('habilidades.index', compact('habilidades'));
    }

    // FORM CREAR (CATALOGO)
    public function create()
    {
        $habilidades = Habilidad::all();
        return view('perfil.habilidad_create', compact('habilidades')); 
        
    }

    // GUARDAR CATALOGO
    public function store(Request $request)
{
    $validated = $request->validate([
        'nombre' => 'required|string|max:255'
    ]);

    $habilidadExistente = Habilidad::where('nombre', $validated['nombre'])->first();

    if ($habilidadExistente) {

        return back()->with('error', 'Esta habilidad ya existe.');
    }

    Habilidad::create([
        'nombre' => $validated['nombre']
    ]);

    return redirect()->route('habilidades.index')
        ->with('success', 'Habilidad creada correctamente');
}

    // EDITAR
    public function edit(int $id)
    {
        $habilidad = Habilidad::findOrFail($id);
        return view('perfil.habilidad_edit', compact('habilidad'));
    }

    // ACTUALIZAR
    public function update(Request $request, int $id)
    {
        $habilidad = Habilidad::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $habilidad->update($request->only('nombre'));

        return redirect()->route('habilidades.index')
            ->with('success', 'Habilidad actualizada');
    }

    // ELIMINAR
    public function destroy(int $id)
    {
        Habilidad::findOrFail($id)->delete();

        return redirect()->route('habilidades.index')
            ->with('success', 'Habilidad eliminada');
    }
}