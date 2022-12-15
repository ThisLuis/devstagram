<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    // Funcion para iniciar sesion en Login
    public function store(Request $request)
    {
        

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        

        // Comprobar si las credenciales son correctas
        if(!auth()->attempt($request->only('email', 'password'), $request->remember))
        {
            // Crea mensaje para mostrar en la view del login cuando haya un error de autenticacion
            // back() nos regresa a la pagina cuando existe un error, en este caso en el login, no es necesario usar redirect
            // with es con lo que regresa back, en este caso un mensaje, el cual lo consumimos en la vista
            return back()->with('message','Credenciales incorrectas');
        }

        // Si el usuario ingreso las credenciales correctas y esta registrado en la base de datos lo mandamos a su muro
        return redirect()->route('posts.index');
    }
}
