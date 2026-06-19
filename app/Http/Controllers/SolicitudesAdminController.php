<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Solicitudes;
use Illuminate\Http\Request;

class SolicitudesAdminController extends Controller
{
    /**
     * LISTAR TODAS LAS SOLICITUDES
     */
    public function index()
    {
        $solicitudes = Solicitudes::with(['perfil', 'oferta'])
            ->latest()
            ->get();

        return view('administrador.solicitudes_user.index', compact('solicitudes'));
    }

    /**
     * VER UNA SOLICITUD
     */
    public function show(int $id)
    {
        $solicitud = Solicitudes::with(['perfil', 'oferta'])
            ->findOrFail($id);

        return view('administrador.solicitudes_user.show', compact('solicitud'));
    }

    /**
     * EDITAR SOLICITUD
     */
    public function edit(int $id)
    {
        $solicitud = Solicitudes::with(['perfil', 'oferta'])
            ->findOrFail($id);

        return view('administrador.solicitudes_user.edit', compact('solicitud'));
    }

    /**
     * ACTUALIZAR ESTADO
     */
    public function update(Request $request, int $id)
    {
        $solicitud = Solicitudes::findOrFail($id);

        $request->validate([
            'estado' => 'required|in:pendiente,aceptada,rechazada'
        ]);

        $solicitud->update([
            'estado' => $request->estado
        ]);

        return back()->with('success', 'Solicitud actualizada correctamente');
    }

    /**
     * ACEPTAR
     */
    public function aceptar(int $id)
    {
        $solicitud = Solicitudes::findOrFail($id);

        $solicitud->update([
            'estado' => 'aceptada'
        ]);

        return back()->with('success', 'Solicitud aceptada');
    }

    /**
     * RECHAZAR
     */
    public function rechazar(int $id)
    {
        $solicitud = Solicitudes::findOrFail($id);

        $solicitud->update([
            'estado' => 'rechazada'
        ]);

        return back()->with('success', 'Solicitud rechazada');
    }
}