<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'video_name',
        'video_text',
        'video_type',
        'video',
    ];

    // Define the inverse relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
