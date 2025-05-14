<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function mostrarLogin()
    {
        return view('auth.login');
    }

    public function autenticar(Request $request)
    {
        $credenciales = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['Email' => $credenciales['email'], 'Contraseña' => $credenciales['password']])) {
            return redirect()->route('dashboard'); // Redirigir a un dashboard
        }

        return back()->withErrors(['email' => 'Credenciales incorrectas']);
    }

    public function cerrarSesion()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
