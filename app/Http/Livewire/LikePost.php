<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    // No tenemos que pasarlo, desde que lo creamos ya esta disponible en la vista
    public $post;

    public function like()
    {
        if($this->post->checkLike(auth()->user()))
        {
            // request no esta disponible         Usamos this porque es la instancia que se le esta pasando a livewire, ya no es $post, sino $this->post
            $this->post->likes()->where('post_id', $this->post->id)->delete();
        } else 
        {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
    
            return back();
        }
    }


    public function render()
    {
        return view('livewire.like-post');
    }
}
