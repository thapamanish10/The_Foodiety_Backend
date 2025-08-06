<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Pagination extends Component
{
    public $paginator;
    public $onEachSide;
    public $style;
    public function __construct($paginator, $onEachSide = 2, $style = 'default')
    {
        $this->paginator = $paginator;
        $this->onEachSide = $onEachSide;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.pagination');
    }
}
