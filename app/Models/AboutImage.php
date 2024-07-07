<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'image_name',
        'image_text',
        'image_type',
        'image',
    ];

    // Define the inverse relationship with the Product model
    public function about()
    {
        return $this->belongsTo(About::class);
    }
}
