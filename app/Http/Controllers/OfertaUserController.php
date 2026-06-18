<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;

class OfertaUserController extends Controller
{
    // LISTAR
    public function index()
    {
        $ofertas = Oferta::with('user')
            ->orderBy('id', 'desc')
            ->when(request('buscar'), function ($query) {
                $query->where('titulo', 'like', '%' . request('buscar') . '%');
            })
            ->paginate(5);

        return view(
            'administrador.ofertas.index',
            compact('ofertas')
        );
    }

    // MOSTRAR
    public function show(int $id)
    {
        $oferta = Oferta::with([
            'user',
            'solicitudes'
        ])->findOrFail($id);

        return view(
            'administrador.ofertas.show',
            compact('oferta')
        );
    }

    // FORM EDITAR
    public function edit(int $id)
    {
        $oferta = Oferta::findOrFail($id);

        return view(
            'administrador.ofertas.edit',
            compact('oferta')
        );
    }

    // ACTUALIZAR
    public function update(Request $request, int $id)
{
    $oferta = Oferta::findOrFail($id);

    if ($oferta->bloqueada) {
        return back()->with('error', 'Oferta bloqueada por administrador');
    }

    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'descripcion' => 'required|string|min:20',
        'ubicacion' => 'nullable|string|max:255',
        'numero_contacto' => ['nullable','string','max:20','regex:/^[0-9+\-\s]+$/'],
        'email_contacto' => 'nullable|email|max:255',
        'requisitos_indispensables' => 'nullable|string',
        'requisitos_deseables' => 'nullable|string',
        'salario' => 'nullable|numeric|min:0|max:100000',
        'modalidad' => 'required|string|max:100',
        'tipo_empleo' => 'required|string|max:100',
        'vacantes' => 'required|integer|min:1|max:100',
        'fecha_limite' => 'nullable|date',
    ]);

    $oferta->update($validated);

    return redirect()
        ->route('administrador.ofertas.index')
        ->with('success', 'Oferta actualizada correctamente.');
}
    // BLOQUEAR
public function adminBloquear(int $id)
{
    $oferta = Oferta::findOrFail($id);

    if ($oferta->bloqueada) {
        return back()->with('error', 'La oferta ya está bloqueada');
    }

    $oferta->update([
        'estado' => false,
        'bloqueada' => true
    ]);

    return back()->with('success', 'Oferta bloqueada por administrador');
}
    // DESBLOQUEAR
    public function adminDesbloquear(int $id)
{
    $oferta = Oferta::findOrFail($id);

    if (!$oferta->bloqueada) {
        return back()->with('error', 'La oferta no está bloqueada');
    }

    $oferta->update([
        'bloqueada' => false,
        'estado' => true
    ]);

    return back()->with('success', 'Oferta desbloqueada correctamente');
}
}