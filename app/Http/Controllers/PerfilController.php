<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilController extends Controller
{
    // LISTAR PERFIL DEL USUARIO LOGUEADO
    public function index()
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $perfil = Perfil::with(['habilidades', 'idiomas'])
        ->where('email', Auth::user()->email)
        ->first();

    return view('perfil.index', compact('perfil'));
}

    // MOSTRAR FORMULARIO EDITAR
    public function edit(int $id)
    {
        $perfil = Perfil::findOrFail($id);

        return view('perfil.perfil_edit', compact('perfil'));
    }

    // ACTUALIZAR PERFIL
    public function update(Request $request, int $id)
    {
        $perfil = Perfil::findOrFail($id);

        $perfil->update($request->validate([
            'nombre' => 'required|string|max:255',
            'apellido' => 'nullable|string|max:255',
            'telefono' => 'nullable|string|max:20',
            'ubicacion' => 'nullable|string|max:255',
            'email' => 'required|email',
            'resumen_profesional' => 'nullable|string',
            'foto' => 'nullable|string'
        ]));

        return redirect()->route('perfil.index')
            ->with('success', 'Perfil actualizado correctamente');
    }
}