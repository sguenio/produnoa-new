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

        // Verificar si el usuario existe en la base de datos
        $usuario = \App\Models\Usuario::where('Email', $credenciales['email'])->first();

        if (!$usuario) {
            return back()->withErrors(['email' => 'Este usuario no está registrado.']);
        }

        // Intentar autenticar al usuario con la contraseña
        if (!Auth::attempt(['Email' => $credenciales['email'], 'password' => $credenciales['password']])) {
            return back()->withErrors(['password' => 'La contraseña ingresada es incorrecta.']);
        }

        // Si todo es correcto, redirigir al Dashboard
        $request->session()->regenerate();
        return redirect()->route('dashboard');
    }

    public function cerrarSesion(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
