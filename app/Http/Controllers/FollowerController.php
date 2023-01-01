<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    // User sera la persona que estamos siguiendo/visitando
    // Requist tiene la persona que va a seguir a un usuario
    public function store(User $user, Request $request)
    {
        $user->followers()->attach(auth()->user()->id);
        return back();
    }

    public function destroy(User $user)
    {
        $user->followers()->detach(auth()->user()->id);
        return back();
    }
}
