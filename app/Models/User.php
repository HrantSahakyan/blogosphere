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

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'lastname',
        'email',
        'password',
        'image',
    ];

    //TODO What is appends in laravel eloquent model
    protected $appends = [
        'full_name'
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function posts()
    {
        return $this->hasMany('App\Posts', 'author_id');
    }


    //TODO What is appends in laravel attributes and accessors
    public function getFullName(): string
    {
        return $this->name.' '.$this->lastname;
    }

    public function getProfilepictureFilenameAttribute()
    {
        return $this->hasOne(Image::class, 'imageable_id', 'id')->whereImageable_type('user');
    }
//    public function userImage()
//    {
//        return $this->hasOne(Image::class, 'imageable_id', 'id')->whereImageable_type('user');
////        dd($this->hasOne(Image::class,'imageable_id','id')->whereImageable_type('user')->filename);
////        if($this->hasOne(Image::class,'imageable_id','id')->whereImageable_type('user') === null){
////                dd(45);
////            }
////        else{
////                dd(445455);
////            }
////        }
//    }
}
