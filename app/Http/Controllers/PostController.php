<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // Se debe de proteger las itneracciones del usuario
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Route Model Bainding
    public function index(User $user)
    {
        // Dentro de attribute podemos encontrar la variable user
        // dd($user->username);
        // Toda la informacion del usuario se va guardando en user
        return view('dashboard', [
            'user' => $user,
        ]);
    }

    // create nos permite tener el formulario
    public function create()
    {
        return view('posts.create');
    }

    // store nos permite guardar en la base de datos
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);
    }




}
