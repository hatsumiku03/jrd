<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCrew extends Model
{

    use HasFactory;
    
    protected $fillable = [
        'crew_id',
        'user_id',
    ];

    public function crew()
    {
        return $this->belongsTo(Crew::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
