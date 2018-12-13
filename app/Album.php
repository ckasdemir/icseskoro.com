<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'albums';
    protected $guarded = [];

    public function song()
    {
        return $this->hasMany('App\Song', 'album_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
