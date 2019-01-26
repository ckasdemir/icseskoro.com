<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BannedIpAddress extends Model
{
    protected $table = 'banned_ip_addresses';
    protected $guarded = [];
}
