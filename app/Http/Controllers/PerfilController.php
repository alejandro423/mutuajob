<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PerfilController extends Controller
{
    public function index()
    {
        if (!Auth::check()) {

            return redirect('/login');

        }

        $perfil = Perfil::with([

            'habilidades',
            'idiomas',
            'certificaciones',
            'experiencias'

        ])
        ->where('user_id', Auth::id())
        ->first();

        return view('perfil.index', compact('perfil'));
    }

    public function edit(int $id)
    {
        $perfil = Perfil::findOrFail($id);

        return view(
            'perfil.perfil_edit',
            compact('perfil')
        );
    }

    public function update(Request $request, int $id)
    {
        $perfil = Perfil::findOrFail($id);

        $data = $request->validate([

            'nombre' => 'required|string|max:255',

            'apellido' => 'nullable|string|max:255',
            'dni' => 'nullable|digits:8|unique:perfil,dni,' . $perfil->id,

            'fecha_nacimiento' => 'nullable|date|before_or_equal:' . now()->subYears(18)->format('Y-m-d'),

            'sexo' => 'nullable|in:masculino,femenino,otro',

            'telefono' => 'nullable|string|max:20',

            'ubicacion' => 'nullable|string|max:255',

            'email' => 'required|email',

            'profesion' => 'nullable|string|max:255',

            'resumen_profesional' => 'nullable|string',

            'linkedin' => 'nullable|url',

            'github' => 'nullable|url',

            'portafolio' => 'nullable|url',

            'disponibilidad' => 'nullable|in:tiempo_completo,medio_tiempo,freelance,practicas',

            'modalidad' => 'nullable|in:presencial,remoto,hibrido',

            'salario_esperado' => 'nullable|numeric|min:0',

            'foto' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            'cv' => 'nullable|mimes:pdf,doc,docx|max:5120',

        ], [

            'dni.unique' => 'Este DNI ya está registrado.',

            'email.email' => 'Ingresa un correo válido.',

            'linkedin.url' => 'Ingresa una URL válida para LinkedIn.',

            'github.url' => 'Ingresa una URL válida para GitHub.',

            'portafolio.url' => 'Ingresa una URL válida para el portafolio.',

            'foto.image' => 'El archivo debe ser una imagen.',

            'foto.mimes' => 'La foto debe ser JPG, JPEG, PNG o WEBP.',

            'foto.max' => 'La foto no debe superar los 2MB.',

            'cv.mimes' => 'El CV debe ser PDF, DOC o DOCX.',

            'cv.max' => 'El CV no debe superar los 5MB.',

        ]);

        if ($request->hasFile('foto')) {

            $rutaFoto = $request->file('foto')
                                ->store('perfiles', 'public');

            $data['foto'] = $rutaFoto;
        }

        if ($request->hasFile('cv')) {

            $rutaCv = $request->file('cv')
                              ->store('cv', 'public');

            $data['cv'] = $rutaCv;
        }

        $perfil->update($data);

        return redirect()
            ->route('perfil.index');
    }

    public function pdf()
    {
        $perfil = Perfil::with([

            'habilidades',
            'idiomas',
            'certificaciones',
            'experiencias'

        ])
        ->where('user_id', Auth::id())
        ->firstOrFail();

        $pdf = Pdf::loadView(
            'perfil.pdf',
            compact('perfil')
        );

        return $pdf->download('mi_perfil.pdf');
    }
    public function toggleEstado(int $id)
{
    $perfil = Perfil::findOrFail($id);

    // SEGURIDAD
    if ($perfil->user_id != Auth::id()) {

        return back()->with('error', 'No autorizado');

    }

    $perfil->update([

        'estado' => !$perfil->estado

    ]);

    return back()->with(
        'success',
        $perfil->estado
            ? 'Perfil habilitado'
            : 'Perfil deshabilitado'
    );
}

}