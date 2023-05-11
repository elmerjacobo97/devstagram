<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    // Para acceder a este controlador debe estar autenticado
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(User $user)
    {
        $this->authorize('edit-profile', $user);
        return view('profile.index');
    }

    public function store(Request $request, User $user)
    {
        // Validar
        $this->validate($request, [
            'username' => ['required', 'string', 'alpha_dash', 'min:3', 'max:20', 'unique:users,username,' . auth()->user()->id, 'not_in:twitter,instagram,facebook,edit-profile'],
            'email' => ['required', 'string', 'email', 'max:60', 'unique:users,email,' . auth()->user()->id],
            'password' => ['required', 'string', 'min:6'],
        ]);

        if ($request->image) {
            // dd('Sí hay imagen');
            $image = $request->file('image');

            $imageName = Str::uuid() . '.' . $image->extension();
            $imageServer = Image::make($image)->fit(1000, 1000);

            $imagePath = public_path('profiles/' . $imageName);
            $imageServer->save($imagePath);
        }

        // Actualizar el usuario
        $userUpdate = User::find(auth()->user()->id);
        $userUpdate->username = $request->username;
        $userUpdate->email = $request->email;
        $userUpdate->password = Hash::make($request->password) ?? auth()->user()->password;
        $userUpdate->image = $imageName ?? auth()->user()->image ?? null;

        // Guardar
        $userUpdate->save();
        
        // Redireccionar
        return redirect()->route('posts.index', $userUpdate->username);
    }
}
