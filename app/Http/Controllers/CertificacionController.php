<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Certificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CertificacionController extends Controller
{
    public function create()
    {
        return view('perfil.certificacion_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255',
            'institucion' => 'nullable|max:255',
            'descripcion' => 'nullable'
        ]);

        $certificacion = Certificacion::create([
            'nombre' => $request->nombre,
            'institucion' => $request->institucion,
            'descripcion' => $request->descripcion
        ]);

        $perfil = Perfil::where('user_id', Auth::id())->first();

        if ($perfil) {
            $perfil->certificaciones()->attach($certificacion->id);
        }

        return redirect()
            ->route('perfil.index')
            ->with('success', 'Certificación agregada correctamente');
    }

    public function destroy(int $id)
    {
        $certificacion = Certificacion::findOrFail($id);

        $perfil = Perfil::where('user_id', Auth::id())->first();

        if ($perfil) {
            $perfil->certificaciones()->detach($certificacion->id);
        }

        return back()->with('success', 'Certificación eliminada');
    }
    public function edit(int $id)
    {
        $certificacion = Certificacion::findOrFail($id);

        return view('perfil.certificacion_edit', compact('certificacion'));
    }
    public function update(Request $request, int $id)
    {
        $certificacion = Certificacion::findOrFail($id);

        $certificacion->update($request->validate([
            'nombre' => 'required|max:255',
            'institucion' => 'nullable|max:255',
            'descripcion' => 'nullable'
        ]));

        return redirect()
            ->route('perfil.index')
            ->with('success', 'Certificación actualizada correctamente');
    }
}