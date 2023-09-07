<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Lecturer extends Model
{
    use HasFactory,Notifiable;

    protected $fillable = [
        'num',
        'name',
        'department',
        'fulltime',
        'rank',
        'specialty',
        'remark',
    ];

    public function childrenCourse()
    {
    	return $this->hasMany('App\Models\Course', 'instructors', 'num');
    }
}
