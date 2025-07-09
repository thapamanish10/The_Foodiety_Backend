<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card2 extends Component
{
    public $blog;
    public $type;
    public $views;
    public $comments;

    public function __construct($blog, $views = 0, $comments = 0 , $type = null)
    {
        $this->blog = $blog;
        $this->type = $type;
        $this->views = $views;
        $this->comments = $comments;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card2');
    }
}
