<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InstructorCourse extends Model
{
    //

    use SoftDeletes;

    protected $guarded = ['id'];

    public function instructor(){
        return $this->belongsTo(Instructor::class);
    }

    public function course(){
        return $this->belongsTo(Course::class);
    }
}
