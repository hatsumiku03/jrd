<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCrew extends Model
{
    protected $fillable = [
        'crew_id',
        'user_id',
    ];
}
