<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =
        ['title', 'body','user_id', 'category_id', 'photo_path'];

    public $path = "/images/" ;

    public function getPhotoPathAttribute($photo)
    {
        return $this->path . $photo;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
