<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Notifications\Notifiable;

class Course extends Model
{
    // use HasFactory,Notifiable;

    protected $fillable = [
        'num',
        'name',
        'credits',
        'limit_people',
        'classroom_and_time',
        'instructors',
        'limit_illustrate',
        'required_illustrate',
        'remark'
    ];

    public function lecturer()
    {
    	return $this->belongsTo('App\Models\Lecturer', 'instructors', 'num');
    }
}
