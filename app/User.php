<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "users";
    protected $guarded = [];

    protected $fillable = [
        'name', 'email', 'password', 'username', 'role', 'status', 'voice_type_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role()
    {
        return $this->role;
    }

    public function status()
    {
        return $this->status;
    }

    public function voice_type()
    {
        return $this->belongsTo('App\VoiceType', 'voice_type_id');
    }
}
