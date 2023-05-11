<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // Sí solo se tiene un controlador que tiene un solo método, se puede usar el método __invoke (se manda a llamar automaticamente)
    public function __invoke(Post $post)
    {
        // Obtener a quienes seguimos
        $ids = auth()->user()->followings->pluck('id')->toArray();
        $posts = Post::whereIn('user_id', $ids)->latest()->paginate(10);

        return view('home', [
            'posts' => $posts
        ]);
    }
}
