<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class VideoCard extends Component
{
    public $video;
    public $type;

    public function __construct($video, $type= null)
    {
        $this->video = $video;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.video-card');
    }
}
