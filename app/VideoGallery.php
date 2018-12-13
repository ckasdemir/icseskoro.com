<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $table = 'video_gallery';
    protected $guarded = [];

    public function video()
    {
        return $this->hasMany('App\Video', 'video_gallery_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
