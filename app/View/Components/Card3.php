<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card3 extends Component
{
    public $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function render()
    {
        return view('components.card3');
    }
}