<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'comment_text', 'post_id', 'author_id'
        ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }


}
