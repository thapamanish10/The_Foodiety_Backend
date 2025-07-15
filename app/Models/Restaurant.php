<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Queue\Console\RestartCommand;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'logo',
        'name',
        'desc',
        'desc2',
        'publish_at',
        'status',
        'latitude',
        'longitude',
        'number',
        'rating',
        'email',
        'services',
        'food',
        'value',
        'atmosphere'
    ];
    
    public function images()
    {
        return $this->hasMany(RestaurantImage::class);
    }

    // Get first image URL or fallback to logo/default
    public function getFeaturedImageAttribute()
    {
        if ($this->images->isNotEmpty()) {
            return asset('storage/' . $this->images->first()->path);
        }
        
        return $this->logo ? asset('storage/' . $this->logo) : asset('images/default-restaurant.jpg');
    }

    // Get all image URLs
    public function getImageUrlsAttribute()
    {
        return $this->images->map(function ($image) {
            return asset('storage/' . $image->path);
        });
    }
    public function likes()
    {
        return $this->hasMany(RestaurantLike::class);
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
        return $this->hasMany(RestaurantComment::class);
    }
    public function views()
    {
        return $this->hasMany(RestaurantView::class);
    }
    public function shares()
    {
        return $this->hasMany(RestaurantShare::class);
    }
    // public function categories()
    // {
    //     return $this->belongsToMany(Category::class, 'recipe_categorys');
    // }

}
