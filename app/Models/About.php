<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'logo',
        'number',
        'opt_number',
        'email',
        'facebook',
        'instagram',
        'youtube',
        'tiktok',
        'threads',
    ];

    public function images()
    {
        return $this->hasMany(AboutImage::class);
    }
}
