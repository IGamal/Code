<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable =
        ['title', 'body','user_id', 'category_id', 'photo_path'];

    protected $path = "/images/" ;

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
}
