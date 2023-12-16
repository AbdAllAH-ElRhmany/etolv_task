<?php

namespace App\Models;



use Vinelab\NeoEloquent\Eloquent\Model as NeoEloquent;

class Course extends NeoEloquent
{


    protected $fillable= ['title', 'desc'];
    protected $label = 'Course';
    public function students()
    {
        return $this->belongsToMany(Student::class, 'ENROLLED_IN');
    }
}