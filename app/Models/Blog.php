<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
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
        return $this->hasMany(BlogImage::class);
    }
    public function likes()
    {
        return $this->hasMany(BlogLike::class);
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
        return $this->hasMany(BlogComment::class);
    }
    public function views()
    {
        return $this->hasMany(BlogView::class);
    }
    public function shares()
    {
        return $this->hasMany(BlogShare::class);
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'blog_categorys');
    }
}