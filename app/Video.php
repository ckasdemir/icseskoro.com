<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = "videos";
    protected $guarded = [];

    public function video_gallery()
    {
        return $this->belongsTo('App\VideoGallery', 'video_gallery_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
