<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function course_session(){
        return $this->hasMany(SessionCourse::class);
    }


    


}
