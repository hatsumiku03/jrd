<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'logo',
        'slogan',
        'capacity_people',
        'foundation_date',
        'color',
    ];


    public function userCrew(){
        return $this->hasOne(UserCrew::class);
    }

    public function user(){
        return $this->hasMany(User::class);
    }
}
