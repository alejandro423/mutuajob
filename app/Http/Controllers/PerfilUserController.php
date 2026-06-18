<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PerfilUserController extends Controller
{
    // LISTAR
    public function index()
    {
        $perfiles = Perfil::orderBy('id', 'desc')
            ->when(request('buscar'), function ($query) {
                $query->where('nombre', 'like', '%' . request('buscar') . '%');
            })
            ->paginate(5);

        return view(
            'administrador.perfiles_user.index',
            compact('perfiles')
        );
    }

    // FORM CREAR
    public function create()
    {
        return view('administrador.perfiles_user.create');
    }

    // GUARDAR
    public function store(Request $request)
    {
        $validated = $request->validate([

            'nombre' => 'required|string|max:255',

            'apellido' => 'nullable|string|max:255',

            'telefono' => 'nullable|string|max:20',

            'ubicacion' => 'nullable|string|max:255',

            'email' => 'required|email|max:255',

            'resumen_profesional' => 'nullable|string',

            'foto' => 'nullable|string',

        ]);

        Perfil::create($validated);

        return redirect()
            ->route('administrador.perfiles_user.index')
            ->with(
                'success',
                'Perfil creado correctamente.'
            );
    }

    // MOSTRAR
    public function show(int $id)
{
    $perfil = Perfil::with([
        'habilidades',
        'idiomas',
        'certificaciones',
        'experiencias'
    ])->findOrFail($id);

    return view(
        'administrador.perfiles_user.show',
        compact('perfil')
    );
}
    // FORM EDITAR
    public function edit(int $id)
    {
        $perfil = Perfil::findOrFail($id);

        return view(
            'administrador.perfiles_user.edit',
            compact('perfil')
        );
    }

    // ACTUALIZAR
    public function update(Request $request, int $id)
    {
        $perfil = Perfil::findOrFail($id);

        $validated = $request->validate([

            'nombre' => 'required|string|max:255',

            'apellido' => 'nullable|string|max:255',

            'telefono' => 'nullable|string|max:20',

            'ubicacion' => 'nullable|string|max:255',

            'email' => 'required|email|max:255',

            'resumen_profesional' => 'nullable|string',

            'foto' => 'nullable|string',

        ]);

        $perfil->update($validated);

        return redirect()
            ->route('administrador.perfiles_user.index')
            ->with(
                'success',
                'Perfil actualizado correctamente.'
            );
    }

    // ELIMINAR
    public function adminBloquear(int $id)
{
    $perfil = Perfil::findOrFail($id);

    $perfil->update([
        'estado' => false,
        'bloqueado' => true
    ]);

    return back()->with('success', 'Perfil bloqueado');
}
public function adminDesbloquear(int $id)
{
    $perfil = Perfil::findOrFail($id);

    $perfil->update([
        'bloqueado' => false
    ]);

    return back()->with('success', 'Perfil desbloqueado');
}
}