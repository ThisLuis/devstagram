<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.index');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:30',
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]
        // ,
        // [
        //     'required' => 'Este campo es obligatorio',
        //     'unique' => 'Ya esta registrado :(',
        //     'email' => 'Debes introducir un email valido',
        //     'password' => 'Debes definir una contraseña',
        //     'password.min' => 'El campo password debe tener al menos 6 caracteres'
        // ]
    );

    // Crear registro en la base de datos
    User::create([
        'name' => $request->name,
        'username' => Str::slug($request->username),
        'email' => $request->email,
        'password' => Hash::make( $request->password ),
    ]);

    // Autenticar usuario
    // auth()->attempt([
    //     'email' => $request->email,
    //     'password' => $request->password
    // ]);

    // Otra forma de autenticar
    auth()->attempt($request->only('email', 'password'));

    // Redireccionar
    return redirect()->route('posts.index', auth()->user()->username);

    }

    

   
}
