<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Oferta;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    /** @var \App\Models\User|null $user */
    $user = Auth::user();

    $ofertas = collect();
    $perfiles = collect();

    if ($user && $user->hasRole('trabajador')) {

        $ofertas = Oferta::where('estado', 1)
            ->latest()
            ->get();
    }

    if ($user && $user->hasRole('empleador')) {

        $perfiles = Perfil::with([
            'habilidades',
            'idiomas',
            'certificaciones',
            'experiencias'
        ])
        ->where('estado', 1)
        ->latest()
        ->get();
    }

    if ($user && $user->hasRole('administrador')) {

        $ofertas = Oferta::latest()->get();

        $perfiles = Perfil::with([
            'habilidades',
            'idiomas',
            'certificaciones',
            'experiencias'
        ])
        ->latest()
        ->get();
    }

    return view('inicio', compact('ofertas', 'perfiles'));
}

public function candidatos(int $id)
{
    $oferta = Oferta::findOrFail($id);

    $perfiles = Perfil::with([
        'habilidades',
        'idiomas',
        'certificaciones',
        'experiencias'
    ])->get();

    return view('oferta.candidatos', compact('oferta', 'perfiles'));
}
}