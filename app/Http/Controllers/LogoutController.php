<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        // Cerrar la sesion
        auth()->logout();

        // Reedirigir al usuario al login para iniciar sesion
        return redirect()->route('login');
    }
}
