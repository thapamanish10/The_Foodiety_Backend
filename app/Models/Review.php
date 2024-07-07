<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'product_id',
        'username',
        'review_text',
        // other fields
    ];

    // Define the inverse relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
