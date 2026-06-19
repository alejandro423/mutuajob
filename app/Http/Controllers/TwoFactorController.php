<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PragmaRX\Google2FA\Google2FA;
use PragmaRX\Google2FAQRCode\Google2FA as Google2FAQRCode;
use Illuminate\Support\Facades\Auth;

class TwoFactorController extends Controller
{
    public function showEnable2FA()
    {
        /** @var \Illuminate\Database\Eloquent\Model $user */
        $user = Auth::user();

        $google2fa = new Google2FA();
        $google2faQR = new Google2FAQRCode();

        $secret = $google2fa->generateSecretKey();

        $user->google2fa_secret = $secret;
        $user->google2fa_enabled = true;
        $user->save();

        $qr = $google2faQR->getQRCodeInline(
            config('app.name'),
            $user->email,
            $secret
        );

        return view('2fa.enable', compact('qr', 'secret'));
    }
    public function verify2FA(Request $request)
{
    $request->validate([
        'code' => 'required'
    ]);

    $user = Auth::user();

    $google2fa = new Google2FA();

    $valid = $google2fa->verifyKey(
        $user->google2fa_secret,
        $request->code
    );

    if (!$valid) {
        return back()->withErrors(['code' => 'Código inválido']);
    }

    session(['2fa_passed' => true]);

    return redirect('/inicio');
}
public function confirmEnable2FA(Request $request)
{
            /** @var \Illuminate\Database\Eloquent\Model $user */

    $user = Auth::user();

    $google2fa = new Google2FA();

    $valid = $google2fa->verifyKey(
        $user->google2fa_secret,
        $request->code
    );

    if (!$valid) {
        return back()->withErrors(['code' => 'Código inválido']);
    }

    $user->google2fa_enabled = true;
    $user->save();

    return redirect('/inicio')->with('success', '2FA activado correctamente');
}
}