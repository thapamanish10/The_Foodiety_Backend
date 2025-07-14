<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GallaryCard extends Component
{
    public $gallery;
    public $link;
    /**
     * Create a new component instance.
     */
    public function __construct($gallery, $link)
    {
        //
        $this->gallery = $gallery;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gallary-card');
    }
}
