<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Commentary;
use Illuminate\Http\Request;

class CommentaryController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        // Validar
        
        $this->validate($request, [
            'commentary' => 'required|max:255',
        ]);

        // Almacenar comentario
        Commentary::create([
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
            'commentary' => $request->commentary,
        ]);

        // Mostrar mensaje
        return back()->with('message', 'Comentario agregado correctamente');
    }
}
