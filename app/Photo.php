<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = "photos";
    protected $guarded = [];

    public function photo_gallery()
    {
        return $this->belongsTo('App\PhotoGallery', 'photo_gallery_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
