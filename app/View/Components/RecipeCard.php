<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RecipeCard extends Component
{
    public $recipe;
    public $views;
    public $comments;
    /**
     * Create a new component instance.
     */
    public function __construct($recipe, $views = 0, $comments = 0)
    {
        $this->recipe = $recipe;
        $this->views = $views;
        $this->comments = $comments;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.recipe-card');
    }
}
