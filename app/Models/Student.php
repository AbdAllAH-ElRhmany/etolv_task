<?php

namespace App\Models;


use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;

class Student extends NeoEloquent
{

    protected $label = 'Student';

    protected $fillable = ['name', 'phone', 'email'];


    public function courses()
    {
        return $this->belongsToMany(Course::class, 'ENROLLED_IN');
    }
}