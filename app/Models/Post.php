<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Image;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'author_id',
        'body',
        'theme'
    ];

    protected $dates = ['deleted_at'];

    //TODO what is the relations in laravel
    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function postImages()
    {
        return $this->hasMany(Image::class, 'imageable_id')->whereImageable_type('post');
    }

    public function postComments()
    {
        return $this->hasMany(Comment::class, 'post_id', 'id');
    }
}
