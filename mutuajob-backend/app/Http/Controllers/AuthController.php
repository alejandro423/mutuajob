<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Perfil;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use PragmaRX\Google2FA\Google2FA;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/inicio');
        }

        return back()->withErrors([
            'email' => 'Correo o contraseña incorrectos.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'role' => 'required'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    // asignar rol al usuario
    $role = Role::where('nombre', $request->role)->first();
    $user->roles()->attach($role->id);

     // Crear perfil automáticamente si es trabajador
    if ($request->role === 'trabajador') {
        Perfil::create([
    'user_id' => $user->id,
    'nombre' => $request->name,
    'email' => $request->email,
]);
    }

    Auth::login($user);

    return redirect('/inicio');
}
public function apiLogin(Request $request)
{
    $credentials = $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json([
            'success' => false,
            'message' => 'Credenciales incorrectas'
        ], 401);
    }

    return response()->json([
    'success' => true,
    'token' => $token,
    'user' => [
        'id' => Auth::user()->id,
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'roles' => Auth::user()->roles->pluck('nombre')
    ]
]);
}

public function me()
{
    return response()->json(Auth::user());
}
public function verify2FA(Request $request)
{
    $request->validate([
        'user_id' => 'required',
        'code' => 'required'
    ]);

    $user = User::find($request->user_id);

    if (!$user || !$user->two_factor_secret) {
        return response()->json(['message' => '2FA no configurado'], 400);
    }

    $google2fa = new Google2FA();

    $valid = $google2fa->verifyKey(
        $user->two_factor_secret,
        $request->code
    );

    if (!$valid) {
        return response()->json(['message' => 'Código inválido'], 401);
    }

    // 🔥 AQUÍ recién generas JWT
    $token = JWTAuth::fromUser($user);

    return response()->json([
        'token' => $token,
        'user' => $user
    ]);
}
public function enable2FA(Request $request)
{
    $user = $request->user();

    $google2fa = new Google2FA();

    $user->two_factor_secret = $google2fa->generateSecretKey();
    $user->save();

    return response()->json([
        'secret' => $user->two_factor_secret
    ]);
}
}