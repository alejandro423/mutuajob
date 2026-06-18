<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class OfertaController extends Controller
{
    // LISTAR OFERTAS DEL USUARIO LOGUEADO
    public function index(Request $request)
{
    if (!Auth::check()) {
        return redirect('/login');
    }

    $query = Oferta::where('user_id', Auth::id());

    $filtro = $request->get('filtro', 'todo');

    switch ($filtro) {

        case 'hoy':
            $query->whereDate('created_at', now()->toDateString());
            break;

        case 'semana':
            $query->whereBetween('created_at', [
                now()->startOfWeek(),
                now()->endOfWeek()
            ]);
            break;

        case 'mes':
            $query->whereMonth('created_at', now()->month)
                  ->whereYear('created_at', now()->year);
            break;

        case 'todo':
        default:
            // sin filtros
            break;
    }

    $ofertas = $query->latest()->get();

    return view('oferta.index', compact('ofertas', 'filtro'));
}

    // MOSTRAR FORMULARIO CREAR
    public function create()
    {
        return view('oferta.oferta_create');
    }

    // GUARDAR OFERTA
    public function store(Request $request)
    {
        $validated = $request->validate([
        'titulo' => 'required|string|max:255',

        'descripcion' => 'required|string|min:20',

        'ubicacion' => 'nullable|string|max:255',

        'numero_contacto' => [
        'nullable',
        'string',
        'max:20',
        'regex:/^[0-9+\-\s]+$/'
        ],

        'email_contacto' => 'nullable|email|max:255',

        'requisitos_indispensables' => 'nullable|string',
        'requisitos_deseables' => 'nullable|string',

        'salario' => 'nullable|numeric|min:0',

        'modalidad' => 'required|string|max:100',

        'tipo_empleo' => 'required|string|max:100',

        'vacantes' => 'required|integer|min:1|max:100',

        'fecha_limite' => 'nullable|date|after_or_equal:today',
        ]);

        Oferta::create($validated + [
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

        $validated = $request->validate([
    'titulo' => 'required|string|max:255',
    'descripcion' => 'required|string|min:20',
    'ubicacion' => 'nullable|string|max:255',

    'numero_contacto' => [
        'nullable',
        'string',
        'max:20',
        'regex:/^[0-9+\-\s]+$/'
    ],

    'email_contacto' => 'nullable|email|max:255',

    'requisitos_indispensables' => 'nullable|string',
    'requisitos_deseables' => 'nullable|string',

    'salario' => 'nullable|numeric|min:0|max:100000',

    'modalidad' => 'required|string|max:100',

    'tipo_empleo' => 'required|string|max:100',

    'vacantes' => 'required|integer|min:1|max:100',

    'fecha_limite' => 'nullable|date|after_or_equal:today',
]);

        $oferta->update($validated);

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
    public function toggleEstado(int $id)
{
    $oferta = Oferta::findOrFail($id);

    // 🚨 si está bloqueada por admin, no se puede cambiar
    if ($oferta->bloqueada) {
        return back()->with('error', 'La oferta está bloqueada por el administrador');
    }

    $oferta->update([
        'estado' => !$oferta->estado
    ]);

    return back()->with(
        'success',
        $oferta->estado ? 'Oferta activada' : 'Oferta cerrada'
    );
}
    public function pdf(int $id)
{
    $oferta = Oferta::findOrFail($id);

    $pdf = Pdf::loadView(
        'oferta.pdf',
        compact('oferta')
    );

    return $pdf->download(
        'oferta_'.$oferta->id.'.pdf'
    );
}
}