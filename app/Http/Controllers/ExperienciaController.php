<?php

namespace App\Http\Controllers;

use App\Models\Experiencia;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExperienciaController extends Controller
{
    /**
     * Formulario crear experiencia
     */
    public function create()
    {
        return view('perfil.experiencia_create');
    }

    /**
     * Guardar experiencia
     */
    public function store(Request $request)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'tipo_empleo' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);

        $perfil = Perfil::where('user_id', Auth::id())->first();

        if (!$perfil) {
            return redirect()->back()
                ->with('error', 'Primero debes crear tu perfil.');
        }

        Experiencia::create([
            'perfil_id' => $perfil->id,
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'tipo_empleo' => $request->tipo_empleo,
            'ubicacion' => $request->ubicacion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'trabajo_actual' => $request->has('trabajo_actual'),
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('perfil.index')
            ->with('success', 'Experiencia agregada correctamente.');
    }

    /**
     * Formulario editar
     */
    public function edit(int $id)
    {
        $experiencia = Experiencia::findOrFail($id);

        return view('perfil.experiencia_edit', compact('experiencia'));
    }

    /**
     * Actualizar experiencia
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'empresa' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'tipo_empleo' => 'nullable|string|max:255',
            'ubicacion' => 'nullable|string|max:255',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date',
            'descripcion' => 'nullable|string',
        ]);

        $experiencia = Experiencia::findOrFail($id);

        $experiencia->update([
            'empresa' => $request->empresa,
            'cargo' => $request->cargo,
            'tipo_empleo' => $request->tipo_empleo,
            'ubicacion' => $request->ubicacion,
            'fecha_inicio' => $request->fecha_inicio,
            'fecha_fin' => $request->fecha_fin,
            'trabajo_actual' => $request->has('trabajo_actual'),
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('perfil.index')
            ->with('success', 'Experiencia actualizada.');
    }

    /**
     * Eliminar experiencia
     */
    public function destroy(int $id)
    {
        $experiencia = Experiencia::findOrFail($id);

        $experiencia->delete();

        return redirect()->route('perfil.index')
            ->with('success', 'Experiencia eliminada.');
    }
}