<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use Illuminate\Support\Facades\Auth;

class BitacoraController extends Controller
{
    // LISTAR BITACORA
    public function index()
    {
        $bitacoras = Bitacora::with('user')
            ->latest()
            ->paginate(10);

        return view('administrador.bitacora.index', compact('bitacoras'));
    }
}