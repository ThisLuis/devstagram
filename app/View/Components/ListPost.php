<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ListPost extends Component
{

    public $posts;
    /**
     * Create a new component instance.
     *
     * @return void
     */

    // El constructor sera la informacion que se le pasara a un componente
    public function __construct($posts)
    {
        $this->posts = $posts;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.list-post');
    }
}
