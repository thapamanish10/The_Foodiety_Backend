<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCard extends Component
{
    public $service;
    public $type;
    public $link;

    public function __construct($service=null, $image = null, $type = null, $link = null)
    {
        $this->service = $service;
        $this->image = $image;
        $this->type = $type;
        $this->link = $link;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-card');
    }
}
