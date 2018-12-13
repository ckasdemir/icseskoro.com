<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    protected $table = 'photo_gallery';
    protected $guarded = [];

    public function photo()
    {
        return $this->hasMany('App\Photo', 'photo_gallery_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
