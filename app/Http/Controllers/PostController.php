<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Para mostrar el muro, el usuario tiene que estar autenticado si no lo redirecciona al login
    // Pero podemos exceptuar ciertos métodos como show, index
    public function __construct()
    {
        $this->middleware('auth')->except('show', 'index'); // auth viene en laravel
    }

    public function index(User $user)
    {
        // Consultar los posts del usuario
        // get();
        $posts = Post::where('user_id', $user->id)->latest()->paginate(10);
        // dd($posts);

        return view('dashboard', [
            // Pasar una variable a la vista
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        // Crear el post
        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id
        // ]);

        // Otra forma de crear el post
        // $post = new Post();
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        // Otra forma de crear el post con relaciones
        // posts() vienes desde el modelo User
        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id
        ]);

        // Redireccionar
        return redirect()->route('posts.index', auth()->user()->username);
    }

    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user
        ]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post->delete();

        // Eliminar la imagen
        $image_path = public_path('uploads/' . $post->image);
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        return redirect()->route('posts.index', auth()->user()->username);
    }
}
