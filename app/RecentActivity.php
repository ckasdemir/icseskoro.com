<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RecentActivity extends Model
{
    protected $table = "recent_activities";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
