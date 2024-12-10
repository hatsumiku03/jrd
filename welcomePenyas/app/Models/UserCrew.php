<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCrew extends Model
{
    protected $fillable = [
        'crews_id',
        'users_id',
    ];
}
