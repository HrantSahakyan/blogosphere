<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Image;
class User extends Authenticatable
{
    use HasFactory, Notifiable;


    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'image',
    ];

    protected $appends = [
        'full_name'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany('App\Posts', 'author_id');
    }

    public function getFullName(): string
    {
        return $this->name.' '.$this->lastname;
    }

    public function getProfilepictureFilenameAttribute()
    {
        return $this->hasOne(Image::class, 'imageable_id', 'id')->whereImageable_type('user');
    }

}
