<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Validar
        $this->validate($request, [
            'comment' => 'required|max:255',
        ]);

        // Crear el comentario
        Comment::create([
            'comment' => $request->comment,
            'user_id' => auth()->user()->id, // usuario autenticado
            'post_id' => $post->id
        ]);

        // Imprimir mensaje, regresa a la página anterior con un mensaje
        return back()->with('success', 'Comment posted successfully');
    }
}
