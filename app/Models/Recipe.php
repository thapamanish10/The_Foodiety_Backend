<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'desc2',
        'image',
        'publish_at',
        'status',
        'type'
    ];

    protected $dates = ['publish_at'];
    protected $casts = [
        'publish_at' => 'datetime',
    ];

    public function images()
    {
        return $this->hasMany(RecipeImage::class);
    }
    public function likes()
    {
        return $this->hasMany(RecipeLike::class);
    }
    public function isLikedBy(?User $user)
    {
        if (!$user) {
            return false;
        }
        return $this->likes()->where('user_id', $user->id)->exists();
    }
    public function likeCount()
    {
        return $this->likes()->count();
    }
    public function comments()
    {
        return $this->hasMany(RecipeComment::class);
    }
    public function views()
    {
        return $this->hasMany(RecipeView::class);
    }
    public function shares()
    {
        return $this->hasMany(RecipeShare::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categorys');
    }
}
