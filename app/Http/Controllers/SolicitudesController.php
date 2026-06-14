<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Perfil;
use App\Models\Oferta;
use App\Models\Solicitudes;
use Illuminate\Support\Facades\Auth;

class SolicitudesController extends Controller
{
    
  public function index()
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    /** @var \App\Models\User $user */
    $user = Auth::user();

    // 🔵 TRABAJADOR
    if ($user->roles()->where('nombre', 'trabajador')->exists()) {

        $perfil = Perfil::where('user_id', $user->id)->first();

        if (!$perfil) {
            return view('solicitudes.index', [
                'solicitudes' => collect()
            ]);
        }

        $solicitudes = Solicitudes::with(['oferta'])
            ->where('perfil_id', $perfil->id)
            ->latest()
            ->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    // 🟢 EMPLEADOR
    if ($user->roles()->where('nombre', 'empleador')->exists()) {

        $solicitudes = Solicitudes::with(['perfil', 'oferta'])
            ->where('tipo', 'postulacion')
            ->whereHas('oferta', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })
            ->latest()
            ->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    // 🔴 ADMIN
    if ($user->roles()->where('nombre', 'administrador')->exists()) {

        $solicitudes = Solicitudes::with(['perfil', 'oferta'])
            ->latest()
            ->get();

        return view('solicitudes.index', compact('solicitudes'));
    }

    return view('solicitudes.index', [
        'solicitudes' => collect()
    ]);
}
    public function postular(int $ofertaId)
{
    $perfil = Auth::user()->perfil;

    $existe = Solicitudes::where('perfil_id', $perfil->id)
        ->where('oferta_id', $ofertaId)
        ->where('tipo', 'postulacion')
        ->exists();

    if ($existe) {
        return back()->with(
            'error',
            'Ya te postulaste a esta oferta.'
        );
    }

    Solicitudes::create([
        'perfil_id' => $perfil->id,
        'oferta_id' => $ofertaId,
        'tipo' => 'postulacion',
        'estado' => 'pendiente'
    ]);

    return back()->with(
        'success',
        'Postulación enviada.'
    );
}
public function invitar(int $perfilId, int $ofertaId)
{
    $oferta = Oferta::where('id', $ofertaId)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $existe = Solicitudes::where('perfil_id', $perfilId)
        ->where('oferta_id', $ofertaId)
        ->where('tipo', 'invitacion')
        ->exists();

    if ($existe) {
        return back()->with('error', 'Ya existe una invitación.');
    }

    Solicitudes::create([
        'perfil_id' => $perfilId,
        'oferta_id' => $ofertaId,
        'tipo' => 'invitacion',
        'estado' => 'pendiente'
    ]);

    return back()->with('success', 'Invitación enviada.');
}
public function cambiarEstado(Request $request, int $id)
{
    $solicitud = Solicitudes::findOrFail($id);

    $request->validate([
        'estado' => 'required|in:pendiente,aceptada,rechazada'
    ]);

    $solicitud->update([
        'estado' => $request->estado
    ]);

    return back()->with('success', 'Estado actualizado');
}
}
