<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\Support\Str;

class Card3 extends Component
{
    public $restaurant;
    public $views;
    public $comments;
    public $likes;
    public $query;

    public function __construct($restaurant, $views = 0, $comments = 0, $likes = 0, $query = null)
    {
        if (!$restaurant || !$restaurant->relationLoaded('images')) {
            abort(500, 'Invalid restaurant data');
        }
        $this->restaurant = $restaurant;
        $this->views = $views;
        $this->comments = $comments;
        $this->likes = $likes;
        $this->query = $query;
    }

    public function render()
    {
        return view('components.card3');
    }
}