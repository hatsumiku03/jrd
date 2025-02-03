<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'x',
        'y',
        'year',
    ];

    public function crew()
    {
        return $this->belongsToMany(Crew::class, 'draws', 'location_id', 'crew_id');
    }
}
