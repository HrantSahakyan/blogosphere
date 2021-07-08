<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    public function author()
    {
        return $this->belongsTo('App\User', 'author_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
