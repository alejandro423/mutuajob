<?php

namespace App\Http\Controllers;

use App\Models\Habilidad;
use Illuminate\Http\Request;

class HabilidadController extends Controller
{
    // LISTAR HABILIDADES
    public function index()
{
    $habilidades = Habilidad::orderBy('id', 'desc')
        ->paginate(10);

    return view(
        'administrador.habilidades.index',
        compact('habilidades')
    );
}

    // FORMULARIO CREAR
    public function create()
    {
        return view('administrador.habilidades.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $habilidadExistente = Habilidad::where(
            'nombre',
            $validated['nombre']
        )->first();

        if ($habilidadExistente) {

            return back()->with(
                'error',
                'Esta habilidad ya existe.'
            );
        }

        Habilidad::create([
            'nombre' => $validated['nombre']
        ]);

        return redirect()
            ->route('administrador.habilidades.index')
            ->with(
                'success',
                'Habilidad creada correctamente'
            );
    }

    // FORMULARIO EDITAR
    public function edit(int $id)
    {
        $habilidad = Habilidad::findOrFail($id);

        return view(
            'administrador.habilidades.edit',
            compact('habilidad')
        );
    }

    // ACTUALIZAR
    public function update(Request $request, int $id)
    {
        $habilidad = Habilidad::findOrFail($id);

        $request->validate([
            'nombre' => 'required|string|max:255'
        ]);

        $habilidad->update([
            'nombre' => $request->nombre
        ]);

        return redirect()
            ->route('administrador.habilidades.index')
            ->with(
                'success',
                'Habilidad actualizada correctamente'
            );
    }

    // ELIMINAR
    public function destroy(int $id)
    {
        $habilidad = Habilidad::findOrFail($id);

        $habilidad->delete();

        return redirect()
            ->route('administrador.habilidades.index')
            ->with(
                'success',
                'Habilidad eliminada correctamente'
            );
    }
}