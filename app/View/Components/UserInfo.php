<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserInfo extends Component
{
    public $facebook;
    public $instagram;
    public $data;
    public function __construct($facebook = null,$instagram = null,$data = null)
    {
        $this->facebook = $facebook;
        $this->instagram = $instagram;
        $this->data = $data;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-info');
    }
}
