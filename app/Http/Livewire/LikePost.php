<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // No tenemos que pasarlo, desde que lo creamos ya esta disponible en la vista
    public $post;


    public function render()
    {
        return view('livewire.like-post');
    }
}
