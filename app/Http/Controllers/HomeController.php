<?php

namespace App\Http\Controllers;

use App\Models\Oferta;
use App\Models\Perfil;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
{
    $user = Auth::user();

    $ofertas = collect();
    $perfiles = collect();

    if ($user && $user->roles()->where('nombre', 'trabajador')->exists()) {

        $ofertas = Oferta::where('estado', 1)->latest()->get();
    }

    if ($user && $user->roles()->where('nombre', 'empleador')->exists()) {

        $perfiles = Perfil::where('estado', 1)->latest()->get();
    }

    if ($user && $user->roles()->where('nombre', 'administrador')->exists()) {

        $ofertas = Oferta::latest()->get();
        $perfiles = Perfil::latest()->get();
    }

    return view('inicio', compact('ofertas', 'perfiles'));
}
public function candidatos($id)
{
    $oferta = Oferta::findOrFail($id);

    $perfiles = Perfil::all();

    return view('oferta.candidatos', compact('oferta', 'perfiles'));
}
}