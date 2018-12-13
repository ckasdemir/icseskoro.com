<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = "songs";
    protected $guarded = [];

    public function album()
    {
        return $this->belongsTo('App\Album', 'album_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
