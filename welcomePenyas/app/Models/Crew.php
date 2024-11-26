<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    protected $fillable = [
        'name',
        'logo',
        'slogan',
        'capacity_people',
        'foundation_date',
        'color',
    ];

    use HasFactory;
    public function user(){
        return $this->hasMany(User::class);
    }
}
