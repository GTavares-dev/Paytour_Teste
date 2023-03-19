<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curriculo extends Model
{
    protected $table = "curriculo";

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone',
        'desiredjob',
        'schooling',
        'comments',
        'file',
        'user_ip',
        'date_send',
        'hour_send',
        'path',
    ];
}
