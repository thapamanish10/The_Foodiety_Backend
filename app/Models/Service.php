<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'info',
        'desc',
        'why',
        'why2',
        'offer',
        'logo',
        'thumbnail',
    ];

    public function images()
    {
        return $this->hasMany(ServiceImage::class);
    }
}