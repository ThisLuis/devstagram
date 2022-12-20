<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
        // Validacion de los campos
        $this->validate($request, [
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'required',
        ]);

        // Guardar post
        // Post::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'image' => $request->image,
        //     'user_id' => auth()->user()->id,
        // ]);

        // Otra forma de crear registros
        $post = new Post;
        $post->title = $request->title;
        $post->description = $request->description;
        $post->image = $request->image;
        $post->user_id = auth()->user()->id;
        $post->save();

        return redirect()->route('posts.index', auth()->user()->username);
    }




}
