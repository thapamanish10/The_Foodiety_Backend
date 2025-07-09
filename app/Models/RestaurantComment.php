<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RestaurantComment extends Model
{
    use HasFactory;

    protected $fillable = ['restaurant_id', 'user_id', 'content', 'parent_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
