<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $fillable = [
        'crews_id',
        'users_id',
    ];

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'crews_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
