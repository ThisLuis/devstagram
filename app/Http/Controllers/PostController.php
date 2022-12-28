<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{

    // Se debe de proteger las itneracciones del usuario
    // El usuario debe de estar autenticado para acceder a cualquiera de estos metodos
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'index']);
    }
    
    // Route Model Bainding
    public function index(User $user)
    {
        // Dentro de attribute podemos encontrar la variable user
        // dd($user->username);
        // Toda la informacion del usuario se va guardando en user

        // Obtener los posts

        // $posts = Post::where('user_id', $user->id)->get();
        // Para paginar usamos paginate en lugar de get
        // Este tipo de consulta si se puede paginar - en dashboard $user->posts no se puede paginar
        $posts = Post::where('user_id', $user->id)->paginate(8);

        // dd($posts);
        return view('dashboard', [
            'user' => $user,
            'posts' => $posts,
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
        // $post = new Post;
        // $post->title = $request->title;
        // $post->description = $request->description;
        // $post->image = $request->image;
        // $post->user_id = auth()->user()->id;
        // $post->save();

        $request->user()->posts()->create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $request->image,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('posts.index', auth()->user()->username);
    }


    public function show(User $user, Post $post)
    {
        return view('posts.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(Post $post)
    {
        dd('eliminando', $post->id);
    }

}
