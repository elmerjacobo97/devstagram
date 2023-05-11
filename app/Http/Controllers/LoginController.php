<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // Validar email y password
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);


        // Comprobar autenticación... y opción de recordar el inicio de sesión
        $credentials = $request->only('email', 'password');
        $remember = $request->remember;

        if (!auth()->attempt($credentials, $remember)) {
            return back()->with('error', 'Incorrect credentials');
        }

        // Redireccionar...
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
