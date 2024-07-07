<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'company_logo',
        'location',
        'phone_number',
        'website_link',
        'menu',
        'opening_time',
        'about_us',
        'price_range',
        'cuisines',
        'special_diets',
        'meals',
        'features',
        'review_summary', // updated field
    ];

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    // Define the relationship with the Image model
    public function images()
    {
        return $this->hasMany(Image::class);
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }

}
