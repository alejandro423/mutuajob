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
        $data = $request->validate([

            'nombre' => 'required|max:255',

            'institucion' => 'nullable|max:255',

            'descripcion' => 'nullable',

            'fecha_obtencion' => 'nullable|date',

            'fecha_expiracion' => 'nullable|date',

            'evidencia' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'

        ]);

        // GUARDAR EVIDENCIA
        if ($request->hasFile('evidencia')) {

            $ruta = $request->file('evidencia')
                             ->store('certificaciones', 'public');

            $data['evidencia'] = $ruta;
        }

        $certificacion = Certificacion::create($data);

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

        $data = $request->validate([

            'nombre' => 'required|max:255',

            'institucion' => 'nullable|max:255',

            'descripcion' => 'nullable',

            'fecha_obtencion' => 'nullable|date',

            'fecha_expiracion' => 'nullable|date',

            'evidencia' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'

        ]);

        // NUEVA EVIDENCIA
        if ($request->hasFile('evidencia')) {

            $ruta = $request->file('evidencia')
                             ->store('certificaciones', 'public');

            $data['evidencia'] = $ruta;
        }

        $certificacion->update($data);

        return redirect()
            ->route('perfil.index')
            ->with('success', 'Certificación actualizada correctamente');
    }
}