<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfertaController extends Controller
{
    // LISTAR OFERTAS DEL USUARIO LOGUEADO
    public function index()
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $ofertas = Oferta::where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('oferta.index', compact('ofertas'));
    }

    // MOSTRAR FORMULARIO CREAR
    public function create()
    {
        return view('oferta.oferta_create');
    }

    // GUARDAR OFERTA
    public function store(Request $request)
    {
        Oferta::create($request->validate([

            'titulo' => 'required|string|max:255',

            'descripcion' => 'required|string',

            'ubicacion' => 'nullable|string|max:255',

            'numero_contacto' => 'nullable|string|max:50',

            'email_contacto' => 'nullable|email|max:255',

            'requisitos_indispensables' => 'nullable|string',

            'requisitos_deseables' => 'nullable|string',

            'salario' => 'nullable|numeric',

            'modalidad' => 'required|string|max:100',

            'tipo_empleo' => 'required|string|max:100',

            'vacantes' => 'required|integer|min:1',

            'fecha_limite' => 'nullable|date',

        ]) + [

            'user_id' => Auth::id(),

            'estado' => 1,

        ]);

        return redirect()->route('oferta.index')
            ->with('success', 'Oferta creada correctamente');
    }

    // MOSTRAR UNA OFERTA
    public function show(int $id)
    {
        $oferta = Oferta::findOrFail($id);

        return view('oferta.show', compact('oferta'));
    }

    // MOSTRAR FORMULARIO EDITAR
    public function edit(int $id)
    {
        $oferta = Oferta::findOrFail($id);

        return view('oferta.oferta_edit', compact('oferta'));
    }

    // ACTUALIZAR OFERTA
    public function update(Request $request, int $id)
    {
        $oferta = Oferta::findOrFail($id);

        $oferta->update($request->validate([

            'titulo' => 'required|string|max:255',

            'descripcion' => 'required|string',

            'ubicacion' => 'nullable|string|max:255',

            'numero_contacto' => 'nullable|string|max:50',

            'email_contacto' => 'nullable|email|max:255',

            'requisitos_indispensables' => 'nullable|string',

            'requisitos_deseables' => 'nullable|string',

            'salario' => 'nullable|numeric',

            'modalidad' => 'required|string|max:100',

            'tipo_empleo' => 'required|string|max:100',

            'vacantes' => 'required|integer|min:1',

            'fecha_limite' => 'nullable|date',

        ]));

        return redirect()->route('oferta.index')
            ->with('success', 'Oferta actualizada correctamente');
    }

    // ELIMINAR OFERTA
    public function destroy(int $id)
    {
        $oferta = Oferta::findOrFail($id);

        $oferta->delete();

        return redirect()->route('oferta.index')
            ->with('success', 'Oferta eliminada correctamente');
    }
}