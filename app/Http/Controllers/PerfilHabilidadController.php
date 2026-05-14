<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Habilidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilHabilidadController extends Controller
{
    // FORM ASIGNAR
    public function create()
    {
        $habilidades = Habilidad::all();
        return view('perfil.habilidad_create', compact('habilidades'));
    }

    // GUARDAR EN PIVOT
    public function store(Request $request)
{
    $request->validate([
        'habilidad_id' => 'required',
        'nivel' => 'required'
    ]);

    $perfil = Perfil::where('user_id', Auth::id())->first();

    // Verificar si ya existe
    if ($perfil->habilidades()
        ->where('habilidad_id', $request->habilidad_id)
        ->exists()) {

        return back()->with('error', 'Esta habilidad ya fue agregada.');
    }

    // Agregar habilidad
    $perfil->habilidades()->attach($request->habilidad_id, [
        'nivel' => $request->nivel
    ]);

    return redirect()->route('perfil.index')
        ->with('success', 'Habilidad agregada al perfil');
}
    public function update(Request $request, int $id)
{
    $request->validate([
        'nivel' => 'required|integer|min:1|max:5'
    ]);

    $perfil = Perfil::where('user_id', Auth::id())->firstOrFail();

    $perfil->habilidades()->updateExistingPivot($id, [
        'nivel' => (int) $request->nivel
    ]);

    return redirect()->route('perfil.index')
        ->with('success', 'Nivel actualizado correctamente');
}
public function edit(int $id)
{
    $perfil = Perfil::where('user_id', Auth::id())->firstOrFail();

    $habilidad = $perfil->habilidades()
        ->where('habilidad_id', $id)
        ->firstOrFail();

    return view('perfil.habilidad_edit', compact('habilidad'));
}
    // ELIMINAR DEL PERFIL
    public function destroy(int $id)
    {
        $perfil = Perfil::where('user_id', Auth::id())->first();

        $perfil->habilidades()->detach($id);

        return redirect()->route('perfil.index');
    }
}