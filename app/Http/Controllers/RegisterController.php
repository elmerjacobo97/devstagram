<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Str;

class RegisterController extends Controller
{
    public function index()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        // Acceder datos del formulario
        // dd($request);
        // dd($request->get('username'));

        // Validation
        $this->validate($request, [
            'name' => 'required|string|min:3|max:60', // ['required', 'string', 'max:255']
            'username' => 'required|string|alpha_dash|min:3|max:20|unique:users,username',
            'email' => 'required|string|email|max:60|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Crear usuario
        User::create([
            'name' => $request->name,
            'username' => strtolower($request->input('username')), // Str::lower($request->username)
            'email' => $request->email,
            'password' => Hash::make($request->password), // bcrypt($request->password)
        ]);

        // Autenticar usuario
        // auth()->attempt(['email' => $request->email, 'password' => $request->password]);
        auth()->attempt($request->only('email', 'password'));

        // Redireccionar al muro
        return redirect()->route('posts.index', auth()->user()->username);
    }
}
