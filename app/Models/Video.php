<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',       
        'desc',      
        'video_path',
        'thumbnail_path',
        'type'
    ];

    public function getDownloadNameAttribute()
    {
        return Str::slug("The Foodiety_".$this->name) . '.' . pathinfo($this->path, PATHINFO_EXTENSION);
    }
}
