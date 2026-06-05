<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Idioma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilIdiomaController extends Controller
{
    // FORM ASIGNAR
    public function create()
    {
        $idiomas = Idioma::all();
        return view('perfil.idioma_create', compact('idiomas'));
    }

    // GUARDAR EN PIVOT
    public function store(Request $request)
    {
        $request->validate([
            'idioma_id' => 'required|exists:idiomas,id',
            'nivel' => 'required|integer|min:1|max:5'
        ]);

        $perfil = Perfil::where('user_id', Auth::id())->firstOrFail();

        $perfil->idiomas()->attach($request->idioma_id, [
            'nivel' => (int) $request->nivel
        ]);

        return redirect()->route('perfil.index')
            ->with('success', 'Idioma agregado al perfil');
    }

    // EDITAR NIVEL
    public function edit(int $id)
    {
        $perfil = Perfil::where('user_id', Auth::id())->firstOrFail();

        $idioma = $perfil->idiomas()
            ->where('idioma_id', $id)
            ->firstOrFail();

        return view('perfil.idioma_edit', compact('idioma'));
    }

    // ACTUALIZAR NIVEL
    public function update(Request $request, int $id)
    {
        $request->validate([
            'nivel' => 'required|integer|min:1|max:5'
        ]);

        $perfil = Perfil::where('user_id', Auth::id())->firstOrFail();

        $perfil->idiomas()->updateExistingPivot($id, [
            'nivel' => (int) $request->nivel
        ]);

        return redirect()->route('perfil.index')
            ->with('success', 'Nivel de idioma actualizado');
    }

    // ELIMINAR DEL PERFIL
    public function destroy(int $id)
    {
        $perfil = Perfil::where('user_id', Auth::id())->firstOrFail();

        $perfil->idiomas()->detach($id);

        return redirect()->route('perfil.index')
            ->with('success', 'Idioma eliminado del perfil');
    }
}