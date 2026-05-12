<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Certificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PerfilCertificacionController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'certificacion_id' => 'required|exists:certificaciones,id'
        ]);

        $perfil = Perfil::where('user_id', Auth::id())->first();

        if (!$perfil) {
            return back()->with('error', 'Perfil no encontrado');
        }

        $perfil->certificaciones()->attach($request->certificacion_id);

        return back()->with('success', 'Certificación agregada');
    }

    public function destroy(int $id)
    {
        $perfil = Perfil::where('user_id', Auth::id())->first();

        if (!$perfil) {
            return back()->with('error', 'Perfil no encontrado');
        }

        $perfil->certificaciones()->detach($id);

        return back()->with('success', 'Certificación eliminada');
    }
}